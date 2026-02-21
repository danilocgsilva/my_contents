<?php

declare(strict_types=1);

namespace Domain;

use App\Models\MetaData as MetaDataModel;
use App\Models\StringMetaData;
use App\Models\IntegerMetaData;
use InvalidArgumentException;

class MetaData
{
    private readonly int $contentId;

    public function __construct(
        public readonly string $metaName,
        public readonly string|int $metaValue
    ) {
    }

    public function setContentId(int $contentId): static
    {
        $this->contentId = $contentId;
        return $this;
    }

    public function toArray(): array
    {
        $metaData = [
            'meta_name' => $this->metaName,
            'meta_value' => $this->metaValue,
        ];
        
        if (isset($this->contentId)) {
            $metaData['content_id'] = $this->contentId;
        }
        
        return $metaData;
    }

    public function toModel(): MetaDataModel
    {
        switch (gettype($this->metaValue)) {
            case "string":
                $valueMetaData = StringMetaData::make(['value' => $this->metaValue]);
                break;
            case "integer":
                $valueMetaData = IntegerMetaData::make(['value' => $this->metaValue]);
                break;
            default:
                throw new InvalidArgumentException('Unsupported meta value type');
        }
        
        $metaData = MetaDataModel::make($this->toArray());
        $metaData->setRelation('valueable', $valueMetaData);

        return $metaData;
    }
}
