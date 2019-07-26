<?php

//useなし

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

//<form>タグのアクションでweb.phpが動く


//デフォルトでlocalhost8000ででるページ
// Route::get('/', function () {
//     return view('welcome');
// });

//デフォルトでloginフォーム画面が出るように設定(URL localhost:8000と入れると飛ぶ)
//ログインが完了しない限り、他のページに飛ばない(8000/homeとURLに入れても飛ばない)
Route::get('/','HomeController@index')->name('home');

Route::post('/books','BookController@store');

//bookedit　の　{book} ->bookid　@はファンクション　idはbook.blade.phpをみてみよ
Route::post('/bookedit/{book}','BookController@edit');

Auth::routes();

//ログインが成功したら以下に移動する　//HomeController.php のviewに設定したbook.blade.phpに飛ぶ
Route::get('/home', 'HomeController@index')->name('home');

//更新ボタンを押したら
Route::post('/book/update','BookController@update');

//削除ボタン押したら {book}=本のid
Route::delete('/book/{book}','BookController@destroy');



