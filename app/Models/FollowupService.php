<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\FollowupStatusUpdated;
use App\Models\Service;
use App\Models\Technician;

class FollowupService extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($followup) {
            if ($followup->isDirty('followup_status')) {
                event(new FollowupStatusUpdated($followup));
            }
        });
    }
    
    protected $table = 'followup_services';
    protected $fillable = [
        'service_id',
        'admin_id',
        'reason',
        'followup_date',
        'followup_time',
        'followup_report',
        'followup_status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function technicians()
    {
        return $this->belongsToMany(Technician::class, 'technician_followup_services')->withTimestamps();
    }
}
