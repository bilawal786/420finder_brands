<?php

use App\Http\Controllers\ApproveController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['namespace' =>'App\Http\Controllers'], function() {
Route::get('/', [
    'uses' => 'AdminController@login',
    'as' => 'login'
]);

Route::post('/check-login', [

    'uses' => 'AdminController@checkLogin',
    'as' => 'checkLogin'

]);

Route::post('/business-authentication', [

    'uses' => 'BusinessController@authenticate',
    'as' => 'authenticate'

]);

});

Route::group(['namespace' =>'App\Http\Controllers', 'middleware' => ['checkIfAuthenticated']], function() {
    Route::get('/business-logout', [

        'uses' => 'BusinessController@businesslogout',
        'as' => 'businesslogout'

    ]);
});
Route::get('/redirect-to-brands/{id}', function ($id){

    $business = \App\Models\Business::find($id);
    \Illuminate\Support\Facades\Session::put('business_id', $id);
    \Illuminate\Support\Facades\Session::put('business_name', $business->business_name);
    \Illuminate\Support\Facades\Session::put('business_type', $business->business_type);
    \Illuminate\Support\Facades\Session::put('business_email', $business->email);
    \Illuminate\Support\Facades\Session::put('first_name', $business->first_name);
    \Illuminate\Support\Facades\Session::put('last_name', $business->last_name);
    return redirect()->route('index');
});

Route::group(['namespace' =>'App\Http\Controllers', 'middleware' => ['checkIfAuthenticated', 'checkIfApproved']], function() {

    Route::post('/gettypesubcategories', [

        'uses' => 'WebsiteController@gettypesubcategories',
        'as' => 'gettypesubcategories'

    ]);

    // Ajax Call
    Route::post('/getrequestedproductslist', [

        'uses' => 'BrandController@getrequestedproductslist',
        'as' => 'getrequestedproductslist'

    ]);

    Route::post('/gettypesubcat', [

        'uses' => 'BrandController@gettypesubcat',
        'as' => 'gettypesubcat'

    ]);

    Route::post('/getparentchildsc', [

        'uses' => 'BrandController@getparentchildsc',
        'as' => 'getparentchildsc'

    ]);

    Route::get('/business/stores/create', [

        'uses' => 'WebsiteController@addnewstore',
        'as' => 'addnewstore'

    ]);

    Route::post('/business/stores/save', [

        'uses' => 'WebsiteController@savenewstore',
        'as' => 'savenewstore'

    ]);


    Route::post('/brand/product/save', [

        'uses' => 'BrandController@savebrandproduct',
        'as' => 'savebrandproduct'

    ]);

    Route::get('/brand/product/edit/{brand_id}/{product_id}', [

        'uses' => 'BrandController@editbrandproduct',
        'as' => 'editbrandproduct'

    ]);

    Route::get('/brand/gallery/remove/{id}', [

        'uses' => 'BrandController@removegalleryimage',
        'as' => 'removegalleryimage'

    ]);

    Route::post('/brand/product/update', [

        'uses' => 'BrandController@updatebrandproduct',
        'as' => 'updatebrandproduct'

    ]);

    // Brands

    Route::get('/dashboard/brands', [

        'uses' => 'BrandController@index',
        'as' => 'dashboardbrands'

    ]);

    Route::get('/brands/create', [

        'uses' => 'BrandController@create',
        'as' => 'dashboardbrandscreate'

    ]);

    Route::post('/brands/crete/save', [

        'uses' => 'BrandController@save',
        'as' => 'savebrand'

    ]);

    Route::get('/brands/edit/{id}', [

        'uses' => 'BrandController@edit',
        'as' => 'eidtdashboardbrand'

    ]);

    Route::post('/brands/update', [

        'uses' => 'BrandController@update',
        'as' => 'updatebrand'

    ]);

    Route::get('/brand/{id}', [

        'uses' => 'BrandController@view',
        'as' => 'viewprofilebrand'

    ]);
    Route::get('/account/setting/{id}', [

        'uses' => 'BrandController@accountSetting',
        'as' => 'accountSettingBrand'

    ]);

    Route::get('/states/brand/{id}', [

        'uses' => 'BrandController@brandStates',
        'as' => 'brandStates'

    ]);
    Route::post('/addstate/{id}', [

        'uses' => 'BrandController@addstate',
        'as' => 'addstate'

    ]);
    Route::get('/delete/brand/state/{id}', [

        'uses' => 'BrandController@deleteState',
        'as' => 'deleteState'

    ]);

    Route::get('/brand/{slug}/{id}/payment', [

        'uses' => 'BrandController@brandPayments',
        'as' => 'managebrandpayments'
    ]);

    // STORE BRAND PAYMENT
    Route::post('/brand/payment', [
        'uses' => 'BrandController@storeBrandPayment',
        'as' => 'storebrandpayment'
    ]);

    Route::get('/brand/products/{id}', [

        'uses' => 'BrandController@products',
        'as' => 'managebrandproducts'

    ]);

    Route::get('/brands/feeds/{id}', [

        'uses' => 'BrandController@viewbrandfeeds',
        'as' => 'viewbrandfeeds'

    ]);

    Route::post('/brands/feed/save', [

        'uses' => 'BrandController@savebrandfeed',
        'as' => 'savebrandfeed'

    ]);

    Route::get('/brands/feed/remove/{id}', [

        'uses' => 'BrandController@removebrandfeed',
        'as' => 'removebrandfeed'

    ]);

    Route::post('/getfeedsingle', [

        'uses' => 'BrandController@getfeedsingle',
        'as' => 'getfeedsingle'

    ]);

    Route::post('/brands/feeds/update', [

        'uses' => 'BrandController@updatebrandfeed',
        'as' => 'updatebrandfeed'

    ]);

    Route::get('/brands/verified-retailers/{id}', [

        'uses' => 'BrandController@manageverifications',
        'as' => 'manageverifications'

    ]);

    Route::get('/brands/product/request/approve/{id}', [

        'uses' => 'BrandController@approveproductrequest',
        'as' => 'approveproductrequest'

    ]);

    Route::get('/brands/product/request/reject/{id}', [

        'uses' => 'BrandController@rejectproductrequest',
        'as' => 'rejectproductrequest'

    ]);

    Route::get('/brand/{id}/product/create', [

        'uses' => 'BrandController@addbrandproduct',
        'as' => 'addbrandproduct'

    ]);

    Route::get('/index', [

        'uses' => 'BusinessController@businessprofile',
        'as' => 'index'

    ]);

    Route::get('/business/account-settings', [

        'uses' => 'BusinessController@businessaccountsettings',
        'as' => 'businessaccountsettings'

    ]);

    Route::post('/updatefirstname', [

        'uses' => 'BusinessController@updatefirstname',
        'as' => 'updatefirstname'

    ]);

    Route::post('/updatelastname', [

        'uses' => 'BusinessController@updatelastname',
        'as' => 'updatelastname'

    ]);

    Route::post('/updatephonenumber', [

        'uses' => 'BusinessController@updatephonenumber',
        'as' => 'updatephonenumber'

    ]);

    Route::post('/updatebusinessname', [

        'uses' => 'BusinessController@updatebusinessname',
        'as' => 'updatebusinessname'

    ]);

    Route::post('/updateaddresslineone', [

        'uses' => 'BusinessController@updateaddresslineone',
        'as' => 'updateaddresslineone'

    ]);
    Route::post('/updateState', [

        'uses' => 'BusinessController@updateState',
        'as' => 'updateState'

    ]);

    Route::post('/updateaddresslinetwo', [

        'uses' => 'BusinessController@updateaddresslinetwo',
        'as' => 'updateaddresslinetwo'

    ]);

    Route::post('/updatewebsite', [

        'uses' => 'BusinessController@updatewebsite',
        'as' => 'updatewebsite'

    ]);

    Route::get('/business/stores', [

        'uses' => 'StoreController@stores',
        'as' => 'stores'

    ]);
    Route::get('/states', 'StateController@index');


});


Route::group(['middleware' => ['checkIfAuthenticated']], function() {
    Route::get('/approve/failed', [ApproveController::class, 'approveFailed'])->name('approve.failed');
});

