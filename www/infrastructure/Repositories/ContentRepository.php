<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Domain\Interfaces\ContentRepositoryInterface;
use Domain\Content as DomainContent;
use App\Models\Content;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ContentRepository implements ContentRepositoryInterface
{
    /**
     * @var int|null
     */
    private ?int $createdId;

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
        return Content::with('metadata.valueable')
            ->paginate($perPage, ['*'], 'page', $page);
    }

    /**
     * Return one register by its id
     *
     * @param int $id
     * @return Content|null
     */
    public function find(int $id): ?DomainContent
    {
        return Content::find($id)->toDomain();
    }

    public function create(): DomainContent
    {
        $createdModel = Content::create([]);
        $this->createdId = $createdModel->id;
        return $createdModel->toDomain();
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

    public function getCreatedId(): int
    {
        return $this->createdId;
    }
}
