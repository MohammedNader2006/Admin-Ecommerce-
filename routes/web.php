<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware'=>'Maintenance'],function(){

Route::get('/', function () {
return view('style.home'); });
});

Route::get('maintenance',function(){
    if (setting()->status=='open'){
    return redirect('/');
    }
    session()->flash('error', setting()->message_maintenance);
    return view('style.maintenance');
});







