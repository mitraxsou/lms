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

Route::get('/', 'Welcome@show');

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

	Route::group(['middleware'=>'adminrole:super'], function(){
		Route::get('/admin/owners/{owner}/edit','Admin\OwnerController@edit');
		Route::patch('/admin/owners/{owner}','Admin\OwnerController@update');
		
		Route::get('/admin/createowner','Admin\OwnerController@create');
		Route::post('/admin/createowner','Admin\OwnerController@store');
	

		//create roles and provide permissions to each role
		Route::get('/admin/roles','Admin\RoleController@index');
		Route::get('/admin/roles/{role}','Admin\RoleController@show');
		Route::get('/admin/createrole','Admin\RoleController@create');
		Route::post('/admin/createrole','Admin\RoleController@store');
		Route::get('/admin/roles/{role}/edit','Admin\RoleController@edit');
		Route::patch('/admin/roles/{role}','Admin\RoleController@update');
	});

	//assign and detach categories to the owners
	Route::get('/admin/owners/assigncategory/{oid}','Admin\AssignCategory@create');
	Route::post('/admin/owners/assigncategory','Admin\AssignCategory@store');
	Route::get('/admin/owners/assigncategory/edit/{oid}','Admin\AssignCategory@edit');

	/**Not using update due to problems faced in attaching and detaching categories at the same time***/
	//Route::patch('/admin/owners/assigncategory/edit/{oid}','Admin\AssignCategory@update');
	Route::get('/admin/owners/category/delete/{oid}/{catid}','Admin\AssignCategory@destroy');
	Route::get('/admin/owners/category/add/{oid}/{catid}','Admin\AssignCategory@add');


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
	Route::get('/admin/course/{course}', 'Admin\CourseController@show');
	Route::get('/admin/createcourse' ,['middleware'=>['adminpermission:create_course'],'uses'=>  'Admin\CourseController@create']);
	Route::post('/admin/createcourse' , 'Admin\CourseController@store');
	Route::get('/admin/course/delete/{course}' , 'Admin\CourseController@destroy');
	Route::get('/admin/course/{course}/edit','Admin\CourseController@edit');
	Route::patch('/admin/course/{course}','Admin\CourseController@update');

	/*Topic URLs*/
	Route::get('/admin/{course}/createtopic','Admin\TopicController@create');
	Route::post('/admin/{course}/createtopic' , 'Admin\TopicController@store');
	Route::get('/admin/course/{course}/topic/{topic}/edit','Admin\TopicController@edit');
	Route::patch('/admin/course/{course}/topic/{topic}','Admin\TopicController@update');
	
	/*******Sub Topic Addition - Soumi********/
	Route::get('/admin/course/publish/{course}' , 'Admin\PublishController@publish');
	Route::get('/admin/course/{course}/{topic}' , 'Admin\TopicController@show');

	Route::get('/admin/course/{course}/{topic}/createsubtopic','Admin\SubTopicController@create');
	Route::post('/admin/{course}/{topic}/createsubtopic' , 'Admin\SubTopicController@store');
	Route::get('/admin/course/{course}/{topic}/{subtid}','Admin\SubTopicController@contentshow');
	Route::get('/admin/course/{course}/{topic}/{subtopic}/edit','Admin\SubTopicController@edit');
	Route::patch('/admin/course/{course}/{topic}/{subtopic}','Admin\SubTopicController@update');


//	Route::get('/admin/course/{course}/{topic}/createsubtopic','Admin\SubTopicController@create');
//	Route::post('/admin/{course}/createsubtopic' , 'Admin\SubTopicController@store');
//	Route::get('/admin/course/{course}/topic/{topic}/content/{subtid}','Admin\SubTopicController@contentshow');

	Route::get('/admin/mycourse/review/{course}/{topic}/{subtid}','Admin\SubTopicController@reviewcontent');
	//Route::get('/admin/course/{course}/topic/{topic}/editcontent/{subtid}','Admin\SubTopicController@editcontent');
	Route::post('/admin/editsubtopic/{content}' , 'Admin\ReviewController@editstore');
	Route::post('/admin/editsubtopicmaking/{content}' , 'Admin\SubTopicController@editcontentmaking');
	Route::get('/admin/mycourse/edit/{course}/{topic}/{subtid}','Admin\SubTopicController@editcontent');
	Route::get('/admin/mycourse/editmaking/{course}/{topic}/{subtid}','Admin\SubTopicController@editmaking');

	Route::get('/admin/mycourse/contentselection/{course}/{topic}/{subtid}','Admin\ContentController@changeContent');
	Route::get('/admin/mycourse/contentdelete/{contid}','Admin\ContentController@deleteContent');
	Route::post('/admin/mycourse/contentAdd/{contid}','Admin\ContentController@storeContent');
	Route::get('/admin/mycourse/delete/{course}/{topic}/{subtopic}','Admin\SubTopicController@destroy');

	/*************/

	/*********Admin Publish - Soumi**********/
	Route::get('/admin/publishcourse' , 'Admin\PublishController@create');
	Route::post('/admin/feedbackcorrect', 'Admin\PublishController@feedbackcorrect');
	Route::post('/admin/feedbackedit', 'Admin\PublishController@feedbackedit');
	Route::get('/admin/publishedit/{id}' , 'Admin\MyCourseController@publishedit');
	Route::post('/admin/unpublish' , 'Admin\PublishController@unpublish');
	/*************************************/

	/*****Courses created by the admin****/
	Route::get('/admin/mycourse','Admin\MyCourseController@index');
	Route::get('/admin/mycourse/{course}','Admin\MyCourseController@show');
	Route::get('/admin/mycourse/{course}/{topic}' , 'Admin\MyCourseController@showSubTopic');
	Route::get('/admin/mycourse/{course}/{topic}/{subtid}','Admin\MyCourseController@contentshow');
	Route::post('/admin/reviewstructure','Admin\MyCourseController@reviewstructure');


	/**Video part**/
	Route::get('/admin/vidremove/{course}/{topic}/{subtid}','Admin\SubTopicController@removeVideo');
	Route::get('/admin/vupload', 'Admin\UploadController@videoUpload');
	Route::post('/admin/vupload','Admin\UploadController@videoUploadPost');
	Route::get('/admin/listfiles','Admin\UploadController@showUploads');
	Route::get('/admin/files/{id}','Admin\UploadController@showFile');
	/*************Categories**********/
	Route::get('/admin/createcategory',['middleware'=>['adminrole:super'],'uses'=> 'Admin\CategoryController@create']);
	Route::get('/admin/categories', 'Admin\CategoryController@index');
	Route::post('/admin/storeCategory', ['middleware'=>['adminrole:super'],'uses'=>'Admin\CategoryController@store']);
	Route::get('/admin/removecategory/{id}',['middleware'=>['adminrole:super'],'uses'=> 'Admin\CategoryController@destroy']);
	Route::get('/admin/category/{category}', 'Admin\CategoryController@show');

	/***************Reviewing - Soumi********/
	Route::get('/admin/reviewcourse', 'Admin\ReviewController@create');
	Route::get('/admin/review/{stid}/{review}', 'Admin\ReviewController@review');
	Route::get('/admin/contentreview/{id}','Admin\ReviewController@content');
	Route::post('/admin/reviewfeedback/{review}', 'Admin\ReviewController@feedback');
	Route::post('/admin/reviewcorrect/{review}', 'Admin\ReviewController@correct');
	Route::get('/admin/reviewstr','Admin\ReviewController@reviewstructure');
	Route::post('/admin/reviewcomment', 'Admin\ReviewController@comment');
	Route::get('/admin/structuresuccess/{id}','Admin\ReviewController@structuresuccess');
	/***************/
	Route::get('/dummy', 'Admin\CategoryController@dummy');



});

Route::group(['middleware' => 'guestauth'], function()
{
	Route::get('/studentreg/{course}', 'Student\CourseController@create');
	Route::post('/coursereg', 'Student\CourseController@store');
	Route::get('/course/{course}', 'Student\CourseController@view');
	Route::get('/student/read/{id}','Student\StudentController@read');

});