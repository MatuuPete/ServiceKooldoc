<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\User;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admins';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'team_position',
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
