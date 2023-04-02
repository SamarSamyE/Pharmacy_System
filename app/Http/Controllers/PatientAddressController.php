<?php

namespace App\Http\Controllers;

use App\DataTables\PatientsAddressesDataTable;
use Illuminate\Http\Request;

class PatientAddressController extends Controller
{

   public function index(PatientsAddressesDataTable $dataTable){
    return $dataTable->render('Admin.patientsAddress');
   }
}

