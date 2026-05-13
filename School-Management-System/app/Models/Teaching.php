<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Subject;
use App\Models\SchoolClass;
use App\Models\Task;
use App\Models\Attendance;

class Teaching extends Model
{
    protected $table = 'tbl_teachings';

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'class_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}