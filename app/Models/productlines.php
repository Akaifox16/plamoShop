<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productlines extends Model
{
    use HasFactory;
    protected $table = "productlines";
    protected $primaryKey = 'productLine';

    public function products(){
        return $this->hasMany(products::class,'productLine');
    }
}
