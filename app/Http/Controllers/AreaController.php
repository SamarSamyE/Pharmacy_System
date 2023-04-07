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
    public function index(Request $request){
      
        if ($request->ajax()) {
            $data = Area::select('id','name','address','country_id')->get();
            return DataTables::of($data)->addIndexColumn()
            ->addColumn('action', function ($row) {
                $button = '<a name="edit" id="'.$row->id.'" class="edit btn btn-primary btn-sm p-0 mr-2 " href="'.route('area.edit', $row->id).'" style="border-radius: 20px;"><i class="fas fa-edit m-2">Edit</i></a>';    
                $button .= '<form method="post" onSubmit="return confirm(Are you sure you want to delete this row?)" action= "'.route('area.destroy', $row->id).'">
                <input type="hidden" name="_token" value="'. csrf_token().' ">
                <input type="hidden" name="_method" value="delete">
                <button type="submit" class="btn btn-danger btn-sm  p-0 ml-1 mt-1  " style="border-radius: 20px;"><i class="fas fa-trash m-2">Delete</i>
                </button>
                </form>';
                    return $button;
                    ;
            })
            ->addColumn('country', function ($row) {
                $name = Country::all()->where('id',$row['country_id'])->first()->name;
                return $name;
            })
                ->rawColumns(['action'])
                ->make(true);
        }
            
            return view("area.index");
        
    }



public function create()
{
    $Countries=Country::all();
    return view("area.create",['countries'=>$Countries]);

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
    Area::where('id',$id)->Delete();
    return redirect()->route('area.index');
}


}

