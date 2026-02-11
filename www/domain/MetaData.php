<?php

declare(strict_types=1);

namespace Domain;

class MetaData
{
    public function __construct(
        public readonly string $metaName,
        public readonly string|int $metaValue
    ) {
    }
}
