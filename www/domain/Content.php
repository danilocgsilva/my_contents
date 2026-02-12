<?php

declare(strict_types=1);

namespace Domain;

use Domain\Interfaces\ContentInterface;
use Domain\Interfaces\MetaDataRepositoryInterace;
use Domain\Exceptions\NoDataToSaveException;

class Content implements ContentInterface
{
    public function __construct(private MetaDataRepositoryInterace $metaDataRepository)
    {
    }

    public function persist(): ContentPersistingResults
    {
        // $contentPersistingResults = new ContentPersistingResults([]);
        // return $contentPersistingResults;
        throw new NoDataToSaveException();
    }

    public function addMeta(MetaData $metaData): ContentInterface
    {
        $this->metaDataRepository->create($metaData->toArray());
        return $this;
    }
}
