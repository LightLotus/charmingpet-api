<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MannerenrollController extends Controller
{
    public function store(Request $request)
    {
    $validator = Validator::make($request->all(), [
        
    ]);
    }
}