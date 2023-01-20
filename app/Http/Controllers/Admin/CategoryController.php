<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add()
    {
        return view('admin.Category.category');
    }

    public function store(Request $request)
    {
        $data = Category::create([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
        ]);

        return redirect(route('add.categories'));
    }

    public function read(Request $request)
    {
        if ($request->ajax()) {

            $category = Category::all();
            return Datatables($category)
                ->setRowId('id')
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<li style="list-style-type: none" class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false"><i class="fa fa-list-ul"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href=""  d_id="' . $row->id . '" class="dropdown-item" id="delete_btn">Delete</a>
                            <a href="' . route('edit.category', $row->id) . '" id="edit" class="dropdown-item">Edit</a>
                        </div></li>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('admin.Category.view');
        }
    }

    public function delete(Request $request)
    {
        $data = Category::find($request->id);
        $data->delete();
        return response()->json();
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return view('admin.Category.edit', compact('data', 'id'));
    }

    public function update(Request $request, $id)
    {
        //update
        $data = Category::find($id);

        $data->update([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
        ]);
    }

}
