<?php

declare(strict_types=1);

namespace Domain\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use App\Models\MetaData;

interface MetaDataRepositoryInterace extends RepositoryInterface
{
    /**
     * Interface RepositoryInterface<MetaData>
     * 
     * @return Collection<MetaData>
     */
    public function all(): Collection;

    /**
     * Return one register by its id
     *
     * @param int $id
     * @return MetaData|null
     */
    public function find(int $id): ?MetaData;

    /**
     * Creates a new register.
     *
     * @param array $data
     * @return MetaData
     */
    public function create(array $data): MetaData;

    /**
     * Search a register by a specific field.
     *
     * @param string $field
     * @param mixed $value
     * @return Collection<MetaData>
     */
    public function search(string $field, $value): Collection;
}