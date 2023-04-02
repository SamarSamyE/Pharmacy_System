<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $allorders =Order::all();

    //    dd($allorders);
        return view('orders.index', ['orders' => $allorders]);
    }

}
