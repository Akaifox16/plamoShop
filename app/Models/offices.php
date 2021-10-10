<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offices extends Model
{
    use HasFactory;
    protected $table = "offices";
    protected $primaryKey = 'officeCode';

    public function employees()
    {
        return $this->hasMany(employees::class,'officeCode');
    }
}
