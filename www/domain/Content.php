<?php

declare(strict_types=1);

namespace Domain;

use Domain\Interfaces\ContentInterface;
use Domain\Interfaces\MetaDataRepositoryInterace;
use Domain\Exceptions\NoDataToSaveException;
use Domain\MetaData;
use Domain\Interfaces\ContentRepositoryInterface;

class Content implements ContentInterface
{
    /**
     * Summary of metaData
     * @var MetaData[]
     */
    private array $metaDatas;

    public function __construct(
        private MetaDataRepositoryInterace $metaDataRepository,
        private ContentRepositoryInterface $contentRepository
    ) {
    }

    public function persist(): ContentPersistingResults
    {
        if (empty($this->metaDatas)) {
            throw new NoDataToSaveException();
        }

        $persistedContent = $this->contentRepository->create();

        array_walk($this->metaDatas, function (MetaData $metaData) use ($persistedContent) {
            $metaData->setContentId($persistedContent->id);
            $metaDataModel = $metaData->toModel();
            $metaDataModel->valueable->save();
            $metaDataModel->valueable->metadata()->save($metaDataModel);
        });
        return new ContentPersistingResults($this->metaDatas);
    }

    public function addMeta(MetaData $metaData): ContentInterface
    {
        $this->metaDatas[] = $metaData;
        return $this;
    }
}
