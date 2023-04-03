<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Models\Doctor;
use App\Models\Pharmacy;
use App\Models\User;

class RevenuePharmacyController extends Controller
{
    public function index()
    {
     
        return view('Revenue.index');
    }

}
