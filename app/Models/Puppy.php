<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Puppyenroll;

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

    public function puppyenrolls()
    {
        return $this->belongsToMany(Puppyenroll::class, 'puppy_puppyenrolls', 'puppyenroll_id', 'puppy_id');
    }

    public function countEnrolled()
    {
        return $this->puppyenrolls()->count();
    }
}