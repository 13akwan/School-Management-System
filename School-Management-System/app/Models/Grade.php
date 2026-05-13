<?php

namespace App\Models;
use App\Models\User;
use App\Models\Task;
use App\Models\Submission;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'tbl_grades';

    protected $fillable = [
        'student_id',
        'task_id',
        'submission_id',
        'score'
    ];

    public function student(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function submission(){
        return $this->belongsTo(Submission::class);
    }

    public function grade()
    {
        return $this->hasOne(Grade::class);
    }
}
