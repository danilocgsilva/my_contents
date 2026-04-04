<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Domain\Interfaces\ContentRepositoryInterface;
use Domain\Content as DomainContent;
use App\Models\Content;
use Domain\MetaData;
use Illuminate\Pagination\LengthAwarePaginator;

class ContentRepository implements ContentRepositoryInterface
{
    /**
     * @var int|null
     */
    private ?int $createdId;

    private bool $rememberIds = false;

    /**
     * Return all models registers.
     *
     * @return Content[]
     */
    public function all(): array
    {
        return Content::all()->map(function ($item) {
            if ($this->rememberIds) {
                return $item->toDomainWithIds();
            }
            return $item->toDomain();
        })->toArray();
    }

    /**
     * @param int $page
     * @param int $perPage
     * 
     * @return DomainContent[]
     */
    public function paginate(int $page, int $perPage): array
    {
        $paginatedItems = Content::with('metadata.valueable')
            ->paginate($perPage, ['*'], 'page', $page)
            ->items();

        return array_map(function ($item) {
            if ($this->rememberIds) {
                return $item->toDomainWithIds();
            }
            return $item->toDomain();
        }, $paginatedItems);
    }

    public function paginateWithLengthAware(int $page, int $perPage): LengthAwarePaginator
    {
        $lengthAwarePaginator = Content::with('metadata.valueable')
            ->paginate($perPage, ['*'], 'page', $page)
            ->through(function (Content $content) {
                return $content->toDomainWithIds();
            });

        return $lengthAwarePaginator;
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

    /**
     * @inheritDoc
     */
    public function getCreatedId(): int
    {
        return $this->createdId;
    }

    /**
     * @inheritDoc
     */
    public function save(DomainContent $content): void
    {
        $persistingModel = Content::create();

        $contentMetaDatas = $content->getMetas();
        array_walk($contentMetaDatas, function (MetaData $metaData) use ($persistingModel) {
            $metaData->setContentId($persistingModel->id);
            $metaDataModel = $metaData->toModel();

            /** @var \App\Models\StringMetaData|\App\Models\IntegerMetaData */
            $metaDataValueModel = $metaDataModel->valueable;
            $metaDataValueModel->save();
            $metaDataValueModel->metadata()->save($metaDataModel);
        });
    }

    public function rememberIds(): self
    {
        $this->rememberIds = true;
        return $this;
    }
}
