<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderdetails extends Model
{
    use HasFactory;
    protected $table = "orderdetails";
    protected $fillavble = [
        'orderNumber','productCode',
        'quantityOrdered','priceEach',
        'orderLineNumber'
    ];
}
