<?php

/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Article\Http\Controllers\Frontend', 'as' => 'frontend.', 'middleware' => 'web'], function () {   #, 'prefix' => 'article'

    /*
     *
     *  Posts Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'posts';
    $controller_name = 'PostsController';
    Route::get("blog", ['as' => "$module_name.index_user", 'uses' => "$controller_name@index_user"]);
    Route::get("merchant/blog", ['as' => "$module_name.index_merchant", 'uses' => "$controller_name@index_merchant"]);
    Route::get("$module_name/index_data_user", ['as' => "$module_name.index_data_user", 'uses' => "$controller_name@index_data_user"]);//api end point
    Route::get("$module_name/index_data_merchant", ['as' => "$module_name.index_data_merchant", 'uses' => "$controller_name@index_data_merchant"]);//api end point

    Route::get("blog/{id}/{slug?}", ['as' => "$module_name.show_user", 'uses' => "$controller_name@show"]);
    Route::get("merchant/blog/{id}/{slug?}", ['as' => "$module_name.show_merchant", 'uses' => "$controller_name@show"]);

    /*
     *
     *  Categories Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'categories';
    $controller_name = 'CategoriesController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/{id}/{slug?}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);
});

Route::group(['namespace' => '\App\Http\Controllers\Frontend', 'as' => 'frontend.', 'middleware' => 'web'], function () {# 'prefix' =>'jobs'

    /*
     *
     * Jobs Posts Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'jobposts';
    $route_name='careers';
    $controller_name = 'JobpostController';
    Route::get("$route_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$route_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$route_name/index_datatable", ['as' => "$module_name.index_datatable", 'uses' => "$controller_name@index_datatable"]);
    Route::get("$route_name/{id}/{slug?}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);
    Route::post("$route_name/uploadcv", ['as' => "$module_name.uploadcv", 'uses' => "$controller_name@uploadcv"]);

});

/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['namespace' => '\Modules\Article\Http\Controllers\Backend', 'as' => 'backend.', 'middleware' => ['web', 'auth', 'can:view_backend'], 'prefix' => 'admin'], function () {
    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Posts Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'posts';
    $controller_name = 'PostsController';
    Route::get("$module_name/index_user", ['as' => "$module_name.index_user", 'uses' => "$controller_name@index_user"]);
    Route::get("$module_name/index_merchant", ['as' => "$module_name.index_merchant", 'uses' => "$controller_name@index_merchant"]);

    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);

    Route::get("$module_name/list_published", ['as' => "$module_name.list_published", 'uses' => "$controller_name@list_published"]);
    Route::get("$module_name/list_unpublished", ['as' => "$module_name.list_unpublished", 'uses' => "$controller_name@list_unpublished"]);
    Route::get("$module_name/list_draft", ['as' => "$module_name.list_draft", 'uses' => "$controller_name@list_draft"]);
    Route::get("$module_name/list_all", ['as' => "$module_name.list_all", 'uses' => "$controller_name@list_all"]);

    Route::get("$module_name/index_data/{view_mode}", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::resource("$module_name", "$controller_name");

    /*
     *
     *  Categories Routes
     *
     * ---------------------------------------------------------------------
     */
    $module_name = 'categories';
    $controller_name = 'CategoriesController';
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::resource("$module_name", "$controller_name");
});
