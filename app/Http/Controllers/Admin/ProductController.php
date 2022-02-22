<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with(['user','category'])->orderby('id', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="mr-3" href="' . route('product.edit', $row->id) . '" id="editItem">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <form action="' . route('product.destroy', $row->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" onclick="return myConfirm();" style="border: 0;background-color: transparent;" class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>';
                    return $actionBtn;
                })
                ->editColumn('cover', function ($row) {
                    return $row->cover ? '<img src="' . Storage::url($row->cover) . '" style="max-height: 40px;"/>' : '';
                })
                ->rawColumns(['action', 'cover'])
                ->make(true);
        }

        return view('be/admin/product/indexProduct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        
        return view('be/admin/product/createProduct', compact(['users', 'categories']));
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

        $data['slug'] = Str::slug($request->name);

        $image_path = $request->file('cover')
                    ->store('product_images', 'public');

        $data['cover'] = $image_path;

        Product::create($data);

        return redirect()->route('product.index');
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
        $item = Product::with(['category','user'])->findOrFail($id);
        $users = User::all();
        $categories = Category::all();
        
        return view('be/admin/product/editProduct', compact(['item', 'users', 'categories']));
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
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = Str::slug($request->name);

        if($request->file('cover')){
            if($item->cover && file_exists(storage_path('app/public/' . $item->cover))){
                \Storage::delete('public/' . $item->cover);
            }
  
            $new_image = $request->file('cover')->store('product_images', 'public');
  
            $data['cover'] = $new_image;
        }

        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findorFail($id);
        $item->delete();

        return redirect()->route('product.index');
    }
}
