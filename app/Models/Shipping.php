<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = ['transaction_detail_id', 'shipping_method', 'address', 'couries_service','courier_provider', 'servicce_price'];

    public function transactionDetail()
    {
        return $this->belongsTo(TransactionDetail::class);
    }
}
