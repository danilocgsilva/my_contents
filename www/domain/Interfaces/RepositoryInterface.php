<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * Interface RepositoryInterface<T>
 * @template T of Model
 */
interface RepositoryInterface
{
    /**
     * Return all models registers.
     *
     * @return Collection<T>
     */
    public function all(): Collection;

    /**
     * Return one register by its id
     *
     * @param int $id
     * @return T|null
     */
    public function find(int $id): ?Model;

    /**
     * Creates a new register.
     *
     * @param array $data
     * @return T
     */
    public function create(array $data): Model;

    /**
     * Updates a register by its id.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool;

    /**
     * Removes a register by its id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;

    /**
     * Search a register by a specific field.
     *
     * @param string $field
     * @param mixed $value
     * @return Collection<T>
     */
    public function search(string $field, $value): Collection;
}