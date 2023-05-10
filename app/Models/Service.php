<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\ServiceStatusUpdated;
use App\Models\Admin;
use App\Models\Customer;
use App\Models\Feedback;
use App\Models\FollowupService;
use App\Models\PostConsultation;
use App\Models\Technician;
use App\Models\Transaction;
use App\Models\Warranty;

class Service extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::updating(function ($service) {
            if ($service->isDirty('service_status')) {
                event(new ServiceStatusUpdated($service));
            }
        });
    }

    protected $table = 'services';
    protected $fillable = [
        'customer_id',
        'admin_id',
        'book_type',
        'service_type',
        'ac_type',
        'ac_brand',
        'ac_hp',
        'unit_type',
        'no_unit',
        'description',
        'image',
        'cooling',
        'mechanical_noise',
        'electric_connectivity',
        'service_date',
        'service_time',
        'service_price',
        'service_report',
        'service_status',
    ];
    
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function cancel()
    {
        return $this->hasOne(Cancel::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }
    
    public function followup_service()
    {
        return $this->hasOne(FollowupService::class);
    }
    
    public function post_consultation()
    {
        return $this->hasOne(PostConsultation::class);
    }

    public function technicians()
    {
        return $this->belongsToMany(Technician::class, 'technician_services')->withTimestamps();
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function warranty()
    {
        return $this->hasOne(Warranty::class);
    }
}
