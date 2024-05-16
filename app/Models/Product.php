<?php

namespace App\Models;

use Hashids\Hashids;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;  

    protected $guarded=[];

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
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }



}
