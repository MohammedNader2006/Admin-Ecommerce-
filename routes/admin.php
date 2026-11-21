<?php

use App\Http\Controllers\Admin\AdminAuth;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\ColorsController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\MallsController;
use App\Http\Controllers\Admin\ManufactController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\SizesController;
use App\Http\Controllers\Admin\StatesController;
use App\Http\Controllers\Admin\TradeMarkController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\WeightsController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;



Route::group(['prefix' => 'admin', 'middleware' => 'Lang'], function () {
Config::set('auth.defaults.guard', 'admin');



Route::get('login',[AdminAuth::class,'login']);
Route::post('login',[AdminAuth::class,'dologin'])->middleware('throttle:5,1');
Route::get('forgot/password',[AdminAuth::class,'forgot_password']);
Route::post('forgot/password',[AdminAuth::class,'forgot_password_post']);
Route::get('reset/password/{token}',[AdminAuth::class,'reset_password']);
Route::post('reset/password/{token}',[AdminAuth::class,'reset_password_final']);


Route::group(['middleware'=>'admin:admin'],function(){

    Route::resource('admin',AdminController::class);
    Route::delete('admin/destroy/all/',[AdminController::class,'multi_delete']);


    Route::resource('users', UsersController::class);
    Route::delete('users/destroy/all/',[UsersController::class,'multi_delete']);

    Route::resource('countries', CountriesController::class);
    Route::delete('countries/destroy/all/',[CountriesController::class,'multi_delete']);

    Route::resource('cities', CitiesController::class);
    Route::delete('cities/destroy/all/',[CitiesController::class,'multi_delete']);

    Route::resource('states', StatesController::class);
    Route::delete('states/destroy/all/',[StatesController::class,'multi_delete']);

    Route::resource('trademarks', TradeMarkController::class);
    Route::delete('trademarks/destroy/all/',[TradeMarkController::class,'multi_delete']);

    Route::resource('manufacturers', ManufactController::class);
    Route::delete('manufacturers/destroy/all/',[ManufactController::class,'multi_delete']);

    Route::resource('shipping', ShippingController::class);
    Route::delete('shipping/destroy/all/',[ShippingController::class,'multi_delete']);

    Route::resource('malls', MallsController::class);
    Route::delete('malls/destroy/all/',[MallsController::class,'multi_delete']);

    Route::resource('colors', ColorsController::class);
    Route::delete('colors/destroy/all/',[ColorsController::class,'multi_delete']);

    Route::resource('sizes', SizesController::class);
    Route::delete('sizes/destroy/all/',[SizesController::class,'multi_delete']);

    Route::resource('weights', WeightsController::class);
    Route::delete('weights/destroy/all/',[WeightsController::class,'multi_delete']);

   Route::resource('products', ProductsController::class);
				Route::delete('products/destroy/all', [ProductsController::class,'multi_delete']);
				Route::post('products/search', [ProductsController::class,'product_search']);
				Route::post('products/copy/{pid}', [ProductsController::class,'copy_product']);
				Route::post('upload/image/{pid}', [ProductsController::class,'upload_file']);
				Route::post('delete/image', [ProductsController::class,'delete_file']);
				Route::post('update/image/{pid}', [ProductsController::class,'update_product_image']);
				Route::post('delete/product/image/{pid}', [ProductsController::class,'delete_main_image']);
				Route::post('load/wight/size', [ProductsController::class,'prepare_weight_size']);

    Route::resource('departments', DepartmentController::class);


    Route::get('/', function () {
        return view('admin.home');
    });

Route::get('settings', [SettingController::class,'setting']);
Route::post('settings', [SettingController::class,'setting_save']);
Route::any('logout',[AdminAuth::class,'logout']);
    });

    Route::get('lang/{lang}', function ($lang) {
        session()->has('lang')?session()->forget('lang'):"";
        session()->put('lang', $lang == 'ar' ? 'ar' : 'en');

        return back();
    });
});


