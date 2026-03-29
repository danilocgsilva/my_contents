<?php

declare(strict_types=1);

namespace Domain;

use Domain\Interfaces\ContentInterface;
use Domain\Exceptions\NoDataToSaveException;
use Domain\MetaData;
use Domain\Interfaces\ContentRepositoryInterface;

class Content implements ContentInterface
{
    /**
     * List of MetaDatas
     * 
     * @var MetaData[]
     */
    private array $metaDatas;

    /**
     * List of MetaDatas
     * 
     * @var MetaData[]
     */
    public readonly array $metaDatasValues;

    public readonly ?int $id;

    public function __construct(
        private ContentRepositoryInterface $contentRepository
    ) {
    }

    public function persist(): ContentPersistingResults
    {
        if (empty($this->metaDatas)) {
            throw new NoDataToSaveException();
        }

        $this->contentRepository->save($this);
        
        return new ContentPersistingResults($this->metaDatas);
    }

    public function addMeta(MetaData $metaData): ContentInterface
    {
        $this->metaDatas[] = $metaData;
        return $this;
    }

    public function getMetas(): array
    {
        return $this->metaDatas;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int|null
    {
        if (!isset($this->id)) {
            return null;
        }
        return $this->id;
    }

    public function makeMetaDatasAvailableAsProperty(): self
    {
        if (!isset($this->metaDatas)) {
            $this->metaDatasValues = [];
        } else {
            $this->metaDatasValues = $this->metaDatas;
        }
        return $this;
    }

    public function getMetaDatasValuesAttribute(): array
    {
        if (!isset($this->metaDatasValues)) {
            return [];
        }
        return $this->metaDatasValues;
    }
}
