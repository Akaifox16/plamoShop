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
    protected $primaryKey = 'customerNumber';
    
    public function addresses(){
        return $this->hasMany(customeraddresses::class,'customerID');
    }
    public function payments(){
        return $this->hasMany(payments::class,'customerNumber');
    }
    public function orders(){
        return $this->hasMany(orders::class,'customerNumber');
    }
    public function saleRepEmployee()
    {
        return $this->belongsTo(employees::class,'employeeNumber','salesRepEmployeeNumber');
    }
}
