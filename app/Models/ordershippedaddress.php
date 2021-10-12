<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordershippedaddress extends Model
{
    use HasFactory;
    protected $table = 'ordershippedaddress';
    protected $primaryKey = 'orderNumber';

    public function order()
    {
        return $this->belongsTo(orders::class,'orderNumber','orderNumber');
    }
}
