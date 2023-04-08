<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Country;
use Illuminate\Http\Request;
use Webpatser\Countries\Countries;
use Yajra\DataTables\DataTables;
use App\DataTables\AreasDataTable;

class AreaController extends Controller
{
    public function index(AreasDataTable $dataTable){
        return $dataTable->render('Admin.areas');
    }

public function create()
{
    $Countries=Country::all();
    return view("Area.create",['countries'=>$Countries]);

}

/**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $name = request()->name;
   $address=request()->address;
   $country=request()->country_id;

    Area::create([
        'name' => $name,
        'address'=>$address,
        'country_id'=>$country,

    ]);
    return to_route('area.index');
}

public function edit(string $id)
{
    $Countries_data=Country::all();
    $area =Area::find($id);
    return view('area.edit', ['area' => $area],['countries'=>$Countries_data]);
}


public function update(Request $request, string $id)
{
    $area = Area::findOrFail($id);
    $area->name = $request->input('name');
    $area->address = $request->input('address');
    $area->country_id = $request->input('country_id');


    $area->save();
    return redirect()->route('area.index');
}

public function destroy(string $id)
{
    // Area::where('id',$id)->Delete();
    $area = Area::findOrFail($id);
    $area->delete();
    return response()->json(['success'=>'Area Deleted Successfully!']);
}


}

