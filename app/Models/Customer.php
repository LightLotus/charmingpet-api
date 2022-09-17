<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $fillable = [
        "firstname",
        "lastname",
        "contactnumber",
        "email",
        "address",
        "dateinterview",
        "timeinterview",
    ];

    // the use can have many adoption/s
    public function adoption()
    {
        return $this->hasMany(Adoption::class);
    }
}
