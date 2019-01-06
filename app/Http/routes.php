<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ['as'=>'index',function () {
    return view('welcome');
}]);

Route::get('/hello', function () {
    return view('welcome');
});
Route::get('/login',function () {
    $app=route('index');
    return view('login',['app'=>$app]);
});
Route::get('/card',['as'=>"card",function () {
    $app=route('index');
    return view('card',['app'=>$app]);
}]);
Route::get('/center', function () {
    $app=route('index');
    return view('center',['app'=>$app]);
});
Route::get('/chart', function () {
    $app=route('index');
    return view('chart',['app'=>$app]);
});
Route::group(['middleware'=>['web']],function(){
    Route::get('/api/test1',['uses'=>'UserController@test1']);
    Route::get('/api/test2',['uses'=>'UserController@test2']);
    Route::post('/api/register',['uses'=>'UserController@register']);
    Route::post('/api/login',['uses'=>'UserController@login']);
    Route::post('/aip/card',['uses'=>'CardController@card']);
    Route::get('/api/monthdata',['uses'=>'CardController@getMonthDate']);
    Route::get('/api/counthour',['uses'=>'CardController@countByHour']);
    Route::get('/api/addtodo',['uses'=>'TodoController@add']);
    Route::get('/api/edittodo',['uses'=>'TodoController@edittodo']);
    Route::get('/api/getlist',['uses'=>'TodoController@getList']);
    Route::get('/api/gettodo',['uses'=>'TodoController@gettodo']);
    Route::get('/api/gettoday',['uses'=>'TodoController@getToday']);
    Route::get('/api/deleteTodo',['uses'=>'TodoController@deleteTodo']);
    Route::get('/api/login',['uses'=>'UserController@login']);
    Route::get('/api/register',['uses'=>'UserController@register']);
});
Route::get('api/list/cardType',['uses'=>'CardController@getcardList']);


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});


Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});


