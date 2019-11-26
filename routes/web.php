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

// Route::get('/', function () {

//     return view('welcome');
// });
//admin panel start here

Auth::routes();

Route::get('/', 'HomeController@index')->name('admin.index');

Route::prefix('admin')->group(function()
{
	Route::middleware('auth:admin')->group(function()
	{
		Route::group(['middleware'=>'menuPermission'],function()
		{
			//Dashboard Link url
			Route::get('/','HomeController@index')->name('admin.index');
			
			// Settings
			Route::get('/website-information', 'Admin\SettingsController@information')->name('site.info');
			Route::post('/update-information', 'Admin\SettingsController@updatSettings')->name('settings.update');
			Route::get('/admin-logo', 'Admin\SettingsController@adminLogo')->name('admin.logo');
			Route::post('/adminLogo-update', 'Admin\SettingsController@updatadminLogo')->name('adminLogo.update');

			//User Menu 
			Route::get('/user-menu','Admin\UserMenuController@index')->name('usermenu.index');
			Route::get('/user-menu/add','Admin\UserMenuController@add')->name('usermenu.add');
			Route::post('/user-menu/save','Admin\UserMenuController@save')->name('usermenu.save');
			Route::get('/user-menu/edit/{id}','Admin\UserMenuController@edit')->name('usermenu.edit');
			Route::post('/user-menu/update','Admin\UserMenuController@update')->name('usermenu.update');
			Route::get('/user-menu/status','Admin\UserMenuController@status')->name('usermenu.status');
			Route::post('/usermenu-delete','Admin\UserMenuController@destroy')->name('usermenu-delete');

			//End User Menu

		// User Management Start

			//User Menu link action
			Route::get('/user-menu-link/{id}','Admin\UserMenuController@usermenuLink')->name('usermenuLink.index');
			Route::get('/user-menu-link-add/{menuId}','Admin\UserMenuController@usermenuLinkAdd')->name('userMenu.ActionLinkAdd');
			Route::post('/user-menu-link-save/{parentMenuId}','Admin\UserMenuController@usermenuLinkSave')->name('userMenu.ActionLinkSave');
			Route::get('/user-menu-link-edit/{menuId}/{id}','Admin\UserMenuController@usermenuLinkEdit')->name('userMenu.ActionLinkEdit');
			Route::post('/user-menu-link-update/{parentMenuId}','Admin\UserMenuController@usermenuLinkUpdate')->name('userMenu.ActionLinkUpdate');
			Route::get('/user-menu-action/status','Admin\UserMenuController@actionStatus')->name('usermenuAction.status');
			Route::post('/user-menu-action/delete','Admin\UserMenuController@actionDestroy')->name('usermenuAction.delete');

			//User Manage
			Route::get('/user','Admin\AdminController@index')->name('user.index');
			Route::get('/user-add','Admin\AdminController@adduser')->name('user.add');
			Route::post('/user-save','Admin\AdminController@saveuser')->name('user.save');
			Route::get('/user-edit/{id}','Admin\AdminController@edituser')->name('user.edit');
			Route::post('/user-upate','Admin\AdminController@updateuser')->name('user.update');
			Route::get('/user-change-password/{id}','Admin\AdminController@password')->name('user.changePassword');
			Route::post('/user-save-password','Admin\AdminController@passwordChange')->name('user.savePassword');
			Route::post('/user-profile','Admin\AdminController@userProfile')->name('user.profile');
			Route::post('/user-delete','Admin\AdminController@deleteUser')->name('user.delete');
			Route::post('/user-status','Admin\AdminController@changeUserStatus')->name('user.status');

			//User Roll Manage
			Route::resource('user-roles','Admin\UserRoleController');
			Route::get('/user-role-add','Admin\UserRoleController@adduserRole')->name('userRoleAdd.page');
			Route::post('/user-role-save','Admin\UserRoleController@saveuserRole')->name('userRole.save');
			Route::get('/userRole/status/{id}','Admin\UserRoleController@changeuserRoleStatus')->name('userRole.changeuserRoleStatus');
			Route::get('/user-role-edit/{id}','Admin\UserRoleController@edituserRole')->name('userRole.edit');
			Route::post('/user-role-upate','Admin\UserRoleController@updateuserRole')->name('userRole.update');
			Route::get('/user-role-permission/{id}','Admin\UserRoleController@permission')->name('userRole.permission');
			Route::post('/user-role-permission-update','Admin\UserRoleController@permissionUpdate')->name('userRole.permissionUpdate');

			//Start Showroom Setup Section
			Route::get('/showroom-setup','Admin\ShowroomSetupController@index')->name('showroomSetup.index');
			Route::get('/showroom-setup-add','Admin\ShowroomSetupController@addShowroom')->name('showroomSetup.add');
			Route::post('/showroom-setup-save','Admin\ShowroomSetupController@saveShowroom')->name('showroomSetup.save');
			Route::get('/showroom-setup/status/{id}','Admin\ShowroomSetupController@changeShowroomStatus')->name('showroomSetup.status');
			Route::get('/showroom-setup-edit/{id}','Admin\ShowroomSetupController@editShowroom')->name('showroomSetup.edit');
			Route::post('/showroom-setup-update','Admin\ShowroomSetupController@updateShowroom')->name('showroomSetup.update');
			Route::post('/showroom-setup-delete','Admin\ShowroomSetupController@deleteShowroom')->name('showroomSetup.delete');

			//Category Setup
			Route::get('/category-setup','Admin\CategorySetupController@index')->name('categorySetup.index');
			Route::get('/category-setup-add','Admin\CategorySetupController@addCategory')->name('categorySetup.add');
			Route::post('/category-setup-save','Admin\CategorySetupController@saveCategory')->name('categorySetup.save');
			Route::get('/category-setup-edit/{id}','Admin\CategorySetupController@editCategory')->name('categorySetup.edit');
			Route::post('/category-setup-update','Admin\CategorySetupController@updateCategory')->name('categorySetup.update');
			Route::post('/category-setup-delete','Admin\CategorySetupController@deleteCategory')->name('categorySetup.delete');
			Route::post('/category-setup-status','Admin\CategorySetupController@changeCategoryStatus')->name('categorySetup.status');


			//Start Product Section
			Route::get('/product-setup', 'Admin\ProductSetupController@index')->name('productSetup.index');

			Route::get('/product-setup-add','Admin\ProductSetupController@addProduct')->name('productSetup.add');
			Route::post('/product-setup-basic-info-save','Admin\ProductSetupController@saveProductBasicInfo')->name('productSetupBasicInfo.save');
			Route::post('/product-setup-advance-info-save','Admin\ProductSetupController@saveProductAdvanceInfo')->name('productSetupAdvanceInfo.save');
			Route::post('/product-setup-image-save','Admin\ProductSetupController@saveProductImage')->name('productSetupImage.save');
			Route::post('/product-setup-price-info-save','Admin\ProductSetupController@saveProductPrcieInfo')->name('productSetupPriceInfo.save');
			Route::post('/product-setup-seo-info-save','Admin\ProductSetupController@saveProductSeoInfo')->name('productSetupSeoInfo.save');
			Route::post('/product-setup-others-info-save','Admin\ProductSetupController@saveProductOthersInfo')->name('productSetupOthersInfo.save');

			Route::get('/product-setup-edit/{id}','Admin\ProductSetupController@editProduct')->name('productSetup.edit');
			Route::post('/product-setup-basic-info-update','Admin\ProductSetupController@updateProductBasicInfo')->name('productSetupBasicInfo.update');
			Route::post('/product-setup-advance-info-update','Admin\ProductSetupController@updateProductAdvanceInfo')->name('productSetupAdvanceInfo.update');
			Route::post('/product-setup-image-update','Admin\ProductSetupController@updateProductImage')->name('productSetupImage.update');
			Route::post('/product-setup-price-info-update','Admin\ProductSetupController@updateProductPrcieInfo')->name('productSetupPriceInfo.update');
			Route::post('/product-setup-seo-info-update','Admin\ProductSetupController@updateProductSeoInfo')->name('productSetupSeoInfo.update');
			Route::post('/product-setup-others-info-update','Admin\ProductSetupController@updateProductOthersInfo')->name('productSetupOthersInfo.update');

			Route::post('/product-setup-delete','Admin\ProductSetupController@deleteProduct')->name('productSetup.delete');
			Route::post('/products-setup-status','Admin\ProductSetupController@changeProductStatus')->name('productSetup.status');

		// User Management End
		});
	});

	//Admin Login Url
	Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\AdminLoginController@login');
    Route::post('/logout','Auth\AdminLoginController@adminLogout')->name('admin.logout');

    // Password Reset Routes...
    Route::get('/password/reset','Auth\AdminForgotPasswordController@passwordForget')->name('admin.password.forget');
    Route::post('/password/email','Auth\AdminForgotPasswordController@passwordEmail')->name('admin.password.email');
    Route::get('/new-password/{email}','Auth\AdminForgotPasswordController@newPassword')->name('admin.password.newPassword');
    Route::post('/password/save','Auth\AdminForgotPasswordController@changePasswordSave')->name('admin.password.save');

});

//Admin part end