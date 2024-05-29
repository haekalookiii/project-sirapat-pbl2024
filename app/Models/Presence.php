<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;
    
    // protected $fillable = [
    //     'schedule_id',
    //     'student_id',
    //     'nim',
    //     'nama_lengkap',
    //     'status_kehadiran'
    // ];

    protected $guarded =[
        'id'
    ];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id', 'id');
    }
}
