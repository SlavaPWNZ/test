<?php

Route::get('/', 'MainController@index');

Route::get('getCategories', 'MainController@getCategories');
Route::get('getItems', 'MainController@getItems');

Route::get('auth', 'MainController@auth');
Route::get('createUser', 'MainController@createUser');

Route::get('createCategory', 'MainController@createCategory');
Route::get('changeCategory', 'MainController@changeCategory');
Route::get('deleteCategory', 'MainController@deleteCategory');

Route::get('createItem', 'MainController@createItem');
Route::get('changeItem', 'MainController@changeItem');
Route::get('deleteItem', 'MainController@deleteItem');

