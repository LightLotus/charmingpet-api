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
        return $this->belongsToMany(Manner::class, 'manner_mannerenroll', 'mannerenroll_id', 'manner_id');
    }
}
