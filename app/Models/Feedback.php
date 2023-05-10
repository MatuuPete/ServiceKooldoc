<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedbacks';
    protected $fillable = [
        'service_id',
        'rating',
        'review'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
