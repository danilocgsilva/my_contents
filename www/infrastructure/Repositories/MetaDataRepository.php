<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Domain\Interfaces\MetaDataRepositoryInterace;
use Illuminate\Database\Eloquent\Collection;
use App\Models\MetaData;
use App\Models\StringMetaData;
use Domain\Interfaces\PaginatableInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class MetaDataRepository implements MetaDataRepositoryInterace, PaginatableInterface
{
    public function all(): Collection
    {
        return MetaData::all();
    }

    public function find(int $id): ?MetaData
    {
        return MetaData::find($id);
    }

    public function create(array $data): MetaData
    {
        return MetaData::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $metaData = MetaData::find($id);
        if ($metaData) {
            return $metaData->update($data);
        }
        return false;
    }

    public function delete(int $id): bool
    {
        $metaData = MetaData::find($id);
        if ($metaData) {
            return $metaData->delete();
        }
        return false;
    }

    public function search(string $field, $value): Collection
    {
        return MetaData::where($field, $value)->get();
    }

    public function paginate(int $perPage = 15, int $page = 1): LengthAwarePaginator
    {
        return MetaData::paginate($perPage, ['*'], 'page', $page);
    }
}