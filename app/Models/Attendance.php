<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Technician;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';
    protected $fillable = [
        'technician_id',
        'attendance_date',
        'time_in',
        'time_out',
        'total_time',
        'attendance_status',
        'remarks',
    ];

    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }
}
