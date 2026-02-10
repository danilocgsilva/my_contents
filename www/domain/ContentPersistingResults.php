<?php

declare(strict_types=1);

namespace Domain;

class ContentPersistingResults
{
    public function __construct(public readonly array $newMetas)
    {
    }
}