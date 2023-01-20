<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Offer;
use App\Models\User\Product;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use HelperTrait;

    public function add()
    {
        $product = Product::all('id', 'en_name');
        return view('admin.Offer.offer', compact('product'));
    }

    public function store(Request $request)
    {
       //dd($request->all());
        Offer::create([
            'offer_name' => $request->offer_name,
            'value' => $request->value,
            'product_id'=>$request->product_id,
            'offer_image' => $this->saveImage($request->offer_image, 'offer/image'),
            'starts_at' => $request->starts_at,
            'ends_at' => $request->ends_at
        ]);
    }

    public function read(Request $request)
    {
        if ($request->ajax()) {

            $offer = Offer::all();
            return Datatables($offer)
                ->setRowId('id')
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    return '<li style="list-style-type: none" class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false"><i class="fa fa-list-ul"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href=""  d_id="' . $row->id . '" class="dropdown-item" id="delete_btn">Delete</a>
                            <a href="' . route('edit.color', $row->id) . '" id="edit" class="dropdown-item">Edit</a>
                        </div></li>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {
            return view('admin.Offer.view');
        }
    }

    public function delete(Request $request)
    {
        $data = Offer::find($request->id);
        $data->delete();
        return response()->json();
    }

}
