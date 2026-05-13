<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teaching;
use App\Models\User;

class SchoolClass extends Model
{
    protected $table = 'tbl_classes';

    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'class_id');
    }

    public function teachings()
    {
        return $this->hasMany(Teaching::class, 'class_id');
    }
}
