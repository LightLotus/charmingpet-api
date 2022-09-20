<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mannerenroll extends Model
{
    use HasFactory;
    protected $table = "mannerenrolls";

    protected $fillable = [
        "petname",
        "age",
        "customer_id",
    ];

    public function manners()
    {
        return $this->belongsToMany(Manner::class, 'manner_mannerenroll', 'mannerenroll_id', 'manner_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}