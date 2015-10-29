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

Route::get('/', 'HomeController@index');
Route::get('referrals', 'HomeController@referrals');
Route::get('statistic', 'HomeController@statistic');


Route::get('business', 'HomeController@business');

Route::post('user/signup', ['uses' => 'UserController@signup']);

Route::get('signup/verify/{confirmation_code}', [
	"as" => "confirmation_path", 
	"uses" => "UserController@confirmSignup"
]);

//------------------ 	Reset Password 	-------------------//
Route::get("forget/password", function(){
    	return view("user/forget_password")
    	->with("title","Forgot Information");
});

Route::post("request/password", [
	"uses" => "UserController@requestPassword"
]);

Route::get('request/resetpassword/{token}', [
	"uses" => "UserController@resetPassword"
]);

Route::post('user/resetpassword/{usrRememberToken}', [
	"as" => "user/resetpassword", 
	"uses" => "UserController@updatePassword"
]);
//----------------------------------------------------------//

//------------------ 	Reset Username 	-------------------//
Route::get("forget/username", function(){
    	return view("user/forget_username")
    	->with("title","Forgot Username");
});

Route::post("request/username", [
	"uses" => "UserController@requestUsername"
]);

Route::get('request/resetusername/{usrRememberToken}', [
	"uses" => "UserController@resetUsername"
]);

Route::post('user/resetusername/{usrRememberToken}', [
	"as" => "user/resetpassword", 
	"uses" => "UserController@updateUsername"
]);
//----------------------------------------------------------//

Route::post('user/login', [
	"uses" => "UserController@login"
]);

//------------------- 		Authentication Routes Start		------------------------//
Route::group(['before' => 'auth'], function()
{
	Route::get('dashboard', 'HomeController@dashboard');

	Route::get('logout', 'UserController@logout');

	Route::group(['before' => 'marketer'], function(){

		Route::get('invoices', 'HomeController@invoices');
	});


//------------------------	 		Mail Route 		---------------------------------//
	Route::get('mail', 'HomeController@mail');

	Route::post('select/mail', 'HomeController@selectMail');

	Route::post('select/draft', 'HomeController@selectDraft');

	Route::post('draft/mail', 'HomeController@draftMail');

	Route::post('show/inbox', 'HomeController@showInbox');

	Route::post('show/draft', 'HomeController@showDraft');

	Route::post('show/sent', 'HomeController@showSent');

	Route::post('send_message', 'HomeController@sendMessage');

	Route::post('folder/show', 'HomeController@showFolder');

	Route::post('folder/create', 'HomeController@createFolder');

	Route::post('folder/move', 'HomeController@moveToFolder');

	Route::post('folder/select', 'HomeController@selectFolder');

	Route::post('folder/delete', 'HomeController@deleteFolder');

	Route::post('agree/friend', 'HomeController@acceptFriend');

	Route::post('decline/friend', 'HomeController@declineFriend');
//-----------------------------------------------------------------------------------//

//-------------------  			Profile 			---------------------------------//
	Route::get('profile', 'HomeController@profile');

	Route::post('post_info', 'HomeController@post_info');

	Route::get("upload/photo/{usrName}", function($usrName){

    	return view("function.upload")
    		   ->with('type','photo')
    		   ->with('usrName', $usrName);
	});

	Route::post('apply_upload/photo/{usrName}', 'FunctionController@apply_uploadPhoto');

	Route::get("upload/video/{usrName}", function($usrName){
    	return view("function.upload")
    		   ->with('type','video')
    		   ->with('usrName', $usrName);
	});

	Route::post('apply_upload/video/{usrName}', 'FunctionController@apply_uploadVideo');

	Route::get("upload/location/{usrName}", function($usrName){
    	return view("function.location")
    		   ->with('usrName', $usrName);
	});

	Route::post('send/zipcode/{token}', 'FunctionController@sendZipcode');

	Route::post('add/friend', 'HomeController@addFriend');

	Route::post('search/friend', 'HomeController@searchFriend');

	Route::get('profile/{usrName}', 'HomeController@friendProfile');

	Route::post('edit/content', 'HomeController@editContent');
	


//-----------------------------------------------------------------------------------//

//------------------------			Market 					-------------------------//
	Route::get('marketer', 'HomeController@marketer');
	
	Route::post('delete/post', 'HomeController@deletePost');

	Route::post('post/product', 'MarketController@postProduct');

	Route::post('select/post', 'MarketController@selectPost');

	Route::post('filter/commission', 'MarketController@filterCommission');

	Route::post('filter/distance', 'MarketController@filterDistance');

	Route::post('filter/category', 'MarketController@filterCategory');

	Route::post('sort/product', 'MarketController@sortProduct');

	Route::post('search/product', 'MarketController@searchProduct');
//-----------------------------------------------------------------------------------//

//------------------------- 		Ranking 		---------------------------------//

	Route::get('ranking', 'HomeController@ranking');

	Route::post('select/state', 'HomeController@selectState');

//-----------------------------------------------------------------------------------//

//------------------------- 		Setting 		---------------------------------//
 			
	Route::get('setting', 'HomeController@setting');

	Route::post('update/profile', 'HomeController@updateProfile');

//-----------------------------------------------------------------------------------//	

	

});
//-----------------------------------------------------------------------------------//

Route::get("admin/login", function(){
    	return view("admin.login");
});

Route::post('pass/login', 'AdminController@passLogin');

//--------------------------- 		Admin 		-------------------------------------//
Route::group(['before' => 'admin'], function()
{
	
	Route::get("admin", function(){
    	return view("admin.dashboard");
	});

	Route::get('admin/logout', 'AdminController@adminLogout');
	
	Route::get('manage/product', 'AdminController@manageProduct');

	Route::post('detail/product', 'AdminController@detailPost');

	Route::post('delete/product', 'AdminController@deletePost');

	Route::post('agree/post', 'AdminController@agreePost');
});
//------------------------------------------------------------------------------------//
//----------------------------		LOGIN WITH FACEBOOK 	--------------------------//

Route::get('facebook', 'UserController@redirectToProviderForFacebook');

Route::get('facebook/callback', 'UserController@handleProviderCallbackForFacebook');

Route::post('user/social_signup/{usrSocialId}/{userType}', 'UserController@social_signup');

//-----------------------------------------------------------------------------------//

//------------------------------		LOGIN WITH TWITTER 	-------------------------//

Route::get('twitter', 'UserController@redirectToProviderForTwitter');

Route::get('twitter/callback', 'UserController@handleProviderCallbackForTwitter');

//-----------------------------------------------------------------------------------//

//--------------------- 		SubDomain -------------------------------------------//

Route::group(['domain' => '{productId}.oraisen.com'], function($productId){

	if($productId == 'www' || $productId == ''){
        Route::get('/',function(){
            return "I'm root!";
        });
    }

});
//-----------------------------------------------------------------------------------//