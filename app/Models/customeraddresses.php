<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customeraddresses extends Model
{
    use HasFactory;
    protected $table = "customerAddresses";
    protected $fillable = [
        'customerID',
        'addressLine1','addressLine2',
        'addressNo',
        'selected',
        'city','state','postalCode','country'
    ];
    
    public function customerID(){
        return $this->belongsTo('\app\customers');
    }
}
