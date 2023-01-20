<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Order;
use Illuminate\Http\Request;
use function GuzzleHttp\Promise\all;

class OrderController extends Controller
{
    public function read(Request $request)
    {
        if ($request->ajax()) {
            $order = Order::all();
            return Datatables($order)
                ->setRowId('id')
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<li style="list-style-type: none" class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false"><i class="fa fa-list-ul"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href=""  d_id="' . $row->id . '" class="dropdown-item" id="delete_btn">Delete</a>
                            <a href="' . route('edit.order', $row->id) . '" id="edit" class="dropdown-item">Edit</a>
                        </div></li>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

            return view('admin.Order.view');
        }
    }

    public function edit($id)
    {
        $data = Order::find($id);
        return view('admin.Order.edit', compact('data', 'id'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $data = Order::find($id);
        $data->update([
            'status' => $request->status,
        ]);
    }
}
