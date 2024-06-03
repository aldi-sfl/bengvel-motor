<?php

namespace App\Models;

use App\Models\User;
use Hashids\Hashids;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [];
    // const STATUS  = [
    //     'pending'       => 0,
    //     'in_process'    => 1,
    //     'success'       => 2,
    //     'error'         => 3

    // ];

    public function getHashedIdAttribute()
    {
        $hashids = new Hashids(config('app.key'), 20);
        return $hashids->encode($this->id);
    }

    public static function findByHashedId($hashedId)
    {
        $hashids = new Hashids(config('app.key'), 20);
        $decoded = $hashids->decode($hashedId);

        if (count($decoded) === 0) {
            return null;
        }

        return self::find($decoded[0]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
