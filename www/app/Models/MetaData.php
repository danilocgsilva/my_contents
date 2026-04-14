<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Content;
use DateTime;

class MetaData extends Model
{
    protected $table = 'metadata';

    protected $fillable = ['meta_name', 'content_id'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function valueable()
    {
        return $this->morphTo(__FUNCTION__, 'valueable_type', 'valueable_id');
    }

    public function parents()
    {
        return $this->belongsToMany(MetaData::class, 'metadata_metadata', 'child_id', 'parent_id');
    }

    public function children()
    {
        return $this->belongsToMany(MetaData::class, 'metadata_metadata', 'parent_id', 'child_id');
    }

    public function getValueAttribute(): string|int|bool|DateTime|null
    {
        return $this->valueable?->value;
    }
}
