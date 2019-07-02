<?php
//  use Symfony\Component\Routing\Route;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('add/product/view','ProductController@addproductview');
Route::post('add/product/insert','ProductController@addproductinsert');
Route::get('delete/product/{id}','ProductController@deleteproduct');
Route::get('edit/product/{id}','ProductController@editproduct');
Route::post('edit/product/insert/{id}','ProductController@editproductinsert');
Route::get('restore/product/{id}','ProductController@restoreproduct');
Route::get('force/delete/product{id}','ProductController@forcedeleteproduct');
Route::get('add/Category/view','CategoryController@addCategoryview');
Route::post('add/category/insert','CategoryController@addCategoryinsert');
Route::get('change/menu/status/{category_id}','HomeController@changemenustatus');

    

 




//frontend Route
Route::get('/','FrontendController@index');
Route::get('/product/details/{id}','FrontendController@productdetails');
Route::get('/category/wise/product/{category_id}','FrontendController@categorywiseproduct');



    
