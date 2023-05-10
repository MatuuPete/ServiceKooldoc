<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;
use App\Models\Voucher;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $fillable = [
        'service_id',
        'payment_method',
        'amount',
        'payment_proof',
        'notes',
        'transaction_date',
        'transaction_status',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function vouchers()
    {
        return $this->belongsToMany(Voucher::class, 'voucher_transactions')
            ->withPivot('customer_id')
            ->withTimestamps();
    }
}
