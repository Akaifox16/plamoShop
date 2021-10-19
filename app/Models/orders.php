<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'orderNuumber',
        'orderDate','requiredDate','shippedDate',
        'status','comments',
        'customerNumber'
    ];
    protected $primaryKey = 'orderNumber';

    public function customer()
    {
        return $this->belongsTo(customers::class,'customerNumber','customerNumber');
    }
    public function ordersDetail()
    {
        return $this->hasMany(orderdetails::class,'orderNumber','orderNumber');
    }
}
