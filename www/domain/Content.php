<?php

declare(strict_types=1);

namespace Domain;

use Domain\Interfaces\ContentInterface;
use Domain\Exceptions\NoDataToSaveException;

class Content implements ContentInterface
{
    public function persist(): ContentPersistingResults
    {
        // $contentPersistingResults = new ContentPersistingResults([]);
        // return $contentPersistingResults;
        throw new NoDataToSaveException();
    }
}
