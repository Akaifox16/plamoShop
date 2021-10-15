<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_in extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['qty'];
    protected $primaryKey = 'productCode';

    public function product()
    {   
        return $this->belongsTo(products::class,'productCode','productCode');
    }
}
