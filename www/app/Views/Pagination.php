<?php

declare(strict_types=1);

namespace App\Views;

use Illuminate\Pagination\LengthAwarePaginator;

class Pagination
{
    public readonly string $nextPageUrl;
    public readonly string $previousPageUrl;
    public readonly int $currentPage;
    public readonly array $items;

    public function __construct(LengthAwarePaginator $lengthAwarePagination)
    {
        $this->nextPageUrl = $lengthAwarePagination->nextPageUrl();
        $this->previousPageUrl = $lengthAwarePagination->previousPageUrl();
        $this->currentPage = $lengthAwarePagination->currentPage();
        $this->items = $lengthAwarePagination->items();
    }
}
