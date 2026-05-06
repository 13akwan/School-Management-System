<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teaching;
use App\Models\User;

class Attendance extends Model
{
    protected $table = 'tbl_attendances';
    
    protected $fillable = [
        'teaching_id',
        'student_id',
        'date',
        'status'
    ];

    public function teaching(){
        return $this->belongsTo(User::class, 'student_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
