<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactSetting extends Model
{
    use HasFactory;
    // to be continued
    protected $fillable = ['app_name', 'contact_link'];
}
