<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function add()
    {
        return view('admin.Brand.brand');
    }

    public function store(Request $request)
    {
        $data = Brand::create([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
        ]);

        return redirect(route('add.brands'));
    }

    public function read(Request $request)
    {
        if ($request->ajax()) {

            $data = Brand::all();
            return Datatables($data)
                ->setRowId('id')
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<li style="list-style-type: none" class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false"><i class="fa fa-list-ul"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href=""  d_id="' . $row->id . '" class="dropdown-item" id="delete_btn">Delete</a>
                            <a href="' . route('edit.brand', $row->id) . '" id="edit" class="dropdown-item">Edit</a>
                        </div></li>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('admin.Brand.view');
        }
    }

    public function delete(Request $request)
    {
        $data = Brand::find($request->id);
        $data->delete();
        return response()->json();

    }

    public function edit($id)
    {
        $data = Brand::find($id);
        return view('admin.Brand.edit', compact('data', 'id'));
    }

    public function update(Request $request, $id)
    {
        //update
        $data = Brand::find($id);

        $data->update([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
        ]);
    }
}
