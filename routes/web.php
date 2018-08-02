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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/homepage', function () {
    return view('index');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
// Sửa đường dẫn trang chủ mặc định
Route::get('/', 'PagesController@index');

Route::get('/home', [ 'as' => 'home', 'uses'=> 'HomeController@index']);

Route::get('/homeadmin', [ 'as' => 'homeadmin', 'uses' => 'HomeController@homeadmin']);

// Đăng ký thành viên
Route::get('register', [ 'as' => 'register', 'uses' => 'Auth\RegisterController@getRegister']);
Route::post('register', [ 'as' => 'register', 'uses' => 'Auth\RegisterController@postRegister']);

// Đăng nhập và xử lý đăng nhập
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);

// Đăng xuất
Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);

//
//trả về trang chủ
Route::get('trang-chu', [
    'as'=>'trangchu',
    'uses'=>'PagesController@getIndex'
]);
//lấy sản phẩm
Route::get('san-pham', [
    'as'=>'sanpham',
    'uses'=>'PagesController@getProduct'
]);
//hiển thị chi tiết sản phẩm
Route::get('chi-tiet', [
    'as'=>'chitiet',
    'uses'=>'PagesController@getProductDetail'
]);
//hiển thị trang thanh toan
Route::get('thanh-toan', [
    'as'=>'chitiet',
    'uses'=>'PagesController@getPayment'
]);