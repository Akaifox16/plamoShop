<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'productVendor','quantityInStock',
        'buyPrice'
    ];
    protected $primaryKey = 'productCode';

    public function productline(){
        return $this->hasOne(products::class,'productLine','productLine');
    }
    public function orderdetails(){
        return $this->belongsToMany(orderdetails::class,'productCode');
    }
}
