<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkPlace extends Model
{
    protected $guarded = [];

    public function baitos():HasMany
    {
        return $this->hasMany(Baito::class);
    }
}
