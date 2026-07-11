<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'product' => 'array'
    ];
    protected $fillable = ['user_id', 'total_amount', 'transaction_status', 'method_payment',];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shipping()
    {
        return $this->hasOne(Shipping::class);
    }


    public function paymentMethod()
    {
        return $this->hasOne(dataBank::class);
    }

   
}
