<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teaching;

class Subject extends Model
{
    protected $table = 'tbl_subjects';
    protected $fillable = [
        'name'
        ];

    public function teachings(){
        return $this->hasMany(Teaching::class, 'subject_id');
    }
}
