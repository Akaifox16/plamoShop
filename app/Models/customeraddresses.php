<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customeraddresses extends Model
{
    use HasFactory;
    protected $table = "customeraddresses";
    protected $fillable = [
        'addressLine1','addressLine2',
        'addressNo',
        'city','state','postalCode','country'
    ];
    protected $primaryKey = 'id';

    public function customer(){
        return $this->belongsTo(customers::class,'customerID','customerNumber');
    }
}
