<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FloatMetaData extends Model
{
    public $timestamps = false;

    protected $table = 'float_metadata';

    protected $fillable = ['value'];

    protected $casts = ['value' => 'float'];

    public function metadata()
    {
        return $this->morphOne(MetaData::class, 'valueable');
    }
}
