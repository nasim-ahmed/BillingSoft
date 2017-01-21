<?php



use App\Record;
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
    Route::get('/', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('/handleLogin', ['as' => 'handleLogin', 'uses' => 'AuthController@handleLogin']);
    Route::get('/home', ['middleware' => 'auth', 'as' => 'home', 'uses' => 'UsersController@home']);
    // Route::post('/',['as'=>'store','uses'=>'UsersController@store']);
    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);

    Route::get('/home',['uses'=>'DashboardsController@index', 'as'=>'dashboard']);
    Route::get('/home/record',[ 'as'=>'record', 'uses' => 'RecordsController@index']);
    
    //Route::get('/home/profile/{id}',['as'=>'profile', 'uses' => 'ProfilesController@view']);
    Route::get('/profiles/{id}',['as'=>'profile', 'uses' => 'ProfilesController@show']);
    Route::get('/printpreview/{id}',['as'=>'printpreview', 'uses' => 'PrintController@printPreview']);


    Route::post('/home/record',['uses'=> 'RecordsController@store' , 'as' => 'store']);
    Route::post('/record/update/{id}',['uses'=> 'RecordsController@update' , 'as' => 'update']);
     Route::get('/record/edit/{id}',['as'=>'edit', 'uses' => 'RecordsController@edit']);
   // Route::get('/record',['uses'=>'RecordsController@index', 'as'=>'index']);
    
    
    Route::get( '/ajax-subcat', function(){

        $cat_id=Input::get('cat_id');


        $subcategories=Record::where('id', '=' , $cat_id)->get();

        return Response::json($subcategories);



    });
   
    
   
    
    
    Route::get('home/{id}',['uses'=>'RecordsController@delete', 'as'=>'deleteRecords']);
    Route::post('collection',['uses'=>'CollectionsController@store', 'as'=>'collections.store']);
    Route::get('collection',['uses'=>'CollectionsController@index', 'as'=>'collection']);
    Route::get('collection',['uses'=>'CollectionsController@retrieve', 'as'=>'collection']);
    Route::get('collector_second',['uses'=>'CollectionsController@collector_second' , 'as'=>'second_collector']);
    Route::get('collector_fourth',['uses'=>'CollectionsController@collector_fourth' , 'as'=>'fourth_collector']);
    Route::get('collector_first',['uses'=>'CollectionsController@collector_first' , 'as'=>'first_collector']);
    Route::get('collector_third',['uses'=>'CollectionsController@collector_third' , 'as'=>'third_collector']); 

    Route::get('/printpreviewc1',['as'=>'printpreviewc1', 'uses' => 'PrintController@PrintPreviewC1']);
    Route::get('/printpreviewc2',['as'=>'printpreviewc2', 'uses' => 'PrintController@PrintPreviewC2']);
    Route::get('/printpreviewc3',['as'=>'printpreviewc3', 'uses' => 'PrintController@PrintPreviewC3']);
    Route::get('/printpreviewc4',['as'=>'printpreviewc4', 'uses' => 'PrintController@PrintPreviewC4']);
    
     
    Route::get('check',['uses'=>'CollectionsController@check' , 'as'=>'check']); 
    Route::get('collection/{id}',['uses'=>'CollectionsController@delete', 'as'=>'delete']);
    
   

    Route::resource('users', 'UsersController');
    Route::resource('records','RecordsController');
    Route::resource('payments','PaymentsController');
    Route::resource('profiles','ProfilesController');
    Route::resource('collections','CollectionsController');

   
    


    
});
