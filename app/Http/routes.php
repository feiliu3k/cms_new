<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

get('/', ['uses'=>'Admin\QnaireController@index','middleware' => 'auth']);

get('news', 'NewsController@index');
get('news/{id}', ['uses' => 'NewsController@show', 'as' => 'newsShow']);
get('qnaire/{id}', ['uses' => 'NewsController@show', 'as' => 'newsShow']);

// Admin area

post('/comment/destroy','CommentController@destroy');

post('/comment/verify', 'CommentController@verify');


$router->group(['namespace' => 'Admin', 'middleware' => 'auth', 'prefix'=>'admin'], function () {

    get('admin', 'QnaireController@index');
    post('user/change',['uses' => 'UserController@change', 'as' => 'admin.user.change']);
    get('user/editRole/{id}',['uses' => 'UserController@editRole', 'as' => 'admin.user.editRole']);
    post('user/updateRole/{id}',['uses' => 'UserController@updateRole', 'as' => 'admin.user.updateRole']);

    get('user/editPro/{id}',['uses' => 'UserController@editPro', 'as' => 'admin.user.editPro']);
    post('user/updatePro/{id}',['uses' => 'UserController@updatePro', 'as' => 'admin.user.updatePro']);

    get('role/editPermission/{id}',['uses' => 'RoleController@editPermission', 'as' => 'admin.role.editPermission']);
    post('role/updatePermission/{id}',['uses' => 'RoleController@updatePermission', 'as' => 'admin.role.updatePermission']);

    post('newsupload/uploadImgFile', 'NewsUploadController@uploadImgFile');


    resource('user','UserController', ['except' => 'show']);
    resource('role','RoleController', ['except' => 'show']);
    resource('permission','PermissionController', ['except' => 'show']);


    resource('jrsx','JrsxController');
    get('jrsx/search',['uses'=>'JrsxController@search','as'=>'admin.jrsx.search']);
    get('jrsx/searchbypro/{proid}',['uses'=>'JrsxController@searchByPro','as'=>'admin.jrsx.searchbypro']);
    post('jrsx/ban',['uses'=>'JrsxController@ban','as'=>'admin.jrsx.ban']);
    get('jrsx/banlist',['uses'=>'JrsxController@banlist','as'=>'admin.jrsx.banlist']);
    get('jrsx/bandelete/{id}',['uses'=>'JrsxController@bandelete','as'=>'admin.jrsx.bandelete']);

    //resource('qnaire', 'QnaireController', ['except' => 'show']);

    get('qnaire/search',['uses'=>'QnaireController@search','as'=>'admin.qnaire.search']);
    get('qnaire/searchbypro/{proid}',['uses'=>'QnaireController@searchByPro','as'=>'admin.qnaire.searchbypro']);
    get('qnaire/searchbyuser/{userid}',['uses'=>'QnaireController@searchByUser','as'=>'admin.qnaire.searchbyuser']);

    get('qnaire',['uses'=>'QnaireController@index','as'=>'admin.qnaire.index']);
    get('qnaire/create',['uses'=>'QnaireController@create','as'=>'admin.qnaire.create']);
    post('qnaire/store',['uses'=>'QnaireController@store','as'=>'admin.qnaire.store']);
    get('qnaire/{id}/edit',['uses'=>'QnaireController@edit','as'=>'admin.qnaire.edit']);
    get('qnaire/{id}',['uses'=>'QnaireController@show','as'=>'admin.qnaire.show']);
    put('qnaire/{id}',['uses'=>'QnaireController@update','as'=>'admin.qnaire.update']);
    delete('qnaire/{id}',['uses'=>'QnaireController@destroy','as'=>'admin.qnaire.destroy']);

    get('news/search',['uses'=>'NewsController@search','as'=>'admin.news.search']);
    resource('news', 'NewsController', ['except' => 'show']);

    get('pro/pros',['uses'=>'ProController@pros','as'=>'admin.pro.pros']);
    resource('pro', 'ProController',['except' => 'show']);
    resource('dept', 'DeptController',['except' => 'show']);

    get('comment/search',['uses'=>'CommentController@search','as'=>'admin.comment.search']);
    resource('comment', 'CommentController', ['except' => 'show']);

    get('fav/index',['uses'=>'FavController@index','as'=>'admin.fav.index']);
    post('fav',['uses'=>'FavController@store','as'=>'admin.fav.store']);
    delete('fav/{id}',['uses'=>'FavController@destroy','as'=>'admin.fav.destroy']);

    get('remark',['uses'=>'RemarkController@index','as'=>'admin.remark.index']);
    post('remark',['uses'=>'RemarkController@store','as'=>'admin.remark.store']);
    get('remark/{id}/edit',['uses'=>'RemarkController@edit','as'=>'admin.remark.edit']);
    delete('remark/{id}',['uses'=>'RemarkController@destroy','as'=>'admin.remark.destroy']);
    put('remark/update',['uses'=>'RemarkController@update','as'=>'admin.remark.update']);

    get('upload', 'UploadController@index');
    post('upload/file', 'UploadController@uploadFile');
    delete('upload/file', 'UploadController@deleteFile');
    post('upload/folder', 'UploadController@createFolder');
    delete('upload/folder', 'UploadController@deleteFolder');


});

// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');