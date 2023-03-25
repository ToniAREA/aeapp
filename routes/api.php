<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Clients
    Route::apiResource('clients', 'ClientsApiController');

    // Boats
    Route::apiResource('boats', 'BoatsApiController');

    // Wlogs
    Route::apiResource('wlogs', 'WlogsApiController');

    // Wlist
    Route::apiResource('wlists', 'WlistApiController');

    // Appointments
    Route::apiResource('appointments', 'AppointmentsApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Marinas
    Route::apiResource('marinas', 'MarinasApiController');

    // Employees
    Route::apiResource('employees', 'EmployeesApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Provider
    Route::post('providers/media', 'ProviderApiController@storeMedia')->name('providers.storeMedia');
    Route::apiResource('providers', 'ProviderApiController');

    // Brands
    Route::apiResource('brands', 'BrandsApiController');
});
