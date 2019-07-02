<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Image;
use File;
use App\Category;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  public function addproductview(){
      
        $products = Product::paginate(4);
        $deleted_products = Product::onlyTrashed()->get();
        $categories = Category::all();
    return view('product/view',compact('products','deleted_products','categories'));
  }
  
   public function addproductinsert(Request $request )
          {
            
            $request->validate([
                'category_id' => 'required',
                'product_name' => 'required',
                'product_description' => 'required',
                'product_price' => 'required|numeric',
                'product_quantity' => 'required|numeric' ,
                'alert_quantity' => 'required|numeric'
            ]);
            $last_inserted_id = Product::insertGetId([

                'category_id' => $request->category_id,
                'product_name' => $request->product_name,                 
                'product_description' =>$request->product_description,       
                'product_price' => $request->product_price,
                'product_quantity' =>$request->product_quantity, 
                'alert_quantity' =>$request->alert_quantity , 
            ]);

            if ($request->hasFile('product_image') )
            {
               $photo_to_upload = $request->product_image; 
               $filename = $last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();
               Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
               Product::find($last_inserted_id)->update([
                   'product_image' => $filename
               ]);
           }
            return back()->with('status','Product Added Successfully');
          }
   function deleteproduct($id)
        { 
            Product::find($id)->delete();
            return back()->with('deletestatus','Product Deleted Successfully');  
        }
   function editproduct($id)
            { 
                $single_id_info =  Product::findOrFail($id);
                return view('product/edit',compact('single_id_info'));
                
            }
   function editproductinsert(Request $request,$id)
   { 
       //dd($request->all());
       if($request->hasFile('product_image')){
           if(Product::find($request->product_id)->product_image == 'defaultproductphoto.jpg'){
            $photo_to_upload = $request->product_image;
            $filename = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();          
            Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
            Product::find($request->id)->update([
                'product_image' => $filename
                ]);    
       }
        else{
                $delete_this_file = Product::find($request->id)->product_image;
                //dd($delete_this_file);           
                unlink(base_path('public/uploads/product_photos/'.$delete_this_file));   
                $photo_to_upload = $request->product_image; 
                $filename = Product::find($request->id)->id.".".$photo_to_upload->getClientOriginalExtension(); 
                Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
                Product::find($request->id)->update([
                'product_image' => $filename
                ]); 
            }              
              
                   Product::find($request->id)->update([
                    'product_name' => $request->product_name, 
                    'product_description' =>$request->product_description,       
                    'product_price' => $request->product_price,
                    'product_quantity' =>$request->product_quantity, 
                    'alert_quantity' =>$request->alert_quantity , 

                   ]);
       }
        
                   return back()->with('status','Product Update Successfully');
               }

                             
      
            // }
            
            //not permanently delete
            function restoreproduct($id){
               Product::onlyTrashed()->where('id',$id)->restore();
                return back();
            }
            function forcedeleteproduct($id){
                //delete from public folder
                $delete_this_file = Product::onlyTrashed()->find($id)->product_image;
                //dd($delete_this_file);           
                unlink(base_path('public/uploads/product_photos/'.$delete_this_file));
                //delete from ui
                Product::onlyTrashed()->find($id)->ForceDelete();  
                 return back();
             }
}
