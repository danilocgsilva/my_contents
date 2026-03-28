<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Domain\Interfaces\PaginatableInterface;
use Illuminate\Database\Eloquent\Collection;
use Domain\Content;

interface ContentRepositoryInterface extends PaginatableInterface
{
    /**
     * Return all models registers.
     *
     * @return array<Content>
     */
    public function all(): Collection;

    /**
     * Return one register by its id
     *
     * @param int $id
     * @return Content|null
     */
    public function find(int $id): ?Content;

    /**
     * Insert a new entry in the table contents.
     * No need to set a content data.
     */
    public function create(): Content;

    /**
     * Removes a register by its id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    public function getCreatedId(): int;
}
