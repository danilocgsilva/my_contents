<?php

declare(strict_types=1);

namespace Domain;

use Domain\Interfaces\ContentInterface;
use Domain\Exceptions\NoDataToSaveException;
use Domain\MetaData;
use Domain\Interfaces\ContentRepositoryInterface;

class Content implements ContentInterface
{
    /**
     * List of MetaDatas
     * 
     * @var MetaData[]
     */
    private array $metaDatas;

    public function __construct(
        private ContentRepositoryInterface $contentRepository
    ) {
    }

    public function persist(): ContentPersistingResults
    {
        if (empty($this->metaDatas)) {
            throw new NoDataToSaveException();
        }

        $this->contentRepository->create();
        $contentId = $this->contentRepository->getCreatedId();

        array_walk($this->metaDatas, function (MetaData $metaData) use ($contentId) {
            $metaData->setContentId($contentId);
            $metaDataModel = $metaData->toModel();

            /** @var \App\Models\StringMetaData|\App\Models\IntegerMetaData */
            $metaDataValueModel = $metaDataModel->valueable;
            $metaDataValueModel->save();
            $metaDataValueModel->metadata()->save($metaDataModel);
        });
        return new ContentPersistingResults($this->metaDatas);
    }

    public function addMeta(MetaData $metaData): ContentInterface
    {
        $this->metaDatas[] = $metaData;
        return $this;
    }

    public function getMetas(): array
    {
        return $this->metaDatas;
    }
}
