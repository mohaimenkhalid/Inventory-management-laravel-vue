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
