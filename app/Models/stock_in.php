<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock_in extends Model
{
    use HasFactory;
    protected $table = 'stock_ins';
    protected $fillable = ['qty'];
    protected $primaryKey = 'productCode';

    public function product()
    {   
        return $this->belongsTo(products::class,'productCode','productCode');
    }
}
