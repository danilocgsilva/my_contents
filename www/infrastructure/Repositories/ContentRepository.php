<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Domain\Interfaces\ContentRepositoryInterface;
use App\Models\Content;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ContentRepository implements ContentRepositoryInterface
{
    /**
     * Return all models registers.
     *
     * @return Collection<Content>
     */
    public function all(): Collection
    {
        return Content::all();
    }

    public function paginate(int $page, int $perPage): LengthAwarePaginator
    {
        return Content::paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Return one register by its id
     *
     * @param int $id
     * @return Content|null
     */
    public function find(int $id): ?Content
    {
        return Content::find($id);
    }

    public function create(): Content
    {
        return Content::create([]);
    }

    /**
     * Removes a register by its id
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $content = Content::find($id);
        if ($content) {
            return $content->delete();
        }
        return false;
    }
}
