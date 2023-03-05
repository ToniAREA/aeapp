<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Clients
    Route::delete('clients/destroy', 'ClientsController@massDestroy')->name('clients.massDestroy');
    Route::post('clients/parse-csv-import', 'ClientsController@parseCsvImport')->name('clients.parseCsvImport');
    Route::post('clients/process-csv-import', 'ClientsController@processCsvImport')->name('clients.processCsvImport');
    Route::resource('clients', 'ClientsController');

    // Boats
    Route::delete('boats/destroy', 'BoatsController@massDestroy')->name('boats.massDestroy');
    Route::post('boats/parse-csv-import', 'BoatsController@parseCsvImport')->name('boats.parseCsvImport');
    Route::post('boats/process-csv-import', 'BoatsController@processCsvImport')->name('boats.processCsvImport');
    Route::resource('boats', 'BoatsController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::resource('content-categories', 'ContentCategoryController');

    // Content Tag
    Route::delete('content-tags/destroy', 'ContentTagController@massDestroy')->name('content-tags.massDestroy');
    Route::resource('content-tags', 'ContentTagController');

    // Content Page
    Route::delete('content-pages/destroy', 'ContentPageController@massDestroy')->name('content-pages.massDestroy');
    Route::post('content-pages/media', 'ContentPageController@storeMedia')->name('content-pages.storeMedia');
    Route::post('content-pages/ckmedia', 'ContentPageController@storeCKEditorImages')->name('content-pages.storeCKEditorImages');
    Route::resource('content-pages', 'ContentPageController');

    // Wlogs
    Route::delete('wlogs/destroy', 'WlogsController@massDestroy')->name('wlogs.massDestroy');
    Route::post('wlogs/parse-csv-import', 'WlogsController@parseCsvImport')->name('wlogs.parseCsvImport');
    Route::post('wlogs/process-csv-import', 'WlogsController@processCsvImport')->name('wlogs.processCsvImport');
    Route::resource('wlogs', 'WlogsController');

    // Wlist
    Route::delete('wlists/destroy', 'WlistController@massDestroy')->name('wlists.massDestroy');
    Route::post('wlists/parse-csv-import', 'WlistController@parseCsvImport')->name('wlists.parseCsvImport');
    Route::post('wlists/process-csv-import', 'WlistController@processCsvImport')->name('wlists.processCsvImport');
    Route::resource('wlists', 'WlistController');

    // M Logs
    Route::delete('m-logs/destroy', 'MLogsController@massDestroy')->name('m-logs.massDestroy');
    Route::post('m-logs/parse-csv-import', 'MLogsController@parseCsvImport')->name('m-logs.parseCsvImport');
    Route::post('m-logs/process-csv-import', 'MLogsController@processCsvImport')->name('m-logs.processCsvImport');
    Route::resource('m-logs', 'MLogsController');

    // To Do
    Route::delete('to-dos/destroy', 'ToDoController@massDestroy')->name('to-dos.massDestroy');
    Route::post('to-dos/media', 'ToDoController@storeMedia')->name('to-dos.storeMedia');
    Route::post('to-dos/ckmedia', 'ToDoController@storeCKEditorImages')->name('to-dos.storeCKEditorImages');
    Route::resource('to-dos', 'ToDoController');

    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
