<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        if ($request->ajax()) {
            $data = Category::orderby('id', 'asc')->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="mr-3" href="' . route('category.edit', $row->id) . '" id="editItem">
                                    <i class="fas fa-edit"></i>
                                  </a>
                                  <form action="' . route('category.destroy', $row->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" onclick="return myConfirm();" style="border: 0;background-color: transparent;" class="text-danger">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>';
                    return $actionBtn;
                })
                ->editColumn('photo', function ($row) {
                    return $row->photo ? '<img src="' . Storage::url($row->photo) . '" style="max-height: 40px;"/>' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make(true);
        }

        return view('be/admin/category/indexCategory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('be/admin/category/createCategory');
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
        
        $image_path = $request->file('photo')
                    ->store('category_images', 'public');
            
        $data['photo'] = $image_path;

        // $data['photo'] = $request->file('photo')->store('assets/category', 'public');

        Category::create($data);

        return redirect()->route('category.index');
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
        $item = Category::findOrFail($id);

        return view('be.admin.category.editCategory', compact('item'));
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
        $category = Category::findOrFail($id);
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        if($request->file('photo')){
            if($category->photo && file_exists(storage_path('app/public/' . $category->photo))){
                \Storage::delete('public/' . $category->photo);
            }
  
            $new_image = $request->file('photo')->store('category_images', 'public');
  
            $data['photo'] = $new_image;
        }


        $category->update($data);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $item = Category::findorFail($id);
        $item->delete();

        return redirect()->route('category.index');
    }
}
