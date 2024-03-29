<?php

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::post('/employee/store', 'EmployeeController@store')->name('employee.store');
Route::get('/employee/list', 'EmployeeController@index')->name('employee.list');
Route::delete('/employee/delete/{id}', 'EmployeeController@destroy')->name('employee.list');
Route::get('/employee/edit/{id}', 'EmployeeController@edit')->name('employee.edit');
Route::post('/employee/update/{id}', 'EmployeeController@update')->name('employee.update');

Route::post('/customer/store', 'CustomerController@store')->name('customer.store');
Route::get('/customer/list', 'CustomerController@index')->name('customer.list');
Route::delete('/customer/delete/{id}', 'CustomerController@destroy')->name('customer.list');


Route::post('/supplier/store', 'SupplierController@store')->name('supplier.store');
Route::get('/supplier/list', 'SupplierController@index')->name('supplier.list');
Route::delete('/supplier/delete/{id}', 'SupplierController@destroy')->name('supplier.list');

Route::post('/category/store', 'CategoryController@store')->name('category.store');
Route::get('/category/list', 'CategoryController@index')->name('category.list');
Route::delete('/category/delete/{id}', 'CategoryController@destroy')->name('category.list');

Route::get('/product/list', 'ProductController@index')->name('product.index');
Route::post('/product/store', 'ProductController@store')->name('product.store');
Route::get('/product/edit/{id}', 'ProductController@edit')->name('product.edit');
Route::post('/product/update/{id}', 'ProductController@update')->name('product.update');
Route::delete('/product/delete/{id}', 'ProductController@delete')->name('product.delete');

