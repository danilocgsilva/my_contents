<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Domain\ContentPersistingResults;
use Domain\MetaData;

interface ContentInterface
{
    public function persist(): ContentPersistingResults;

    public function addMeta(MetaData $metaData): self;

    public function getMetas(): array;

    public function setId(int $id): self;

    public function getId(): int|null;
}
