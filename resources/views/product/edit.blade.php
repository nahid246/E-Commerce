@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6  offset-3 ">
                <div class="card">
                    <div class="card-header bg-success">
                        Edit Product From
                     </div>
                    <div class="card-body">
                        @if(session('status')) 
                            <div class="alert alert-success">
                            {{     session('status')     }} 
                            </div>
                        @endif            
                        <form action="{{ url('edit/product/insert/'.$single_id_info->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="hidden" name="product_id" value="{{ $single_id_info->id }}">
                                    <input type="text" class="form-control" placeholder= "Enter Your Product Name" name="product_name" value="{{ $single_id_info->product_name }}">                      
                                </div>                              
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea name="product_description" class="form-control " rows="3">{{$single_id_info->product_description}}</textarea>                      
                            </div>   
                            <div class="form-group">
                                <label>Product Price </label>
                                <input type="text" class="form-control" placeholder="Enter Your Product Price" name="product_price" value="{{ $single_id_info->product_price }}">                      
                            </div>  
                            <div class="form-group">
                                        <label>Product Quantity</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Product Quantity" name="product_quantity" value="{{ $single_id_info->product_quantity }}">                      
                             </div>   
                            <div class="form-group">
                                <label>Alert Quantity</label> 
                                <input type="text" class="form-control" placeholder="Enter Your Product Alert " name="alert_quantity" value="{{ $single_id_info->alert_quantity}}" >                      
                            </div>     
                            <div class="form-group">
                                <label>Product Image</label> 
                                <input type="file" class="form-control"  name="product_image"> 
                                <img src="{{ asset('uploads/product_photos')}}/{{$single_id_info->product_image}}" alt="Not found" width="100">                     
                            </div>                                  
                        <button type="submit" class="btn btn-warning">Edit Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection