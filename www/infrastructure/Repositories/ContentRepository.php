<?php

declare(strict_types=1);

namespace Infrastructure\Repositories;

use Domain\Interfaces\ContentRepositoryInterface;
use Domain\Content as DomainContent;
use App\Models\Content;
use Domain\MetaData;
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
     * @return Content[]
     */
    public function all(): array
    {
        return Content::all()->map(function ($item, $key) {
            return $item->toDomain();
        })->toArray();
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

    /**
     * @inheritDoc
     */
    public function getCreatedId(): int
    {
        return $this->createdId;
    }

    /**
     * @inheritDoc
     * 
     * @todo Look to Domain\Content::persist. There are some code repetition.
     * May it is good to create a trait.
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
}
