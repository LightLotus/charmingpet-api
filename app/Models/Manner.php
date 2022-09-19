<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mannerenroll;

class Manner extends Model
{
    use HasFactory;
    protected $table = "manners";
    // protected $casts = [
    //     'date'  => 'date:F j, Y',
    // ];
    protected $fillable = [
        "date",
        "timestart",
        "timeend",
        "trainer",
        "availslot",
        "status"
    ];

    public function mannerenrolls()
    {
        return $this->belongsToMany(Mannerenroll::class, 'manner_mannerenroll', 'manner_id', 'mannerenroll_id');
    }

    public function countEnrolled()
    {
        return $this->mannerenrolls()->count();
    }
}