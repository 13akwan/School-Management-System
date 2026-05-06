<?php

namespace App\Models;
use App\Models\Task;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'tbl_submissions';

    protected $fillable = [
        'task_id',
        'student_id',
        'content',
        'submitted_at'
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }
}
