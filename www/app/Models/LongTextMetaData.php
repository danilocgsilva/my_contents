<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MetaData;

class LongTextMetaData extends Model
{
    public $timestamps = false;

    protected $table = 'long_text_metadata';

    protected $fillable = ['value'];

    public function metadata()
    {
        return $this->morphOne(MetaData::class, 'valueable');
    }
}
