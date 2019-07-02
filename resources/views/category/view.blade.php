@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 ">
            <div class="card">
                <div class="card-header bg-success">
                   Category Name
                </div>
                <div class="card-body">
                    <div class="card-body">
                        @if (session('deletestatus')  ) 
                            <div class="alert alert-success">
                            {{     session('deletestatus')     }}
                            </div>
                        @endif   
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                            <th>SL. No</th>
                            <th>Category Name</th> 
                            <th>Menu Status</th> 
                            <th>Created_At </th> 
                            <th> Action </th>                      
                            </tr>
                        </thead>
                        <tbody>
                       {{-- single by single  data for catch in a table view  --}}
                             @forelse ($categories as $category)
                                <tr>
                                    <td>{{$loop->index +1 }}</td>
                                    <td>{{$category->category_name}}</td>
                                    <td>{{($category->menu_status == 1)? "yes":"no"}}</td>
                                    <td> 
                                    {{$category ->created_at->format('d-M-Y h:i:s A')}}
                                    <br> 
                                    {{$category ->created_at->diffForHumans()}}
                                 </td>   
                                 <td>
                                 <a href="{{ url('change/menu/status') }}/{{ $category->id }}" class="btn btn-sm btn-info">Change</a>
                                 {{-- <a href="{{ url('change/menu/status ')}}/{{ $category->id}}"class="btn btn-sm btn-info" ">Change</a> --}}
                                 </td> 

                            @empty
                                <tr class="text-center text-danger">
                                    <td colspan="3" >No Data Available</td>
                                </tr>                               
                            @endforelse ($products as $product )                                                         
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
{{-- 
                <div class="card">
                    <div class="card-header bg-danger">
                            Deleted Product 
                    </div>
                    <div class="card-body">
                        <div class="card-body">
    
                        <table class="table table-bordered ">
                            <thead>
                                <tr>
                                <th>SL. No</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Alert Quantity </th>                    
                                <th>Action</th>                        
                                </tr>
                            </thead>
                            <tbody>
                            {{-- single by single  data for catch in a table view  --}}
                                {{-- @forelse ($deleted_products as $deleted_product)
                                    <tr>
                                       <td>{{$loop->index +1 }}</td>
                                        <td>{{$deleted_product->product_name}}</td> 
                                        <td>{{str_limit($deleted_product->product_description,10)}}</td>
                                        <td>{{$deleted_product->product_price}}</td>
                                        <td>{{$deleted_product->product_quantity}}</td>
                                        <td>{{$deleted_product->alert_quantity}}</td>                                      
                                        <td>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ url('/restore/product/'.$deleted_product->id) }}" class="btn btn-sm btn-success">Restore</a>   
                                                        <a href="{{ url('force/delete/product'.$deleted_product->id) }}" class="btn btn-sm btn-danger">Permanent Delete</a>                                                                                
                                                </div>  
                                        </td>                                
                                    </tr>
                                @empty
                                    <tr class="text-center text-danger">
                                        <td colspan="6" >No Data Available</td>
                                    </tr>                               
                                @endforelse ($products as $product )                                                        
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div> --}} 
                {{-- </div> --}}
            </div> 
  <div class="col-4  ">
    <div class="card">
      <div class="card-header bg-success">
         Add Category From
        </div>
         <div class="card-body">
            @if (session('status')  ) 
                <div class="alert alert-success">
                {{     session('status')     }}
            </div>
                @endif  
                @if ($errors->all())
                <div class="alert alert-danger">   
                        @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                        @endforeach   
                </div>               
                @endif                          
                <form action="{{ url('add/category/insert') }}" method="post" >
                @csrf
            <div class="form-group">
                <label>Category Name</label>
            <input type="text" class="form-control" placeholder="Enter Your Category Name" name="category_name" value="{{ old('category_name') }}">                      
            </div>      
            <div class="form-group">
                     <input type="checkbox" name="menu_status" value="1" id="menu"> <label for="menu"> Use as  Menu </label>
                 
                </div>                                                                            
                    <button type="submit" class="btn btn-info">Add Category</button>
                    </form>
                  </div>
               </div>
            </div>        
         </div>
     </div>
</div>

@endsection