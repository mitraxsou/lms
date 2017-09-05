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

use App\Course;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//Route::resource('course','CourseController');

/*Index for Course*/
Route::get('/course/{course}', 'CourseController@show');
Route::group(['middleware' => 'auth'] , function(){
	
	Route::get('java/0' , function(){
		return view('course/java/intro');
	});

	Route::get('java/1', function(){
		return view('course/java/oops');
	});
});

/******DONT DELETE THIS************/
/* *********** For different type of content *********/


// Route::group(['middleware'->'limit|auth'] , function(){

// 	Route::get('course/{course}/{index}/c/{subindex}'){
// 		return view(templates/content);
// 	}

// 	Route::get('course/{course}/{index}/v/{subindex}'){
// 		return view(templates/video);
// 	}
// 	Route::get('course/{course}/{index}/i/{subindex}'){
// 		return view(templates/infographic);
// 	}
// 	Route::get('course/{course}/{index}/i2/{subindex}'){
// 		return view(templates/infographic2);
// 	}

// });

Route::group(['middleware' => 'adminguest'], function(){

	// Route::get('/adminregister' , 'AdminAuth\RegisterController@showRegisterForm');
	// Route::get('/adminregister', 'AdminAuth\RegisterController@register');
	Route::get('/adminlogin', 'AdminAuth\LoginController@showLoginForm');
	Route::post('/adminlogin', 'AdminAuth\LoginController@login');
});

Route::group(['middleware' => 'adminauth'], function()
{
	Route::post('/adminlogout', 'AdminAuth\LoginController@logout');
	Route::get('/adminhome', function()
	{
		return view('admin/adminhome');
	});

	//Create delete and modify other owners
	
	Route::get('/admin/owners','Admin\OwnerController@index');
	Route::get('/admin/owners/{owner}','Admin\OwnerController@show');
	Route::get('/admin/createowner','Admin\OwnerController@create');
	Route::post('/admin/createowner','Admin\OwnerController@store');

	//create roles and provide permissions to each role
	Route::get('/admin/roles','Admin\RoleController@index');
	Route::get('/admin/roles/{role}','Admin\RoleController@show');
	Route::get('/admin/createrole','Admin\RoleController@create');
	Route::post('/admin/createrole','Admin\RoleController@store');

	Route::get('/admin/student', 'Admin\StudentController@index');
	Route::get('/admin/student/{user}' , 'Admin\StudentController@show');
	Route::post('/admin/student' , 'Admin\StudentController@store');
	//Route::get('/admin/student/{user}' , 'Admin\StudentController@delete');
	Route::get('/admin/createstudent' , function()
		{
			return view('admin/createstudent');
		});
	Route::get('/admin/enrollmanage' , function()
	{
		return view('admin/enrollmanage');
	});
	
	/***********************Course URLs************/
	Route::get('/admin/course' , 'Admin\CourseController@index');
	Route::get('/admin/course/{course}' , 'Admin\CourseController@show');
	Route::get('/admin/createcourse' , 'Admin\CourseController@create');
	Route::post('/admin/createcourse' , 'Admin\CourseController@store');
	Route::get('/admin/course/delete/{course}' , 'Admin\CourseController@destroy');
	/*******Sub Topic Addition - Soumi********/
	Route::get('/admin/course/topic/{topic}' , 'Admin\TopicController@show');
	Route::get('/admin/course/{topic}/createsubtopic','Admin\SubTopicController@create');
	Route::post('/admin/{course}/createsubtopic' , 'Admin\SubTopicController@store');
	Route::get('/admin/course/topic/content/{subtid}','Admin\SubTopicController@contentshow');

	/*Topic URLs*/
	Route::get('/admin/{course}/createtopic','Admin\TopicController@create');
	Route::post('/admin/{course}/createtopic' , 'Admin\TopicController@store');
	

	Route::get('/admin/trainer' , 'Admin\TrainerController@index');
	Route::get('/admin/trainer/{trainer}' , 'Admin\TrainerController@show');

	Route::get('/admin/enroll' , 'Admin\EnrollController@index');
	Route::get('/admin/enroll/{user}' , 'Admin\EnrollController@show');
	Route::get('/admin/enrollstudent' ,'Admin\EnrollController@showstudent');
	Route::post('/admin/enroll' ,'Admin\EnrollController@store');
	Route::get('/admin/enroll/delete/{uid}/{cid}' , 'Admin\EnrollController@destroy');

	/*Batch urls*/
	Route::get('/admin/createbatch' , 'Admin\BatchController@create');
	Route::get('/admin/createbatch/{cid}' , 'Admin\BatchController@showUser');
	Route::post('/admin/createbatch', 'Admin\BatchController@store');
	Route::get('/admin/batch', 'Admin\BatchController@index');
	Route::get('/admin/batch/{batch}', 'Admin\BatchController@show');
	Route::get('/admin/batch/selectstudent/{cid}/{bid}' , 'Admin\BatchController@selectStudent');
	Route::post('/admin/batch/storeStudent' , 'Admin\BatchController@storeStudent');
	Route::get('/admin/batch/delete/{id}' , 'Admin\BatchController@destroy');
	Route::get('/admin/batch/edit/{id}' , 'Admin\BatchController@editStudent');
	Route::post('/admin/batch/removeStudent' , 'Admin\BatchController@removeStudent');

	/*************Categories**********/
	Route::get('/admin/createcategory', 'CategoryController@create');
	Route::get('/admin/categories', 'CategoryController@index');
	Route::post('/admin/storeCategory', 'CategoryController@store');
	Route::get('/admin/removecategory/{id}', 'CategoryController@destroy');

});
