<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puppyenroll extends Model
{
    use HasFactory;
    protected $table = "puppyenrolls";

    protected $fillable = [
        "petname",
        "age",
        "ownername",
        "email",
        "phonenumber",
        "address"
    ];

    public function puppies()
    {
        // return $this->hasMany(Manner::class);
        return $this->belongsTo(Puppy::class);
    }
}
