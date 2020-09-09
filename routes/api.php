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
/*Route::post('/employee/update/{id}', 'EmployeeController@update')->name('employee.update');*/
Route::post('/customer/store', 'CustomerController@store')->name('customer.store');
Route::get('/customer/list', 'CustomerController@index')->name('customer.list');
Route::delete('/customer/delete/{id}', 'CustomerController@destroy')->name('customer.list');
