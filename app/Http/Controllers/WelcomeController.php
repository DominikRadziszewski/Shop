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
     * Display a listing of the resource
     *@param Request $request.
     */
    public function index(Request $request)
    {
        $filters = $request->query('filter');
        $paginate = $request->query('paginate') ?? 5;
    
        $query= Product::query();
        if (!is_null($filters)) {
    
            if (array_key_exists('categories',$filters)) {
    
                $query->whereIn('category_id', $filters['categories']);
    
            }
    

            if (!is_null($filters['price_min'])) {
    
                $query->where('price', '>=', $filters['price_min']);
    
            }
    

            if (!is_null($filters['price_max'])) {
    
                $query->where('price', '<=' ,$filters['price_max']);
    
            }
    
            return response()->json($query->paginate($paginate));
    
        }
    
        return view("welcome",
        ["products"=>         $query->paginate($paginate),
        "categories"=>ProductCategory::orderBy("name", "asc")->get(),
        "defaultImage"=>config('shop.defaultImage')
        ]);
    }

}
