<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;
    protected $table = "adoptions";

    protected $fillable = [
        "adopname",
        "status",
        "description",
        "animaltype",
        "estbirthday",
        "color",
        "sex",
        "imgsrc"
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class);
    }
}