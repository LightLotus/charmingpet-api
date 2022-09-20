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
        "password"
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // the use can have many adoption/s
    public function adoptions()
    {
        return $this->belongsToMany(Adoption::class, 'customer_adoption', 'customer_id', 'adoption_id')->withPivot('status', 'dateinterview', 'timeinterview');
    }

    public function mannerEnrollee()
    {
        return $this->hasMany(Mannerenroll::class);
    }

    public function kindergartenEnrollee()
    {
        return $this->hasMany(Puppyenroll::class);
    }
}
