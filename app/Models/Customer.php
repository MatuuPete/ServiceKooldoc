<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'address',
        'barangay',
        'city',
        'province',
        'zip_code',
        'property_type',
        'image',
    ];
    
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
