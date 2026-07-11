<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = ['transaction_id', 'product_id', 'quantity', 'price'];
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // public function shipping()
    // {
    //     return $this->hasOne(Shipping::class);
    // }
}
