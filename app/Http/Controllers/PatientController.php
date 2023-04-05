<?php

namespace App\Http\Controllers;

use App\DataTables\PatientsDataTable;
use Illuminate\Http\Request;

class PatientController extends Controller
{
   public function index(PatientsDataTable $dataTable){
    return $dataTable->render('Admin.patients');
   }
}
