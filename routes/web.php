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
			Route::get('/drop-down-prob', 'Admin\DropDownProbController@index')->name('dropDownProb.index');

			//Dashboard Link url
			Route::get('/','HomeController@index')->name('admin.index');

		// User Management Start
			
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
			Route::get('/user-add','Admin\AdminController@addUser')->name('user.add');
			Route::post('/user-save','Admin\AdminController@saveUser')->name('user.save');
			Route::get('/user-edit/{id}','Admin\AdminController@editUser')->name('user.edit');
			Route::post('/user-upate','Admin\AdminController@updateUser')->name('user.update');
			Route::get('/user-change-password/{id}','Admin\AdminController@password')->name('user.changePassword');
			Route::post('/user-save-password','Admin\AdminController@passwordChange')->name('user.savePassword');
			Route::post('/user-profile','Admin\AdminController@userProfile')->name('user.profile');
			Route::post('/user-delete','Admin\AdminController@deleteUser')->name('user.delete');
			Route::post('/user-status','Admin\AdminController@changeUserStatus')->name('user.status');

			//User Roll Manage
			Route::get('/user-roles','Admin\UserRoleController@index')->name('user-roles.index');
			Route::get('/user-role-add','Admin\UserRoleController@adduserRole')->name('userRoleAdd.page');
			Route::post('/user-role-save','Admin\UserRoleController@saveuserRole')->name('userRole.save');
			Route::get('/user-role-edit/{id}','Admin\UserRoleController@edituserRole')->name('userRole.edit');
			Route::post('/user-role-upate','Admin\UserRoleController@updateuserRole')->name('userRole.update');
			Route::post('/user-role-delete','Admin\UserRoleController@deleteUserRole')->name('userRole.delete');
			Route::get('/userRole/status/{id}','Admin\UserRoleController@changeuserRoleStatus')->name('userRole.changeuserRoleStatus');
			Route::get('/user-role-permission/{id}','Admin\UserRoleController@permission')->name('userRole.permission');
			Route::post('/user-role-permission-update','Admin\UserRoleController@permissionUpdate')->name('userRole.permissionUpdate');

			// Company Setup
			Route::get('/company-setup','Admin\CompanySetupController@index')->name('companySetup.index');
			Route::get('/company-setup-add','Admin\CompanySetupController@addCompany')->name('companySetup.add');
			Route::post('/company-setup-save','Admin\CompanySetupController@saveCompany')->name('companySetup.save');
			Route::get('/company-setup-edit/{id}','Admin\CompanySetupController@editCompany')->name('companySetup.edit');
			Route::post('/company-setup-update','Admin\CompanySetupController@updateCompany')->name('companySetup.update');


			//Showroom Setup
			Route::get('/showroom-setup','Admin\ShowroomSetupController@index')->name('showroomSetup.index');
			Route::get('/showroom-setup-add','Admin\ShowroomSetupController@addShowroom')->name('showroomSetup.add');
			Route::post('/showroom-setup-save','Admin\ShowroomSetupController@saveShowroom')->name('showroomSetup.save');
			Route::get('/showroom-setup/status/{id}','Admin\ShowroomSetupController@changeShowroomStatus')->name('showroomSetup.status');
			Route::get('/showroom-setup-edit/{id}','Admin\ShowroomSetupController@editShowroom')->name('showroomSetup.edit');
			Route::post('/showroom-setup-update','Admin\ShowroomSetupController@updateShowroom')->name('showroomSetup.update');
			Route::post('/showroom-setup-delete','Admin\ShowroomSetupController@deleteShowroom')->name('showroomSetup.delete');
		// User Management End

		// Bussiness Settings

			//Category Setup
			Route::get('/category-setup','Admin\CategorySetupController@index')->name('categorySetup.index');
			Route::get('/category-setup-add','Admin\CategorySetupController@addCategory')->name('categorySetup.add');
			Route::post('/category-setup-save','Admin\CategorySetupController@saveCategory')->name('categorySetup.save');
			Route::get('/category-setup-edit/{id}','Admin\CategorySetupController@editCategory')->name('categorySetup.edit');
			Route::post('/category-setup-update','Admin\CategorySetupController@updateCategory')->name('categorySetup.update');
			Route::post('/category-setup-delete','Admin\CategorySetupController@deleteCategory')->name('categorySetup.delete');
			Route::post('/category-setup-status','Admin\CategorySetupController@changeCategoryStatus')->name('categorySetup.status');


			//Product Section
			Route::get('/product-setup', 'Admin\ProductSetupController@index')->name('productSetup.index');

			Route::get('/product-setup-add','Admin\ProductSetupController@addProduct')->name('productSetup.add');
			Route::post('/product-setup-basic-info-save','Admin\ProductSetupController@saveProductBasicInfo')->name('productSetupBasicInfo.save');
			Route::post('/product-setup-image-save','Admin\ProductSetupController@saveProductImage')->name('productSetupImage.save');

			Route::get('/product-setup-edit/{id}','Admin\ProductSetupController@editProduct')->name('productSetup.edit');
			Route::post('/product-setup-basic-info-update','Admin\ProductSetupController@updateProductBasicInfo')->name('productSetupBasicInfo.update');
			Route::post('/product-setup-advance-info-update','Admin\ProductSetupController@updateProductAdvanceInfo')->name('productSetupAdvanceInfo.update');
			Route::post('/product-setup-seo-info-update','Admin\ProductSetupController@updateProductSeoInfo')->name('productSetupSeoInfo.update');

			Route::post('/product-setup-image-delete','Admin\ProductSetupController@deleteProductImage')->name('productSetupImage.delete');

			Route::post('/product-setup-delete','Admin\ProductSetupController@deleteProduct')->name('productSetup.delete');
			Route::post('/products-setup-status','Admin\ProductSetupController@changeProductStatus')->name('productSetup.status');

			// Store Setup
			Route::get('/store-setup','Admin\StoreSetupController@index')->name('storeSetup.index');
			Route::get('/store-setup-add','Admin\StoreSetupController@addStore')->name('storeSetup.add');
			Route::post('/store-setup-save','Admin\StoreSetupController@saveStore')->name('storeSetup.save');
			Route::get('/store-setup-edit/{id}','Admin\StoreSetupController@editStore')->name('storeSetup.edit');
			Route::post('/store-setup-update','Admin\StoreSetupController@updateStore')->name('storeSetup.update');
			Route::post('/store-setup-delete','Admin\StoreSetupController@deleteStore')->name('storeSetup.delete');
			Route::post('/store-setup-status','Admin\StoreSetupController@changeStoreStatus')->name('storeSetup.status');

			// Bank Setup
			Route::get('/bank-setup','Admin\BankSetupController@index')->name('bankSetup.index');
			Route::get('/bank-setup-add','Admin\BankSetupController@addBank')->name('bankSetup.add');
			Route::post('/bank-setup-save','Admin\BankSetupController@saveBank')->name('bankSetup.save');
			Route::get('/bank-setup-edit/{id}','Admin\BankSetupController@editBank')->name('bankSetup.edit');
			Route::post('/bank-setup-update','Admin\BankSetupController@updateBank')->name('bankSetup.update');
			Route::post('/bank-setup-delete','Admin\BankSetupController@deleteBank')->name('bankSetup.delete');
			Route::post('/bank-setup-status','Admin\BankSetupController@changeBankStatus')->name('bankSetup.status');

			// Courier Setup
			Route::get('/courier-setup','Admin\CourierSetupController@index')->name('courierSetup.index');
			Route::get('/courier-setup-add','Admin\CourierSetupController@addCourier')->name('courierSetup.add');
			Route::post('/courier-setup-save','Admin\CourierSetupController@saveCourier')->name('courierSetup.save');
			Route::get('/courier-setup-edit/{id}','Admin\CourierSetupController@editCourier')->name('courierSetup.edit');
			Route::post('/courier-setup-update','Admin\CourierSetupController@updateCourier')->name('courierSetup.update');
			Route::post('/courier-setup-delete','Admin\CourierSetupController@deleteCourier')->name('courierSetup.delete');
			Route::post('/courier-setup-status','Admin\CourierSetupController@changeCourierStatus')->name('courierSetup.status');

			// Vehicle Setup
			Route::get('/vehicle-setup','Admin\VehicleSetupController@index')->name('vehicleSetup.index');
			Route::get('/vehicle-setup-add','Admin\VehicleSetupController@addVehicle')->name('vehicleSetup.add');
			Route::post('/vehicle-setup-save','Admin\VehicleSetupController@saveVehicle')->name('vehicleSetup.save');
			Route::get('/vehicle-setup-edit/{id}','Admin\VehicleSetupController@editVehicle')->name('vehicleSetup.edit');
			Route::post('/vehicle-setup-update','Admin\VehicleSetupController@updateVehicle')->name('vehicleSetup.update');
			Route::post('/vehicle-setup-delete','Admin\VehicleSetupController@deleteVehicle')->name('vehicleSetup.delete');
			Route::post('/vehicle-setup-status','Admin\VehicleSetupController@changeVehicleStatus')->name('vehicleSetup.status');

			// Area Setup
			Route::get('/area-setup','Admin\AreaSetupController@index')->name('areaSetup.index');
			Route::get('/area-setup-add','Admin\AreaSetupController@addArea')->name('areaSetup.add');
			Route::post('/area-setup-save','Admin\AreaSetupController@saveArea')->name('areaSetup.save');
			Route::get('/area-setup-edit/{id}','Admin\AreaSetupController@editArea')->name('areaSetup.edit');
			Route::post('/area-setup-update','Admin\AreaSetupController@updateArea')->name('areaSetup.update');
			Route::post('/area-setup-delete','Admin\AreaSetupController@deleteArea')->name('areaSetup.delete');
			Route::post('/area-setup-status','Admin\AreaSetupController@changeAreaStatus')->name('areaSetup.status');

			// Territory Setup
			Route::get('/territory-setup','Admin\TerritorySetupController@index')->name('territorySetup.index');
			Route::get('/territory-setup-add','Admin\TerritorySetupController@addTerritory')->name('territorySetup.add');
			Route::post('/territory-setup-save','Admin\TerritorySetupController@saveTerritory')->name('territorySetup.save');
			Route::get('/territory-setup-edit/{id}','Admin\TerritorySetupController@editTerritory')->name('territorySetup.edit');
			Route::post('/territory-setup-update','Admin\TerritorySetupController@updateTerritory')->name('territorySetup.update');
			Route::post('/territory-setup-delete','Admin\TerritorySetupController@deleteTerritory')->name('territorySetup.delete');
			Route::post('/territory-setup-status','Admin\TerritorySetupController@changeTerritoryStatus')->name('territorySetup.status');

			// Territory Setup
			Route::get('/territory-setup','Admin\TerritorySetupController@index')->name('territorySetup.index');
			Route::get('/territory-setup-add','Admin\TerritorySetupController@addTerritory')->name('territorySetup.add');
			Route::post('/territory-setup-save','Admin\TerritorySetupController@saveTerritory')->name('territorySetup.save');
			Route::get('/territory-setup-edit/{id}','Admin\TerritorySetupController@editTerritory')->name('territorySetup.edit');
			Route::post('/territory-setup-update','Admin\TerritorySetupController@updateTerritory')->name('territorySetup.update');
			Route::post('/territory-setup-delete','Admin\TerritorySetupController@deleteTerritory')->name('territorySetup.delete');
			Route::post('/territory-setup-status','Admin\TerritorySetupController@changeTerritoryStatus')->name('territorySetup.status');

			// Staff Setup
			Route::get('/staff-setup','Admin\StaffSetupController@index')->name('staffSetup.index');
			Route::get('/staff-setup-add','Admin\StaffSetupController@addStaff')->name('staffSetup.add');
			Route::post('/staff-setup-save','Admin\StaffSetupController@saveStaff')->name('staffSetup.save');
			Route::get('/staff-setup-edit/{id}','Admin\StaffSetupController@editStaff')->name('staffSetup.edit');
			Route::post('/staff-setup-update','Admin\StaffSetupController@updateStaff')->name('staffSetup.update');
			Route::post('/staff-setup-delete','Admin\StaffSetupController@deleteStaff')->name('staffSetup.delete');
			Route::post('/staff-setup-status','Admin\StaffSetupController@changeStaffStatus')->name('staffSetup.status');

			// Vendor Setup
			Route::get('/vendor-setup','Admin\VendorSetupController@index')->name('vendorSetup.index');
			Route::get('/vendor-setup-add','Admin\VendorSetupController@addVendor')->name('vendorSetup.add');
			Route::post('/vendor-setup-save','Admin\VendorSetupController@saveVendor')->name('vendorSetup.save');
			Route::get('/vendor-setup-edit/{id}','Admin\VendorSetupController@editVendor')->name('vendorSetup.edit');
			Route::post('/vendor-setup-update','Admin\VendorSetupController@updateVendor')->name('vendorSetup.update');
			Route::post('/vendor-setup-delete','Admin\VendorSetupController@deleteVendor')->name('vendorSetup.delete');
			Route::post('/vendor-setup-status','Admin\VendorSetupController@changeVendorStatus')->name('vendorSetup.status');

			//Product List
			Route::get('/product-list','Admin\ProductListController@index')->name('productList.index');
			Route::post('/product-list','Admin\ProductListController@index')->name('productList.index');
			Route::post('/product-list/print','Admin\ProductListController@print')->name('productList.print');

		// Business Settings End

		// Product Lifting Start

			// Lifting Setup
			Route::get('/lifting','Admin\LiftingController@index')->name('lifting.index');
			Route::get('/lifting-add','Admin\LiftingController@addLifting')->name('lifting.add');
			Route::post('/lifting-save','Admin\LiftingController@saveLifting')->name('lifting.save');
			Route::get('/lifting-edit/{id}','Admin\LiftingController@editLifting')->name('lifting.edit');
			Route::post('/lifting-update','Admin\LiftingController@updateLifting')->name('lifting.update');
			Route::post('/lifting-delete','Admin\LiftingController@deleteLifting')->name('lifting.delete');
			Route::post('/lifting-product-info','Admin\LiftingController@liftingProductInfo')->name('lifting.productInfo');

			// Payment to Company
			Route::get('/payment-to-company','Admin\PaymentToCompanyController@index')->name('paymentToCompany.index');
			Route::get('/payment-to-company/add','Admin\PaymentToCompanyController@addPaymentToCompany')->name('paymentToCompany.add');
			Route::post('/payment-to-company/save','Admin\PaymentToCompanyController@savePaymentToCompany')->name('paymentToCompany.save');
			Route::get('/payment-to-company/edit/{id}','Admin\PaymentToCompanyController@editPaymentToCompany')->name('paymentToCompany.edit');
			Route::post('/payment-to-company/update','Admin\PaymentToCompanyController@updatePaymentToCompany')->name('paymentToCompany.update');
			Route::post('/payment-to-company/delete','Admin\PaymentToCompanyController@deletePaymentToCompany')->name('paymentToCompany.delete');
			Route::post('/get-vendor-info','Admin\PaymentToCompanyController@getVendorInfo')->name('getVendorInfo');

			// Payment Record
			Route::get('/payment-record','Admin\PaymentRecordController@index')->name('paymentRecord.index');
			Route::post('/payment-record','Admin\PaymentRecordController@index')->name('paymentRecord.index');
			Route::post('/payment-record/print','Admin\PaymentRecordController@print')->name('paymentRecord.print');

			//Vendor Statement
			Route::get('/vendor-statement','Admin\VendorStatementController@index')->name('vendorStatement.index');
			Route::post('/vendor-statement','Admin\VendorStatementController@index')->name('vendorStatement.index');
			Route::post('/vendor-statement/print', 'Admin\VendorStatementController@print')->name('vendorStatement.print');

		// Product Lifting End
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