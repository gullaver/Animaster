<?php

use Illuminate\Support\Facades\Route;
use App\Mail\replyMail;

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
Route::get('/', 'generalController@index')->name('index.index');

Auth::routes();

//Admin Login Management
Route::post('/cplogin', 'adminloginmanage@login')->name('admin.login');
Route::get('/cplogin', 'adminloginmanage@loginindex')->name('admin.loginindex');


//View Contact Page
Route::get('/sendmessage', 'messageController@showcontact')->name('message.message');

//Send Message
Route::post('/sendmessage', 'messageController@sendmessage')->name('message.send');

//Show Category
Route::get("/category/{catename}", "categoriesController@show");

//Show Page
Route::get("/page/{pagename}", "pagesController@show");

//Show Series
Route::get("/series/{id}", "seriesController@show");

//Show Download Page
Route::get('/download/{id}', 'generalController@showdownloadpage');

//Watch Episode
Route::get('/watch/{id}', 'postsController@show');

//Save Comment
Route::post('/comment/{userid}/post/{postid}', 'commentsController@saveComment');

//Search 
Route::post('/search', 'generalController@search');



Route::group(['middleware' => 'admin'], function() 
{
    //Show Dashboard
    Route::get('/dashboard', 'adminController@index')->name('dashboard.index');

    //Show User Chart
    Route::get('/chart/users', 'adminController@userchart');
    
    //Logout
    Route::get('/cplogout', 'adminloginmanage@logout')->name('admin.logout');

    //Show Admin settins
    Route::get('/cp_admin_settings', 'adminController@getAdminSettings')->name('admin.getadminsettings');

    //Check current password - Admin info change
    Route::post('/cp_chk_pwd', 'adminController@chk_pwd')->name('admin.chkpwd');

    //Check current password - password change
    Route::post('/cp_chk_pwd_ch', 'adminController@chk_pwd_ch')->name('admin.chkpwd_ch');

    //Update Admin Info
    Route::post('/cp_update_info', 'adminController@upinfo')->name('admin.upinfo');

    //Update Admin Password
    Route::post('/cp_update_pwd', 'adminController@uppwd')->name('admin.uppwd');

    //Remove Admin image
    Route::post('/cp_profimage_rm', 'adminController@removeAdminImage')->name('admin.imageremove');


    //Admin Posts Resource Controller
    Route::resource('/cp_posts', 'postsController');

    //Admin Posts - Manual store
    Route::post('/cp_posts/store', 'postsController@store');

   /* //Admin Posts create - Show subcategories
    Route::get('/showsubcategories', 'generalController@showsubcates')->name('getmaterial.subcates');
*/
    //Admin Posts Create - Get certain category for selected series
    Route::get('/getseriescategory', 'postsController@getseriescategory');

    //Admin Series Resource Controller
    Route::resource('/cp_series', 'seriesController');

    // Admin Manage Members
    Route::resource("cp_managemem", "managememController");

    // Admin Unblock Members
    Route::get("cp_managemem_unblock/{id}", "managememController@unblock");

    // Admin Members Delete
    Route::get("cp_managemem/{id}/del", "managememController@destroy");

    // Admin Search Member
    Route::post("/cp_searchMember", "managememController@searchMember")->name('member.search');

    // Admin Site Settings Controller
    Route::resource("/cp_ssettings", "sitesettingsController");

    /****************** Delete Routes ******************/
    //Admin Categories delete
    Route::get("cp_categories/{id}/del", "categoriesController@destroy");

    //Admin Pages delete
    Route::get("cp_pages/{id}/del", "pagesController@destroy");

    //Admin Posts delete
    Route::get("cp_posts/{id}/del", "postsController@destroy");

    //Admin Series delete
    Route::get("cp_series/{id}/del", "seriesController@destroy");

    //Admin Categories Resource Controller
    Route::resource('/cp_categories', 'categoriesController');

    //Admin Pages Resource Controller
    Route::resource('/cp_pages','pagesController');

    //Admin Pages Arrangement
    Route::post('/cp_savepagesarrange', 'pagesController@savearrange');

    //Admin Comments Index
    Route::get('/cp_comments', 'commentsController@index')->name('cp_comment.index');

    // Admin Search Comment
    Route::post("/cp_searchcomment", "commentsController@searchcomment");

    // Admin Show Comment
    Route::get("/cp_comment/{id}/show", "commentsController@show");

    // Admin Comments Settings
    Route::get("/cp_commentsettings", "sitesettingsController@settingsshow")->name('comment.settings');

    // Admin Comments Settings
    Route::post("/cp_commentsettingssave", "sitesettingsController@commentsettingsave");

    // Admin Delete Comment
    Route::get("/cp_comment/{id}/del", "commentsController@destroy");

    //Admin Message Show
    Route::get('/showmessages', 'messageController@showMessages')->name('message.show');

    //Admin New Messages Show
    Route::get('/shownewmessages', 'messageController@showNewMessages')->name('newMessage.show');

    //Admin Spec Message Show
    Route::get('/cp_messages/{id}', 'messageController@showMessage');

    //Admin Delete Message
    Route::get('/cp_messages/{id}/del', 'messageController@destroy');

    //Admin Mailing 
    Route::post('/replymail/{senderemail}', 'messageController@forwardmessage');

});