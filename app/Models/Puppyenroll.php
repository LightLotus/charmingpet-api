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
        "customer_id"
    ];

    public function puppies()
    {
        return $this->belongsToMany(Puppy::class, 'puppy_puppyenrolls', 'puppyenroll_id', 'puppy_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
