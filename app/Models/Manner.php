<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manner extends Model
{
    use HasFactory;
    protected $table = "manners";
    protected $casts = [
        'date'  => 'date:F j, Y',
    ];
    protected $fillable = [
        "date",
        "timestart",
        "timeend",
        "day",
        "trainer",
        "availslot",
        "status"
    ];
}
