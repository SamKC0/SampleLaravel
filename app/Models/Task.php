<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    // protected $table = 'tasks';

    public function member()
    {
        return $this->belongsToMany(Member::class);
    }
    public function project()
    {
        return $this->hasOne(Project::class);
    }

}
