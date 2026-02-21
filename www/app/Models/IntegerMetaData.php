<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IntegerMetaData extends Model
{
    public $timestamps = false;

    protected $table = 'int_metadata';
    
    protected $fillable = ['value'];

    public function metadata()
    {
        return $this->morphOne(MetaData::class, 'valueable');
    }
}
