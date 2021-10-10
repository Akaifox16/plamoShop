<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees extends Model
{
    use HasFactory;
    protected $table = "employees";
    protected $fillable = [
        'lastName','firstName',
        'extension','email',
        'officeCode',
        'reportsTo','jobTitle'
    ];
    protected $primaryKey = 'employeeNumber';

    public function customers(){
        return $this->hasMany(customers::class,'salesRepEmployeeNumber');
    }
    public function reportsTo(){
        return $this->hasOne(employees::class,'employeeNumber','reportsTo');
    }
    public function office(){
        return $this->hasOne(offices::class,'officeCode','officeCode');
    }
}
