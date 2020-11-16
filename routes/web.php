<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$user_registration = user_registration();

Auth::routes(['verify' => true, 'register' => $user_registration]);

// Socialite routes
// Route::group(['namespace' => 'Auth', 'middleware' => 'guest'], function () {
//     Route::get('login/{provider}', ['as' => 'social.login', 'uses' => 'LoginController@redirectToProvider']);
//     Route::get('login/{provider}/callback', 'LoginController@handleProviderCallback');
// });

// Route::get('/', function () {
//     // return view('errors.404');
//     // dd('abcd');
//     return redirect("admin");
// });

Route::get('/', function () {
    // return view('errors.404');
    dd('abcd');
    // return redirect("admin");
});

// Atom/ RSS Feed Routes
Route::feeds();


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    return redirect("admin/users");
    // return "Cache is cleared";
});


Route::get('/cache', function () {
    // $exitCode = Artisan::call('cache:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');

    return "Cleared!";
});


Route::get('sendbasicemail','MailController@basic_email');


Route::post('sendmailcontact22', function () {

    // mail('cmb@chamaralabs.com', 'Subject Line Here', 'Body of Message Here', 'From: cmb@chamaralabs.com');

    // $details = [
    //     'title' => 'Mail from ItSolutionStuff.com',
    //     'body' => 'This is for testing email using smtp'
    // ];

    // \Mail::send('mail_contact',
    //          array(
    //              'name' => "AAA",
    //              'email' => "BBB",
    //              'subject' => "CCC",
    //              'phone_number' => "DDD",
    //              'user_message' => "EEE",
    //          ), function($message)
    //           {
    //               $message->from("cmbuni2@gmail.com");
    //               $message->to('cmb.info96@gmail.com');
    //           });

    //       return back()->with('success', 'Thank you for contact us!');

    // dd("Email is Sent.");
    return "On the Function post";
});


Route::get('sendmailcontact', 'MailContactUsController@sendmail_contactus');


/*
*
* Frontend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['middleware' => ['cors']], function () {
    Route::get('article/posts/index_data_user', '\Modules\Article\Http\Controllers\Frontend\PostsController@index_data_user')->name('index_data_user');
    Route::get('article/posts/index_data_merchant', '\Modules\Article\Http\Controllers\Frontend\PostsController@index_data_merchant')->name('index_data_merchant');
});

Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/', function () {
        // return view('errors.404');
        // dd(public_path() . '/my_test_1.html');
        return File::get(public_path() . '/index.html');
        // return redirect("admin");
    });
    // Route::get('/', 'FrontendController@index')->name('index'); //chamara
    Route::get('/loading', 'FrontendController@index')->name('index'); //chamara
    // Route::get('home', 'FrontendController@index')->name('home');
    // Route::get('privecy', 'FrontendController@privecy')->name('privecy');
    // Route::get('terms', 'FrontendController@terms')->name('terms');

    Route::get('imagecarousel', 'FrontendController@imagecarousel')->name('imagecarousel');


    Route::group(['middleware' => ['auth']], function () {
        /*
        *
        *  Users Routes
        *
        * ---------------------------------------------------------------------
        */
        $module_name = 'users';
        $controller_name = 'UserController';
        // Route::get("$module_name/{id}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);
        Route::get("profile/{id}", ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
        Route::get('profile/{id}/edit', ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
        Route::patch('profile/{id}/edit', ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
        Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
        Route::get("profile/changePassword/{username}", ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
        Route::patch("profile/changePassword/{username}", ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
        Route::delete('users/userProviderDestroy', ['as' => 'users.userProviderDestroy', 'uses' => 'UserController@userProviderDestroy']);
    });
});

/*
*
* Backend Routes
* These routes need view-backend permission
* --------------------------------------------------------------------
*/
Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', 'can:view_backend']], function () {

    /**
     * Backend Dashboard
     * Namespaces indicate folder structure.
     */
    Route::get('/', 'BackendController@index')->name('home');
    Route::get('dashboard', 'BackendController@index')->name('dashboard');
    // Route::get('fileupload', 'BackendController@fileupload')->name('fileupload');
    // Route::post('fileupload', 'BackendController@fileupload')->name('upload');
    Route::post('upload_job', 'BackendController@upload_job')->name('upload_job');
    Route::post('upload_blog', 'BackendController@upload_blog')->name('upload_blog');

    /*
     *
     *  Settings Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:edit_settings']], function () {
        $module_name = 'settings';
        $controller_name = 'SettingController';
        Route::get("$module_name", "$controller_name@index")->name("$module_name");
        Route::post("$module_name", "$controller_name@store")->name("$module_name.store");
    });


    /*
     *
     *  Job post Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:view_jobposts']], function () {
        $module_name = 'jobposts';
        $controller_name = 'JobPostController';

        Route::get('/testing', "$controller_name@testing")->name('testing');

        Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
        Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
        Route::get("$module_name/{jpid}/active", ['as' => "$module_name.active", 'uses' => "$controller_name@active"]);
        Route::get("$module_name/{jpid}/await", ['as' => "$module_name.await", 'uses' => "$controller_name@await"]);
        Route::get("$module_name/{jpid}/reviewed", ['as' => "$module_name.reviewed", 'uses' => "$controller_name@reviewed"]);
        Route::get("$module_name/{jpid}/allcandi", ['as' => "$module_name.allcandi", 'uses' => "$controller_name@allcandi"]);

        Route::get("$module_name/active_index_data/{jpid}", ['as' => "$module_name.active_index_data", 'uses' => "$controller_name@active_index_data"]);
        Route::get("$module_name/await_index_data/{jpid}", ['as' => "$module_name.await_index_data", 'uses' => "$controller_name@await_index_data"]);
        Route::get("$module_name/reviewed_index_data/{jpid}", ['as' => "$module_name.reviewed_index_data", 'uses' => "$controller_name@reviewed_index_data"]);
        Route::get("$module_name/allcandi_index_data/{jpid}", ['as' => "$module_name.allcandi_index_data", 'uses' => "$controller_name@allcandi_index_data"]);

        Route::resource("$module_name", "$controller_name");
    });


    /*
     *
     *  Client Carousel Routes
     *
     * ---------------------------------------------------------------------
     */
    Route::group(['middleware' => ['permission:access_clients']], function () {
        $module_name = 'carousels';
        $controller_name = 'CarouselController';

        // Route::get('/testing', "$controller_name@testing")->name('testing');

        Route::get("$module_name/tableview", ['as' => "$module_name.tableview", 'uses' => "$controller_name@tableview"]);
        Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
        Route::post("$module_name/orderUpdate", ['as' => "$module_name.orderUpdate", 'uses' => "$controller_name@orderUpdate"]);

        Route::resource("$module_name", "$controller_name");
    });


    Route::group(['middleware' => ['permission:view_jobposts']], function () {
        $module_name = 'jobresponses';
        $controller_name = 'JobResponseController';

        // Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
        Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);

        Route::post("$module_name/set_await", ['as' => "$module_name.set_await", 'uses' => "$controller_name@set_await"]);
        Route::post("$module_name/set_reviewed", ['as' => "$module_name.set_reviewed", 'uses' => "$controller_name@set_reviewed"]);
        Route::post("$module_name/set_reject", ['as' => "$module_name.set_reject", 'uses' => "$controller_name@set_reject"]);

        Route::resource("$module_name", "$controller_name");
    });

    // $module_name = 'jobposts';
    // $controller_name = 'JobPostController';
    // Route::resource("jobposts", "JobPostController");
    // Route::get("$module_name", "$controller_name@index")->name("$module_name");

    /*
    *
    *  Notification Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'notifications';
    $controller_name = 'NotificationsController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/markAllAsRead", ['as' => "$module_name.markAllAsRead", 'uses' => "$controller_name@markAllAsRead"]);
    Route::delete("$module_name/deleteAll", ['as' => "$module_name.deleteAll", 'uses' => "$controller_name@deleteAll"]);
    Route::get("$module_name/{id}", ['as' => "$module_name.show", 'uses' => "$controller_name@show"]);

    /*
    *
    *  Backup Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'backups';
    $controller_name = 'BackupController';
    Route::get("$module_name", ['as' => "$module_name.index", 'uses' => "$controller_name@index"]);
    Route::get("$module_name/create", ['as' => "$module_name.create", 'uses' => "$controller_name@create"]);
    Route::get("$module_name/download/{file_name}", ['as' => "$module_name.download", 'uses' => "$controller_name@download"]);
    Route::get("$module_name/delete/{file_name}", ['as' => "$module_name.delete", 'uses' => "$controller_name@delete"]);

    /*
    *
    *  Roles Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'roles';
    $controller_name = 'RolesController';
    Route::resource("$module_name", "$controller_name");

    /*
    *
    *  Users Routes
    *
    * ---------------------------------------------------------------------
    */
    $module_name = 'users';
    $controller_name = 'UserController';
    Route::get("$module_name/profile/{id}", ['as' => "$module_name.profile", 'uses' => "$controller_name@profile"]);
    Route::get("$module_name/profile/{id}/edit", ['as' => "$module_name.profileEdit", 'uses' => "$controller_name@profileEdit"]);
    Route::patch("$module_name/profile/{id}/edit", ['as' => "$module_name.profileUpdate", 'uses' => "$controller_name@profileUpdate"]);
    Route::get("$module_name/emailConfirmationResend/{id}", ['as' => "$module_name.emailConfirmationResend", 'uses' => "$controller_name@emailConfirmationResend"]);
    Route::delete("$module_name/userProviderDestroy", ['as' => "$module_name.userProviderDestroy", 'uses' => "$controller_name@userProviderDestroy"]);
    Route::get("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePassword", 'uses' => "$controller_name@changeProfilePassword"]);
    Route::patch("$module_name/profile/changeProfilePassword/{id}", ['as' => "$module_name.changeProfilePasswordUpdate", 'uses' => "$controller_name@changeProfilePasswordUpdate"]);
    Route::get("$module_name/changePassword/{id}", ['as' => "$module_name.changePassword", 'uses' => "$controller_name@changePassword"]);
    Route::patch("$module_name/changePassword/{id}", ['as' => "$module_name.changePasswordUpdate", 'uses' => "$controller_name@changePasswordUpdate"]);
    Route::get("$module_name/trashed", ['as' => "$module_name.trashed", 'uses' => "$controller_name@trashed"]);
    Route::patch("$module_name/trashed/{id}", ['as' => "$module_name.restore", 'uses' => "$controller_name@restore"]);
    Route::get("$module_name/index_data", ['as' => "$module_name.index_data", 'uses' => "$controller_name@index_data"]);
    Route::get("$module_name/index_list", ['as' => "$module_name.index_list", 'uses' => "$controller_name@index_list"]);
    Route::resource("$module_name", "$controller_name");
    Route::patch("$module_name/{id}/block", ['as' => "$module_name.block", 'uses' => "$controller_name@block", 'middleware' => ['permission:block_users']]);
    Route::patch("$module_name/{id}/unblock", ['as' => "$module_name.unblock", 'uses' => "$controller_name@unblock", 'middleware' => ['permission:block_users']]);
});
