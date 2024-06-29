<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dataBank extends Model
{
    use HasFactory;
    protected $fillable = ['bank_name','bank_account','atas_nama'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
