<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class PostConsultation extends Model
{
    use HasFactory;

    protected $table = 'post_consultations';
    protected $fillable = [
        'service_id',
        'message',
        'recommendation',
        'consultation_date',
        'consultation_status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
