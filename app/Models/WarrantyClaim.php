<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warranty;

class WarrantyClaim extends Model
{
    use HasFactory;

    protected $table = 'warranty_claims';
    protected $fillable = [
        'warranty_id',
        'claim_date',
        'statement',
        'claim_status',
    ];

    public function warranty()
    {
        return $this->belongsTo(Warranty::class);
    }
}
