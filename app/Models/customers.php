<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $fillable = [
        'customerNumber',
        'customerName','contactLastName','contactFirstName',
        'phone'
    ];
    
    public function address(){
        return $this->hasMany('/app/customeraddresses');
    }
}
