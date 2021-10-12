<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class preorders extends Model
{
    use HasFactory;

    protected $table = 'preorders';
    protected $fillable = ['checkNumber'];
    protected $primaryKey = 'id';

    public function chceckNumber(){
        return $this->haveOne(products::class,'checkNumber','checkNumber');
    }
}
