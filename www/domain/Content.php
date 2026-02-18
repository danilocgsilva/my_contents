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
        // $contentPersistingResults = new ContentPersistingResults([]);
        // return $contentPersistingResults;
        // foreach ($this->metaData as $metaData) {
        //     $this->metaDataRepository->save($metaDatum);
        // })
        $persistedContent = $this->contentRepository->create();

        array_walk($this->metaDatas, function ($metaData) use ($persistedContent) {
            $metaData->setContentId($persistedContent->id);
        });

        dd($this->metaDatas);

        throw new NoDataToSaveException();
    }

    public function addMeta(MetaData $metaData): ContentInterface
    {
        $this->metaDatas[] = $metaData;
        return $this;
    }
}
