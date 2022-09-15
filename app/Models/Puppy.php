<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puppy extends Model
{
    use HasFactory;
    protected $table = "puppies";

    protected $fillable = [
        "date",
        "timestart",
        "timeend",
        "trainer",
        "availslot",
        "status"
    ];
}
