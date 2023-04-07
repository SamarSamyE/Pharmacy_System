<?php

namespace App\Http\Controllers;

use App\DataTables\areasDataTable;
use App\Http\Requests\StoreUserRequest;
use App\Models\Area;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AreaController extends Controller
{

    public function index(AreasDataTable $dataTable){
        return $dataTable->render('Admin.areas');
    }

    public function show($id)
    {
        $area = Area::where('id', $id)->first();
        return view('areas.show',['area' => $area]);
    }

    public function create()
    {
        return view('areas.create');
    }
    public function edit($id)
    {
        $area = Area::find($id);
        return view('areas.edit', compact('area'));
    }
    public function update(Request $request, $id)
    {
        $area = Area::find($id);
        $area->name = $request->input('name');
        $area->address = $request->input('address');
        $area->save();
        return redirect()->route('areas.index');
    }

    public function store(Request $request)
    {
         $area= new Area([
            'name'=>$request->input('name'),
            'address'=>$request->input('address'),
        ]);
        $area->save();
        return to_route('areas.index');
    }

    public function destroy(Request $request, $id){
        $area = Area::findOrFail($id);
        $area->delete();
        return response()->json(['success' => 'Area deleted successfully!' ]);
    }

}
