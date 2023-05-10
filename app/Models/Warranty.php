<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\WarrantyClaim;

class Warranty extends Model
{
    use HasFactory;

    protected $table = 'warranties';
    protected $fillable = [
        'service_id',
        'warranty_type',
        'period',
        'start_date',
        'end_date',
        'warranty_status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function warrantyClaim()
    {
        return $this->hasOne(WarrantyClaim::class);
    }
}
