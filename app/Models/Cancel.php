<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Cancel extends Model
{
    use HasFactory;

    protected $table = 'cancels';
    protected $fillable = [
        'service_id',
        'why'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
