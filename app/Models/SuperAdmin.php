<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SuperAdmin extends Model
{
    use HasFactory;

    protected $table = 'super_admins';
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'team_position',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
