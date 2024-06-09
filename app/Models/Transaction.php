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
    protected $fillable = ['user_id', 'total_amount', 'transaction_status', 'method_payment', 'transaction_id'];

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function generateTransactionId()
    {
        $randomNumber = random_int(10000, 99999);
        
        return 'OB' . $randomNumber;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->transaction_id = self::generateTransactionId();
        });
    }
}
