<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Content;

class MetaData extends Model
{
    protected $table = 'metadata';

    protected $fillable = ['key'];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function valueable()
    {
        return $this->morphTo();
    }

    public function getValueAttribute()
    {
        return $this->valueable?->value;
    }

}
