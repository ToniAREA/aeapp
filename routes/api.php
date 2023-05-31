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

    // To Do
    Route::post('to-dos/media', 'ToDoApiController@storeMedia')->name('to-dos.storeMedia');
    Route::apiResource('to-dos', 'ToDoApiController');

    // Appointments
    Route::apiResource('appointments', 'AppointmentsApiController');

    // Product Category
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Marinas
    Route::apiResource('marinas', 'MarinasApiController');

    // Contact Company
    Route::apiResource('contact-companies', 'ContactCompanyApiController');

    // Contact Contacts
    Route::apiResource('contact-contacts', 'ContactContactsApiController');

    // Provider
    Route::post('providers/media', 'ProviderApiController@storeMedia')->name('providers.storeMedia');
    Route::apiResource('providers', 'ProviderApiController');

    // Brands
    Route::post('brands/media', 'BrandsApiController@storeMedia')->name('brands.storeMedia');
    Route::apiResource('brands', 'BrandsApiController');

    // Mlog
    Route::apiResource('mlogs', 'MlogApiController');

    // Proforma
    Route::apiResource('proformas', 'ProformaApiController');

    // Claim
    Route::apiResource('claims', 'ClaimApiController');

    // Payment
    Route::apiResource('payments', 'PaymentApiController');
});
