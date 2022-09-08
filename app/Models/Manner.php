<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manner extends Model
{
    use HasFactory;
    protected $table = "manners";
    protected $fillable = [
        "date",
        "time",
        "day",
        "trainer",
        "availslot",
        "status"
    ];
}
