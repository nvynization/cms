<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::view( '/admin' , 'admin.index');
Route::prefix('admin')->group(function(){
    Route::get('/categories/restore',[CategoryController::class,'restore'])->name('categories.restore');
    Route::resource('/categories',CategoryController::class);
    Route::resource('/departments',DepartmentController::class);
    Route::resource('/roles',RoleController::class);
});

