<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\MetaData;

class Content extends Model
{
    public function metadata()
    {
        return $this->hasMany(MetaData::class);
    }
}
