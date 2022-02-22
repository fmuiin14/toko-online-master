<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = DB::table('products')
            ->join('users', 'users_id', '=', 'users.id')
            ->join('categories', 'products.categories_id', 'categories.id')
            ->select('products.*', 'products.name as proname', 'products.id as proid', 'products.created_at as procreated', 'users.*', 'categories.id as cateid', 'categories.name as catename')
            ->take(8)
            ->orderByDesc('procreated')->get();
            // dd($products);
        
        return view('fe.pages.home', compact('products'));
    }
}
