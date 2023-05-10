<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaction;

class Voucher extends Model
{
    use HasFactory;

    public $incrementing = false; 

    protected $table = 'vouchers';
    protected $primaryKey = 'id';
    protected $fillable = [
        'discount',
        'description',
        'start_date',
        'end_date',
        'usage_count',
        'voucher_status'
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'voucher_transactions')
            ->withPivot('customer_id')
            ->withTimestamps();
    }
}
