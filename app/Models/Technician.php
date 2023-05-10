<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Attendance;
use App\Models\FollowupService;
use App\Models\Inventory;
use App\Models\Service;
use App\Models\User;

class Technician extends Model
{
    use HasFactory;

    protected $table = 'technicians';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'age',
        'experience',
        'specialties',
        'image',
    ];
    
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    
    public function followupServices()
    {
        return $this->belongsToMany(FollowupService::class, 'technician_followup_services')->withTimestamps();
    }
    
    public function inventories()
    {
        return $this->belongsToMany(Inventory::class, 'technician_inventories')
            ->withPivot(['quantity', 'borrowed_date', 'returned_date'])
            ->withTimestamps();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'technician_services')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
