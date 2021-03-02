<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    use HasFactory;

    public function journalists()
    {
        return $this->belongsToMany(Journalists::class);
    }
}
