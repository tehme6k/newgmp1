<?php

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layouttest', 'HomeController@test');

Route::get('/new', 'HomeController@new')->name('new');

Auth::routes();

Route::get('pages', function (){
    return view('pages');
});

Route::resource('/vendors', 'VendorsController');
Route::resource('/vendorcoas', 'VendorcoasController');
Route::resource('/bprs', 'BprController');
Route::resource('/mprs', 'MprController');
Route::resource('/categories', 'CategoriesController');
Route::resource('/products', 'ProductsController');
Route::resource('/projects', 'ProjectsController');
Route::resource('/boxes', 'BoxesController');
Route::resource('/users', 'UsersController');
Route::resource('inventories', 'InventoryController')->except('create');

Route::get('/inventories/create/{product}', 'InventoryController@create')->name('inventories.create');
Route::put('/inventories/newfile/{inventory}', 'InventoryController@newFile')->name('inventories.newFile');
Route::put('bprs/{bpr}/approve', 'BprController@approve')->name('bprs.approve');
Route::put('bprs/{bpr}/reject', 'BprController@reject')->name('bprs.reject');
Route::put('mprs/{mpr}/approve', 'MprController@approve')->name('mprs.approve');
Route::post('mprs/add/', 'MprController@addProduct')->name('mpr.add');
Route::put('inventories/{inventory}/approve', 'InventoryController@approve')->name('inventories.approve');
Route::put('inventories/{inventory}/reject', 'InventoryController@reject')->name('inventories.reject');
Route::post('/inventories/powder', 'InventoryController@powderstore')->name('inventories.powder.store');
Route::post('/inventories/nonpowder', 'InventoryController@nonpowderstore')->name('inventories.nonpowder.store');
Route::post('/inventories/recPowder', 'InventoryController@recPowder')->name('inv.rec.powder');
Route::post('/inventories/recNonPowder', 'InventoryController@recNonPowder')->name('inv.rec.non.powder');

Route::post('/inventories/receivepowder', 'InventoryController@rec')->name('inventories.powder.receive');

Route::post('/inventories/receivenonpowder', 'InventoryController@nonpowderReceive')->name('inventories.nonpowder.receive');

Route::get('/boxes/{box}/print', 'BoxesController@print')->name('box.print');


Route::get('/retention/closed', 'RetentionController@closed')->name('ret.closed');
Route::post('retention/add/{box}/', 'RetentionController@add')->name('retention.add');

Route::get('inventory/{inventory}/lot/', 'LotController@show')->name('lot.show');
Route::get('inventory/{inventory}/lot/create/', 'LotController@create')->name('lot.create');
Route::post('inventory/lot/store/', 'LotController@store')->name('lot.store');




Route::put('/reopened/{box}/', 'ReopenController@open')->name('boxes.reopen');
Route::get('/reopened/show/{box}/{reopenedboxes}', 'ReopenController@show')->name('reopen.show');
Route::put('/reopened/box/{box}/{reopenedboxes}', 'ReopenController@close')->name('reopen.close');
