<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface PaginatableInterface
{
    public function paginate(int $page, int $perPage): LengthAwarePaginator;
}

