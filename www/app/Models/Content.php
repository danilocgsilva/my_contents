<?php

namespace App\Models;

use App\Models\MetaData;
use Domain\Interfaces\ContentInterface;
use Illuminate\Database\Eloquent\Model;
use Domain\Content as DomainContent;
use Domain\MetaData as DomainMetaData;

class Content extends Model
{
    public function metadata()
    {
        return $this->hasMany(MetaData::class);
    }

    public function toDomain(): DomainContent
    {
        $domainContent = app(ContentInterface::class);
        foreach ($this->metadata as $metaData) {
            $metaDataDomain = new DomainMetaData($metaData->meta_name, $metaData->value);
            $domainContent->addMeta($metaDataDomain);
        }
        $domainContent->makeMetaDatasAvailableAsProperty();
        return $domainContent;
    }

    public function toDomainWithIds(): DomainContent
    {
        $domainContent = $this->toDomain();
        $domainContent->setId($this->id);
        return $domainContent;
    }
}
