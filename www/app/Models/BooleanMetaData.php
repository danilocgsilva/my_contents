<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BooleanMetaData extends Model
{
    public $timestamps = false;

    protected $table = 'boolean_metadata';

    protected $fillable = ['value'];

    protected $casts = ['value' => 'boolean'];

    public function metadata()
    {
        return $this->morphOne(MetaData::class, 'valueable');
    }
}
