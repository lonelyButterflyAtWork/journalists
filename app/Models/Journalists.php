<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journalists extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image'];

    public function voters()
    {
        return $this->belongsToMany(Voters::class)->withTimestamps()->withPivot('id');
    }
}
