<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Boats
    Route::apiResource('boats', 'BoatsApiController');

    // Wlogs
    Route::apiResource('wlogs', 'WlogsApiController');

    // Wlist
    Route::post('wlists/media', 'WlistApiController@storeMedia')->name('wlists.storeMedia');
    Route::apiResource('wlists', 'WlistApiController');

    // Appointments
    Route::apiResource('appointments', 'AppointmentsApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Marinas
    Route::apiResource('marinas', 'MarinasApiController');

    // Employees
    Route::post('employees/media', 'EmployeesApiController@storeMedia')->name('employees.storeMedia');
    Route::apiResource('employees', 'EmployeesApiController');

    // Provider
    Route::post('providers/media', 'ProviderApiController@storeMedia')->name('providers.storeMedia');
    Route::apiResource('providers', 'ProviderApiController');

    // Brands
    Route::post('brands/media', 'BrandsApiController@storeMedia')->name('brands.storeMedia');
    Route::apiResource('brands', 'BrandsApiController');
});
