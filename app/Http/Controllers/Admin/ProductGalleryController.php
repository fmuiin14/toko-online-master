<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductGallery;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductGallery::with(['product']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="mr-3" href="' . route('product-gallery.edit', $row->id) . '" id="editItem">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <form action="' . route('product-gallery.destroy', $row->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" onclick="return myConfirm();" style="border: 0;background-color: transparent;" class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>';
                    return $actionBtn;
                })
                ->editColumn('photos', function ($row) {
                    return $row->photos ? '<img src="' . Storage::url($row->photos) . '" style="max-height: 40px;"/>' : '';
                })
                ->rawColumns(['action', 'photos'])
                ->make(true);
        }

        return view('be/admin/product-gallery/indexProductGallery');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        
        return view('be/admin/product-gallery/createProductGallery', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['photos'] = $request->file('photos')->store('product_gallery', 'public');

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::all();
        $item = ProductGallery::findOrFail($id);

        return view('be/admin/product-gallery/editProductGallery', compact('item', 'products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $galleries = ProductGallery::findOrFail($id);
        $data = $request->all();

        // $data['slug'] = Str::slug($request->name);

        if($request->file('photos')){
            if($galleries->photos && file_exists(storage_path('app/public/' . $galleries->photos))){
                \Storage::delete('public/' . $galleries->photos);
            }
  
            $new_image = $request->file('photos')->store('product_gallery', 'public');
  
            $data['photos'] = $new_image;
        }


        $galleries->update($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::findorFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}
