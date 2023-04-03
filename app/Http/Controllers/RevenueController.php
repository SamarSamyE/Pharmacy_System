<?php

namespace App\Http\Controllers;

use App\DataTables\RevenuesDataTable;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index(RevenuesDataTable $dataTable)
    {
        return $dataTable->render('Admin.revenues');
    }
}
