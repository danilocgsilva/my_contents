<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MetaData;

class DatetimeMetaData extends Model
{
    public $timestamps = false;

    protected $table = 'datetime_metadata';

    protected $fillable = ['value'];

    public function metadata()
    {
        return $this->morphOne(MetaData::class, 'valueable');
    }
}

