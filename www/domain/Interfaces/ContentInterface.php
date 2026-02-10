<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Domain\ContentPersistingResults;

interface ContentInterface
{
    public function persist(): ContentPersistingResults;
}
