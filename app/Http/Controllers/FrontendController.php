<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class FrontendController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   public static function index()
    {
       $products = Product::all(); 
       $categories = Category::all();            
        return view('welcome',compact('products','categories'));
    }
    function productdetails($id)
    {
        $single_product_info = Product::find($id);
        $related_products = Product::where('id','!=',$id)->where('category_id',$single_product_info->category_id)->get();
        return view('frontend/productdetails',compact('single_product_info', 'related_products'));
    }
    function categorywiseproduct($category_id)
    {
     $products = Product::where('category_id', $category_id)->get();
     return view('frontend/categorywiseproduct', compact('products'));
    }
    
}
