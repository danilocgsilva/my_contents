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
    public readonly int|null $nextPageNumber;
    public readonly int|null $previousPageNumber;

    public function __construct(LengthAwarePaginator $lengthAwarePagination)
    {
        $this->nextPageUrl = $lengthAwarePagination->nextPageUrl();
        $this->previousPageUrl = $lengthAwarePagination->previousPageUrl();
        $this->currentPage = $lengthAwarePagination->currentPage();
        $this->items = $lengthAwarePagination->items();
        $this->lastPage = $lengthAwarePagination->lastPage();
        $this->previousPageNumber = $this->previousPageUrl ? ($this->currentPage - 1) : null;
        $this->nextPageNumber = $this->nextPageUrl ? ($this->currentPage + 1) : null;
    }
}
