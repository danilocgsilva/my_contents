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

    public function getValueAttribute(): string|int|bool|DateTime|null
    {
        return $this->valueable?->value;
    }
}
