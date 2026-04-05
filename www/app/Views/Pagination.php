<?php

declare(strict_types=1);

namespace App\Views;

use Illuminate\Pagination\LengthAwarePaginator;

class Pagination
{
    public readonly string|null $nextPageUrl;
    public readonly string|null $previousPageUrl;
    public readonly int $currentPage;
    public readonly int $lastPage;
    public readonly array $items;

    public function __construct(LengthAwarePaginator $lengthAwarePagination)
    {
        $this->nextPageUrl = $lengthAwarePagination->nextPageUrl();
        $this->previousPageUrl = $lengthAwarePagination->previousPageUrl();
        $this->currentPage = $lengthAwarePagination->currentPage();
        $this->items = $lengthAwarePagination->items();
        $this->lastPage = $lengthAwarePagination->lastPage();
    }
}
