<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Technician;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';
    protected $fillable = [
        'name',
        'description',
        'stock',
    ];

    public function technicians()
    {
        return $this->belongsToMany(Technician::class, 'technician_inventories')
            ->withPivot(['quantity', 'borrowed_date', 'returned_date'])
            ->withTimestamps();
    }
}
