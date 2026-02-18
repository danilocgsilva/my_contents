<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Domain\Interfaces\PaginatableInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Content;

interface ContentRepositoryInterface extends PaginatableInterface
{
    /**
     * Return all models registers.
     *
     * @return Collection<Content>
     */
    public function all(): Collection;

    /**
     * Return one register by its id
     *
     * @param int $id
     * @return Content|null
     */
    public function find(int $id): ?Content;

    public function create(): Content;

    /**
     * Removes a register by its id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
