<?php

Route::view('/', 'welcome');
Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', '2fa', 'admin']], function () {
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
    Route::post('content-categories/media', 'ContentCategoryController@storeMedia')->name('content-categories.storeMedia');
    Route::post('content-categories/ckmedia', 'ContentCategoryController@storeCKEditorImages')->name('content-categories.storeCKEditorImages');
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
    Route::post('wlists/media', 'WlistController@storeMedia')->name('wlists.storeMedia');
    Route::post('wlists/ckmedia', 'WlistController@storeCKEditorImages')->name('wlists.storeCKEditorImages');
    Route::post('wlists/parse-csv-import', 'WlistController@parseCsvImport')->name('wlists.parseCsvImport');
    Route::post('wlists/process-csv-import', 'WlistController@processCsvImport')->name('wlists.processCsvImport');
    Route::resource('wlists', 'WlistController');

    // To Do
    Route::delete('to-dos/destroy', 'ToDoController@massDestroy')->name('to-dos.massDestroy');
    Route::post('to-dos/media', 'ToDoController@storeMedia')->name('to-dos.storeMedia');
    Route::post('to-dos/ckmedia', 'ToDoController@storeCKEditorImages')->name('to-dos.storeCKEditorImages');
    Route::resource('to-dos', 'ToDoController');

    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::post('product-categories/parse-csv-import', 'ProductCategoryController@parseCsvImport')->name('product-categories.parseCsvImport');
    Route::post('product-categories/process-csv-import', 'ProductCategoryController@processCsvImport')->name('product-categories.processCsvImport');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::post('product-tags/parse-csv-import', 'ProductTagController@parseCsvImport')->name('product-tags.parseCsvImport');
    Route::post('product-tags/process-csv-import', 'ProductTagController@processCsvImport')->name('product-tags.processCsvImport');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // Marinas
    Route::delete('marinas/destroy', 'MarinasController@massDestroy')->name('marinas.massDestroy');
    Route::post('marinas/parse-csv-import', 'MarinasController@parseCsvImport')->name('marinas.parseCsvImport');
    Route::post('marinas/process-csv-import', 'MarinasController@processCsvImport')->name('marinas.processCsvImport');
    Route::resource('marinas', 'MarinasController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::post('contact-companies/parse-csv-import', 'ContactCompanyController@parseCsvImport')->name('contact-companies.parseCsvImport');
    Route::post('contact-companies/process-csv-import', 'ContactCompanyController@processCsvImport')->name('contact-companies.processCsvImport');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::post('contact-contacts/parse-csv-import', 'ContactContactsController@parseCsvImport')->name('contact-contacts.parseCsvImport');
    Route::post('contact-contacts/process-csv-import', 'ContactContactsController@processCsvImport')->name('contact-contacts.processCsvImport');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::post('employees/parse-csv-import', 'EmployeesController@parseCsvImport')->name('employees.parseCsvImport');
    Route::post('employees/process-csv-import', 'EmployeesController@processCsvImport')->name('employees.processCsvImport');
    Route::resource('employees', 'EmployeesController');

    // Boats Type
    Route::delete('boats-types/destroy', 'BoatsTypeController@massDestroy')->name('boats-types.massDestroy');
    Route::resource('boats-types', 'BoatsTypeController');

    // Provider
    Route::delete('providers/destroy', 'ProviderController@massDestroy')->name('providers.massDestroy');
    Route::post('providers/media', 'ProviderController@storeMedia')->name('providers.storeMedia');
    Route::post('providers/ckmedia', 'ProviderController@storeCKEditorImages')->name('providers.storeCKEditorImages');
    Route::post('providers/parse-csv-import', 'ProviderController@parseCsvImport')->name('providers.parseCsvImport');
    Route::post('providers/process-csv-import', 'ProviderController@processCsvImport')->name('providers.processCsvImport');
    Route::resource('providers', 'ProviderController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::post('brands/parse-csv-import', 'BrandsController@parseCsvImport')->name('brands.parseCsvImport');
    Route::post('brands/process-csv-import', 'BrandsController@processCsvImport')->name('brands.processCsvImport');
    Route::resource('brands', 'BrandsController');

    // Tags
    Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagsController');

    // Mlog
    Route::delete('mlogs/destroy', 'MlogController@massDestroy')->name('mlogs.massDestroy');
    Route::post('mlogs/parse-csv-import', 'MlogController@parseCsvImport')->name('mlogs.parseCsvImport');
    Route::post('mlogs/process-csv-import', 'MlogController@processCsvImport')->name('mlogs.processCsvImport');
    Route::resource('mlogs', 'MlogController');

    // Proforma
    Route::delete('proformas/destroy', 'ProformaController@massDestroy')->name('proformas.massDestroy');
    Route::post('proformas/parse-csv-import', 'ProformaController@parseCsvImport')->name('proformas.parseCsvImport');
    Route::post('proformas/process-csv-import', 'ProformaController@processCsvImport')->name('proformas.processCsvImport');
    Route::resource('proformas', 'ProformaController');

    // Claim
    Route::delete('claims/destroy', 'ClaimController@massDestroy')->name('claims.massDestroy');
    Route::resource('claims', 'ClaimController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
        Route::post('profile/two-factor', 'ChangePasswordController@toggleTwoFactor')->name('password.toggleTwoFactor');
    }
});
Route::group(['as' => 'frontend.', 'namespace' => 'Frontend', 'middleware' => ['auth', '2fa']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

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
    Route::resource('clients', 'ClientsController');

    // Boats
    Route::delete('boats/destroy', 'BoatsController@massDestroy')->name('boats.massDestroy');
    Route::resource('boats', 'BoatsController');

    // Content Category
    Route::delete('content-categories/destroy', 'ContentCategoryController@massDestroy')->name('content-categories.massDestroy');
    Route::post('content-categories/media', 'ContentCategoryController@storeMedia')->name('content-categories.storeMedia');
    Route::post('content-categories/ckmedia', 'ContentCategoryController@storeCKEditorImages')->name('content-categories.storeCKEditorImages');
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
    Route::resource('wlogs', 'WlogsController');

    // Wlist
    Route::delete('wlists/destroy', 'WlistController@massDestroy')->name('wlists.massDestroy');
    Route::post('wlists/media', 'WlistController@storeMedia')->name('wlists.storeMedia');
    Route::post('wlists/ckmedia', 'WlistController@storeCKEditorImages')->name('wlists.storeCKEditorImages');
    Route::resource('wlists', 'WlistController');

    // To Do
    Route::delete('to-dos/destroy', 'ToDoController@massDestroy')->name('to-dos.massDestroy');
    Route::post('to-dos/media', 'ToDoController@storeMedia')->name('to-dos.storeMedia');
    Route::post('to-dos/ckmedia', 'ToDoController@storeCKEditorImages')->name('to-dos.storeCKEditorImages');
    Route::resource('to-dos', 'ToDoController');

    // Priorities
    Route::delete('priorities/destroy', 'PrioritiesController@massDestroy')->name('priorities.massDestroy');
    Route::resource('priorities', 'PrioritiesController');

    // Appointments
    Route::delete('appointments/destroy', 'AppointmentsController@massDestroy')->name('appointments.massDestroy');
    Route::resource('appointments', 'AppointmentsController');

    // Product Category
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Product Tag
    Route::delete('product-tags/destroy', 'ProductTagController@massDestroy')->name('product-tags.massDestroy');
    Route::resource('product-tags', 'ProductTagController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Marinas
    Route::delete('marinas/destroy', 'MarinasController@massDestroy')->name('marinas.massDestroy');
    Route::resource('marinas', 'MarinasController');

    // Contact Company
    Route::delete('contact-companies/destroy', 'ContactCompanyController@massDestroy')->name('contact-companies.massDestroy');
    Route::resource('contact-companies', 'ContactCompanyController');

    // Contact Contacts
    Route::delete('contact-contacts/destroy', 'ContactContactsController@massDestroy')->name('contact-contacts.massDestroy');
    Route::resource('contact-contacts', 'ContactContactsController');

    // Employees
    Route::delete('employees/destroy', 'EmployeesController@massDestroy')->name('employees.massDestroy');
    Route::post('employees/media', 'EmployeesController@storeMedia')->name('employees.storeMedia');
    Route::post('employees/ckmedia', 'EmployeesController@storeCKEditorImages')->name('employees.storeCKEditorImages');
    Route::resource('employees', 'EmployeesController');

    // Boats Type
    Route::delete('boats-types/destroy', 'BoatsTypeController@massDestroy')->name('boats-types.massDestroy');
    Route::resource('boats-types', 'BoatsTypeController');

    // Provider
    Route::delete('providers/destroy', 'ProviderController@massDestroy')->name('providers.massDestroy');
    Route::post('providers/media', 'ProviderController@storeMedia')->name('providers.storeMedia');
    Route::post('providers/ckmedia', 'ProviderController@storeCKEditorImages')->name('providers.storeCKEditorImages');
    Route::resource('providers', 'ProviderController');

    // Brands
    Route::delete('brands/destroy', 'BrandsController@massDestroy')->name('brands.massDestroy');
    Route::post('brands/media', 'BrandsController@storeMedia')->name('brands.storeMedia');
    Route::post('brands/ckmedia', 'BrandsController@storeCKEditorImages')->name('brands.storeCKEditorImages');
    Route::resource('brands', 'BrandsController');

    // Tags
    Route::delete('tags/destroy', 'TagsController@massDestroy')->name('tags.massDestroy');
    Route::resource('tags', 'TagsController');

    // Mlog
    Route::delete('mlogs/destroy', 'MlogController@massDestroy')->name('mlogs.massDestroy');
    Route::resource('mlogs', 'MlogController');

    // Proforma
    Route::delete('proformas/destroy', 'ProformaController@massDestroy')->name('proformas.massDestroy');
    Route::resource('proformas', 'ProformaController');

    // Claim
    Route::delete('claims/destroy', 'ClaimController@massDestroy')->name('claims.massDestroy');
    Route::resource('claims', 'ClaimController');

    Route::get('frontend/profile', 'ProfileController@index')->name('profile.index');
    Route::post('frontend/profile', 'ProfileController@update')->name('profile.update');
    Route::post('frontend/profile/destroy', 'ProfileController@destroy')->name('profile.destroy');
    Route::post('frontend/profile/password', 'ProfileController@password')->name('profile.password');
    Route::post('profile/toggle-two-factor', 'ProfileController@toggleTwoFactor')->name('profile.toggle-two-factor');
});
Route::group(['namespace' => 'Auth', 'middleware' => ['auth', '2fa']], function () {
    // Two Factor Authentication
    if (file_exists(app_path('Http/Controllers/Auth/TwoFactorController.php'))) {
        Route::get('two-factor', 'TwoFactorController@show')->name('twoFactor.show');
        Route::post('two-factor', 'TwoFactorController@check')->name('twoFactor.check');
        Route::get('two-factor/resend', 'TwoFactorController@resend')->name('twoFactor.resend');
    }
});
