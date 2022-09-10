<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mannerenroll extends Model
{
    use HasFactory;

    protected $table = "mannerenrolls";
    
    protected $fillable = [
        "petname",
        "age",
        "ownername",
        "email",
        "phonenumber",
        "address"
    ];
}
