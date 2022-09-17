<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mannerenroll extends Model
{
    use HasFactory;
    protected $table = "mannerenrolls";

    protected $fillable = [
        "manner_id",
        "petname",
        "age",
        "ownername",
        "email",
        "phonenumber",
        "address"
    ];

    public function manners()
    {
        // return $this->hasMany(Manner::class);
        return $this->belongsTo(Manner::class);
    }
}