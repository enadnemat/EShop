<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User\Brand;
use App\Models\User\Category;
use App\Models\User\Color;
use App\Models\User\Photo;
use App\Models\User\Product;
use App\Models\User\Specification;
use App\Traits\HelperTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use HelperTrait;

    public function add()
    {
        $category = Category::get();
        $brand = Brand::get();
        $color = Color::get();

        return view('admin.Product.product', compact('category', 'brand', 'color'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('thumbnail')) {

            $product = Product::create([
                'en_name' => $request->en_name,
                'ar_name' => $request->ar_name,
                'description' => $request->description,
                'price' => $request->price,
                'thumbnail' => $this->saveImage($request->thumbnail, 'product/thumbnail'),
                'category_id' => $request->category_id,
                'brand_id' => $request->brand_id,
                'color_id' => $request->color_id,
            ]);
        }

        $product_id = $product->id;

        foreach ($request->photos as $photo) {

            $fileInfo = $photo->getClientOriginalName();/////

            $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
            $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);

            $file_name = $filename . '-' . time() . '.' . $extension;/////

            $photo->move(public_path('product/photos'), $file_name);

            $imageUpload = new Photo;
            $imageUpload->product_id = $product_id;
            $imageUpload->original_filename = $fileInfo;
            $imageUpload->filename = $file_name;
            $imageUpload->save();
        }

        $product_id = $product->id;

        foreach ($request->specification_ar_name as $index => $ar_name) {
            Specification::create([
                'ar_name' => $ar_name,
                'en_name' => $request->specification_en_name[$index],
                'value' => $request->specification_value[$index],
                'product_id' => $product_id,
            ]);
        }
    }

    public function read(Request $request)
    {
        if ($request->ajax()) {
            $product = Product::with('color')->with('brand')->with('category');
            return Datatables($product)
                ->setRowId('id')
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<li style="list-style-type: none" class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                        aria-expanded="false"><i class="fa fa-list-ul"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href=""  d_id="' . $row->id . '" class="dropdown-item" id="delete_btn">Delete</a>
                            <a href="' . route('edit.product', $row->id) . '" id="edit" class="dropdown-item">Edit</a>
                        </div></li>';
                })
                ->rawColumns(['action'])
                ->make(true);
        } else {

            return view('admin.Product.view');
        }
    }

    public function delete(Request $request)
    {

        $product = Product::where('id', $request->id);
        $specification = Specification::where('product_id', $request->id);
        $specification->delete();
        $product->delete();
        return response()->json();
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $specification = Specification::where('product_id', $id)->get();
        $category = Category::get();
        $brand = Brand::get();
        $color = Color::get();
        return view('admin.Product.edit', compact('product', 'specification', 'category', 'brand', 'color', 'id'));
    }

    public function getPhoto($id)
    {
        $images = Photo::all()->where('product_id', $id);
        foreach ($images as $image) {
            $tableImages[] = $image['filename'];
        }
        $file_path = public_path('product/photos');
        $files = scandir($file_path);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..' && in_array($file, $tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('product/photos/') . $file;
                $obj['size'] = filesize($file_path);
                $obj['path'] = url('product/photos/' . $file);
                $data[] = $obj;
            }
        }
        return response()->json($data);
    }

    public function storephoto(Request $request, $id)
    {

        $image = $request->file('dropzone');
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name = $filename . '-' . time() . '.' . $extension;
        $product_id = $id;
        $image->move(public_path('product/photos'), $file_name);

        $imageUpload = new Photo;
        $imageUpload->product_id = $product_id;
        $imageUpload->original_filename = $fileInfo;
        $imageUpload->filename = $file_name;
        $imageUpload->save();
        return response()->json(['success' => $file_name]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if ($request->hasFile('thumbnail')) {
            $product->update([
                'en_name' => $request->en_name,
                'ar_name' => $request->ar_name,
                'description' => $request->description,
                'price' => $request->price,
                'thumbnail' => $this->saveImage($request->thumbnail, 'product/thumbnail'),
                'category_id' => $request->category_id,
                'featured' => $request->featured,
                'inspired' => $request->inspired,
                'brand_id' => $request->brand_id,
                'color_id' => $request->color_id,
            ]);
        } else {
            $product->update([
                'en_name' => $request->en_name,
                'ar_name' => $request->ar_name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'featured' => $request->featured,
                'inspired' => $request->inspired,
                'brand_id' => $request->brand_id,
                'color_id' => $request->color_id,
            ]);
        }


        $specification = Specification::where('product_id', $request->id);
        $specification->delete();

        $product_id = $product->id;

        foreach ($request->specification_ar_name as $index => $ar_name) {
            Specification::create([
                'ar_name' => $ar_name,
                'en_name' => $request->specification_en_name[$index],
                'value' => $request->specification_value[$index],
                'product_id' => $product_id,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $filename = $request->get('filename');
        Photo::where('filename', $filename)->delete();
        $path = public_path('product/photos') . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success' => $filename]);
    }

}
