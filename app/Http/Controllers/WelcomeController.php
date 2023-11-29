<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use View;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("welcome",
        ["products"=> Product::paginate(10),
        "categories"=>ProductCategory::orderBy("name", "asc")->get()
    ]);
    }
}
