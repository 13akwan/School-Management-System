<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teaching;

class Task extends Model
{
    protected $table = 'tbl_tasks';

    protected $fillable = [
        'title',
        'description',
        'teaching_id',
        'due_date',
        'type'
    ];

    public function teaching()
    {
        return $this->belongsTo(Teaching::class, 'teaching_id');
    }
}
