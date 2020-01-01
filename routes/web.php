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
			Route::get('/company-setup-add','Admin\CompanySetupController@add')->name('companySetup.add');
			Route::post('/company-setup-save','Admin\CompanySetupController@save')->name('companySetup.save');
			Route::get('/company-setup-edit/{id}','Admin\CompanySetupController@edit')->name('companySetup.edit');
			Route::post('/company-setup-update','Admin\CompanySetupController@update')->name('companySetup.update');


			//Showroom Setup
			Route::get('/showroom-setup','Admin\ShowroomSetupController@index')->name('showroomSetup.index');
			Route::get('/showroom-setup-add','Admin\ShowroomSetupController@add')->name('showroomSetup.add');
			Route::post('/showroom-setup-save','Admin\ShowroomSetupController@save')->name('showroomSetup.save');
			Route::get('/showroom-setup-edit/{id}','Admin\ShowroomSetupController@edit')->name('showroomSetup.edit');
			Route::post('/showroom-setup-update','Admin\ShowroomSetupController@update')->name('showroomSetup.update');
			Route::post('/showroom-setup-delete','Admin\ShowroomSetupController@delete')->name('showroomSetup.delete');
			Route::post('/showroom-setup','Admin\ShowroomSetupController@changeStatus')->name('showroomSetup.status');
		// User Management End

		// Bussiness Settings

			//Category Setup
			Route::get('/category-setup','Admin\CategorySetupController@index')->name('categorySetup.index');
			Route::get('/category-setup-add','Admin\CategorySetupController@add')->name('categorySetup.add');
			Route::post('/category-setup-save','Admin\CategorySetupController@save')->name('categorySetup.save');
			Route::get('/category-setup-edit/{id}','Admin\CategorySetupController@edit')->name('categorySetup.edit');
			Route::post('/category-setup-update','Admin\CategorySetupController@update')->name('categorySetup.update');
			Route::post('/category-setup-delete','Admin\CategorySetupController@delete')->name('categorySetup.delete');
			Route::post('/category-setup-status','Admin\CategorySetupController@changeStatus')->name('categorySetup.status');


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
			Route::get('/store-setup-add','Admin\StoreSetupController@add')->name('storeSetup.add');
			Route::post('/store-setup-save','Admin\StoreSetupController@save')->name('storeSetup.save');
			Route::get('/store-setup-edit/{id}','Admin\StoreSetupController@edit')->name('storeSetup.edit');
			Route::post('/store-setup-update','Admin\StoreSetupController@update')->name('storeSetup.update');
			Route::post('/store-setup-delete','Admin\StoreSetupController@delete')->name('storeSetup.delete');
			Route::post('/store-setup-status','Admin\StoreSetupController@changeStatus')->name('storeSetup.status');

			// Bank Setup
			Route::get('/bank-setup','Admin\BankSetupController@index')->name('bankSetup.index');
			Route::get('/bank-setup-add','Admin\BankSetupController@add')->name('bankSetup.add');
			Route::post('/bank-setup-save','Admin\BankSetupController@save')->name('bankSetup.save');
			Route::get('/bank-setup-edit/{id}','Admin\BankSetupController@edit')->name('bankSetup.edit');
			Route::post('/bank-setup-update','Admin\BankSetupController@update')->name('bankSetup.update');
			Route::post('/bank-setup-delete','Admin\BankSetupController@delete')->name('bankSetup.delete');
			Route::post('/bank-setup-status','Admin\BankSetupController@changeStatus')->name('bankSetup.status');

			// Courier Setup
			Route::get('/courier-setup','Admin\CourierSetupController@index')->name('courierSetup.index');
			Route::get('/courier-setup-add','Admin\CourierSetupController@add')->name('courierSetup.add');
			Route::post('/courier-setup-save','Admin\CourierSetupController@save')->name('courierSetup.save');
			Route::get('/courier-setup-edit/{id}','Admin\CourierSetupController@edit')->name('courierSetup.edit');
			Route::post('/courier-setup-update','Admin\CourierSetupController@update')->name('courierSetup.update');
			Route::post('/courier-setup-delete','Admin\CourierSetupController@delete')->name('courierSetup.delete');
			Route::post('/courier-setup-status','Admin\CourierSetupController@changeStatus')->name('courierSetup.status');

			// Vehicle Setup
			Route::get('/vehicle-setup','Admin\VehicleSetupController@index')->name('vehicleSetup.index');
			Route::get('/vehicle-setup-add','Admin\VehicleSetupController@add')->name('vehicleSetup.add');
			Route::post('/vehicle-setup-save','Admin\VehicleSetupController@save')->name('vehicleSetup.save');
			Route::get('/vehicle-setup-edit/{id}','Admin\VehicleSetupController@edit')->name('vehicleSetup.edit');
			Route::post('/vehicle-setup-update','Admin\VehicleSetupController@update')->name('vehicleSetup.update');
			Route::post('/vehicle-setup-delete','Admin\VehicleSetupController@delete')->name('vehicleSetup.delete');
			Route::post('/vehicle-setup-status','Admin\VehicleSetupController@changeStatus')->name('vehicleSetup.status');

			// Area Setup
			Route::get('/area-setup','Admin\AreaSetupController@index')->name('areaSetup.index');
			Route::get('/area-setup-add','Admin\AreaSetupController@add')->name('areaSetup.add');
			Route::post('/area-setup-save','Admin\AreaSetupController@save')->name('areaSetup.save');
			Route::get('/area-setup-edit/{id}','Admin\AreaSetupController@edit')->name('areaSetup.edit');
			Route::post('/area-setup-update','Admin\AreaSetupController@update')->name('areaSetup.update');
			Route::post('/area-setup-delete','Admin\AreaSetupController@delete')->name('areaSetup.delete');
			Route::post('/area-setup-status','Admin\AreaSetupController@changeStatus')->name('areaSetup.status');

			// Territory Setup
			Route::get('/territory-setup','Admin\TerritorySetupController@index')->name('territorySetup.index');
			Route::get('/territory-setup-add','Admin\TerritorySetupController@add')->name('territorySetup.add');
			Route::post('/territory-setup-save','Admin\TerritorySetupController@save')->name('territorySetup.save');
			Route::get('/territory-setup-edit/{id}','Admin\TerritorySetupController@edit')->name('territorySetup.edit');
			Route::post('/territory-setup-update','Admin\TerritorySetupController@update')->name('territorySetup.update');
			Route::post('/territory-setup-delete','Admin\TerritorySetupController@delete')->name('territorySetup.delete');
			Route::post('/territory-setup-status','Admin\TerritorySetupController@changeStatus')->name('territorySetup.status');

			// Staff Setup
			Route::get('/staff-setup','Admin\StaffSetupController@index')->name('staffSetup.index');
			Route::get('/staff-setup-add','Admin\StaffSetupController@add')->name('staffSetup.add');
			Route::post('/staff-setup-save','Admin\StaffSetupController@save')->name('staffSetup.save');
			Route::get('/staff-setup-edit/{id}','Admin\StaffSetupController@edit')->name('staffSetup.edit');
			Route::post('/staff-setup-update','Admin\StaffSetupController@update')->name('staffSetup.update');
			Route::post('/staff-setup-delete','Admin\StaffSetupController@delete')->name('staffSetup.delete');
			Route::post('/staff-setup-status','Admin\StaffSetupController@changeStatus')->name('staffSetup.status');
			Route::get('/staff-setup/print','Admin\StaffSetupController@print')->name('staffSetup.print');

			// Vendor Setup
			Route::get('/vendor-setup','Admin\VendorSetupController@index')->name('vendorSetup.index');
			Route::get('/vendor-setup-add','Admin\VendorSetupController@add')->name('vendorSetup.add');
			Route::post('/vendor-setup-save','Admin\VendorSetupController@save')->name('vendorSetup.save');
			Route::get('/vendor-setup-edit/{id}','Admin\VendorSetupController@edit')->name('vendorSetup.edit');
			Route::post('/vendor-setup-update','Admin\VendorSetupController@update')->name('vendorSetup.update');
			Route::post('/vendor-setup-delete','Admin\VendorSetupController@delete')->name('vendorSetup.delete');
			Route::post('/vendor-setup-status','Admin\VendorSetupController@changeStatus')->name('vendorSetup.status');

			//Group Setup
			Route::get('/group-setup','Admin\GroupSetupController@index')->name('groupSetup.index');
			Route::get('/group-setup-add','Admin\GroupSetupController@add')->name('groupSetup.add');
			Route::post('/group-setup-save','Admin\GroupSetupController@save')->name('groupSetup.save');
			Route::get('/group-setup-edit/{id}','Admin\GroupSetupController@edit')->name('groupSetup.edit');
			Route::post('/group-setup-update','Admin\GroupSetupController@update')->name('groupSetup.update');
			Route::post('/group-setup-delete','Admin\GroupSetupController@delete')->name('groupSetup.delete');
			Route::post('/group-setup-status','Admin\GroupSetupController@changeStatus')->name('groupSetup.status');
			Route::post('/group-setup-status/staff-list','Admin\GroupSetupController@getAllStaff')->name('groupSetup.getAllStaff');

			//Product List
			Route::get('/product-list','Admin\ProductListController@index')->name('productList.index');
			Route::post('/product-list','Admin\ProductListController@index')->name('productList.index');
			Route::post('/product-list/print','Admin\ProductListController@print')->name('productList.print');

		// Business Settings End

		// Product Lifting Start

			// Lifting
			Route::get('/lifting','Admin\LiftingController@index')->name('lifting.index');
			Route::get('/lifting-add','Admin\LiftingController@add')->name('lifting.add');
			Route::post('/lifting-save','Admin\LiftingController@save')->name('lifting.save');
			Route::get('/lifting-edit/{id}','Admin\LiftingController@edit')->name('lifting.edit');
			Route::post('/lifting-update','Admin\LiftingController@update')->name('lifting.update');
			Route::post('/lifting-delete','Admin\LiftingController@delete')->name('lifting.delete');
			Route::post('/lifting-product-info','Admin\LiftingController@liftingProductInfo')->name('lifting.productInfo');
			Route::get('/lifting-print/{id}','Admin\LiftingController@print')->name('lifting.print');

			// Lifting Return
			Route::get('/lifting-return','Admin\LiftingReturnController@index')->name('liftingReturn.index');
			Route::get('/lifting-return-add','Admin\LiftingReturnController@add')->name('liftingReturn.add');
			Route::post('/lifting-return-save','Admin\LiftingReturnController@save')->name('liftingReturn.save');
			Route::get('/lifting-return-edit/{id}','Admin\LiftingReturnController@edit')->name('liftingReturn.edit');
			Route::post('/lifting-return-update','Admin\LiftingReturnController@update')->name('liftingReturn.update');
			Route::post('/lifting-return-delete','Admin\LiftingReturnController@delete')->name('liftingReturn.delete');
			Route::post('/lifting-return-product-info','Admin\LiftingReturnController@liftingProductInfo')->name('liftingReturn.liftingProductInfo');
			Route::get('/lifting-return-print/{id}','Admin\LiftingReturnController@print')->name('liftingReturn.print');

			// Payment to Company
			Route::get('/payment-to-company','Admin\PaymentToCompanyController@index')->name('paymentToCompany.index');
			Route::get('/payment-to-company/add','Admin\PaymentToCompanyController@add')->name('paymentToCompany.add');
			Route::post('/payment-to-company/save','Admin\PaymentToCompanyController@save')->name('paymentToCompany.save');
			Route::get('/payment-to-company/edit/{id}','Admin\PaymentToCompanyController@edit')->name('paymentToCompany.edit');
			Route::post('/payment-to-company/update','Admin\PaymentToCompanyController@update')->name('paymentToCompany.update');
			Route::post('/payment-to-company/delete','Admin\PaymentToCompanyController@delete')->name('paymentToCompany.delete');
			Route::post('/get-vendor-info','Admin\PaymentToCompanyController@getVendorInfo')->name('getVendorInfo');

			// Payment Record
			Route::get('/payment-record','Admin\PaymentRecordController@index')->name('paymentRecord.index');
			Route::post('/payment-record','Admin\PaymentRecordController@index')->name('paymentRecord.index');
			Route::post('/payment-record/print','Admin\PaymentRecordController@print')->name('paymentRecord.print');

			// Lifting Record
			Route::get('/lifting-record','Admin\LiftingRecordController@index')->name('liftingRecord.index');
			Route::post('/lifting-record','Admin\LiftingRecordController@index')->name('liftingRecord.index');
			Route::post('/lifting-record/print','Admin\LiftingRecordController@print')->name('liftingRecord.print');

			// Lifting Return Record
			Route::get('/lifting-return-record','Admin\LiftingReturnRecordController@index')->name('liftingReturnRecord.index');
			Route::post('/lifting-return-record','Admin\LiftingReturnRecordController@index')->name('liftingReturnRecord.index');
			Route::post('/lifting-return-record/print','Admin\LiftingReturnRecordController@print')->name('liftingReturnRecord.print');

			//Lifting & payment Summery
			Route::get('/lifting-payment-summary','Admin\LiftingPaymentSummaryController@index')->name('liftingPaymentSummary.index');
			Route::post('/lifting-payment-summary','Admin\LiftingPaymentSummaryController@index')->name('liftingPaymentSummary.index');
			Route::post('/lifting-payment-summary/print','Admin\LiftingPaymentSummaryController@print')->name('liftingPaymentSummary.print');

			//Vendor Statement
			Route::get('/vendor-statement','Admin\VendorStatementController@index')->name('vendorStatement.index');
			Route::post('/vendor-statement','Admin\VendorStatementController@index')->name('vendorStatement.index');
			Route::post('/vendor-statement/print', 'Admin\VendorStatementController@print')->name('vendorStatement.print');

		// Product Lifting End

		// Start Inventory Management

			//Out Of Stock Report
			Route::get('/out-of-stock','Admin\OutOfStockController@index')->name('outOfStock.index');
			Route::post('/out-of-stock','Admin\OutOfStockController@index')->name('outOfStock.index');
			Route::post('/out-of-stock/print','Admin\OutOfStockController@print')->name('outOfStock.print');

			//Stock Valuation Report
			Route::get('/stock-valuation','Admin\StockValuationController@index')->name('stockValuation.index');
			Route::post('/stock-valuation','Admin\StockValuationController@index')->name('stockValuation.index');
			Route::post('/stock-valuation/print','Admin\StockValuationController@print')->name('stockValuation.print');

			//Stock Status Report
			Route::get('/stock-status','Admin\StockStatusController@index')->name('stockStatus.index');
			Route::post('/stock-status','Admin\StockStatusController@index')->name('stockStatus.index');
			Route::post('/stock-status/print','Admin\StockStatusController@print')->name('stockStatus.print');

			// Product Transfer
			Route::get('/transfer-product','Admin\TransferProductController@index')->name('transferProduct.index');
			Route::get('/transfer-product-add','Admin\TransferProductController@add')->name('transferProduct.add');
			Route::post('/transfer-product-save','Admin\TransferProductController@save')->name('transferProduct.save');
			Route::get('/transfer-product-edit/{id}','Admin\TransferProductController@edit')->name('transferProduct.edit');
			Route::post('-transfer-product-update','Admin\TransferProductController@update')->name('transferProduct.update');
			Route::post('/transfer-product-delete','Admin\TransferProductController@delete')->name('transferProduct.delete');
			Route::post('/transfer-product/store-showroom-list','Admin\TransferProductController@storeAndShowroomInfo')->name('transferProduct.storeAndShowroomInfo');
			Route::post('/transfer-product/product-info','Admin\TransferProductController@liftingProductInfo')->name('transferProduct.liftingProductInfo');
			Route::get('/transfer-product-print/{id}','Admin\TransferProductController@print')->name('transferProduct.print');

			// Transfer Report
			Route::get('/transport-report','Admin\TransferReportController@index')->name('transferReport.index');
			Route::post('/transport-report','Admin\TransferReportController@index')->name('transferReport.index');
			Route::post('/transport-report/print','Admin\TransferReportController@print')->name('transferReport.print');

			//Product Statement
			Route::get('/product-statement','Admin\ProductStatementController@index')->name('productStatement.index');
			Route::post('/product-statement','Admin\ProductStatementController@index')->name('productStatement.index');
			Route::post('/product-statement/print','Admin\ProductStatementController@print')->name('productStatement.print');

		// End Inventory Management

		// Start Sales Management

			//Customer registration setup developed by Jisan
			Route::get('/customer-registration-setup','Admin\CustomerRegistrationSetupController@index')->name('customerRegistraionSetup.index');

			Route::get('/customer-registration-setup-add','Admin\CustomerRegistrationSetupController@add')->name('customerRegistraionSetup.add');
			Route::post('/customer-registration-setup-save','Admin\CustomerRegistrationSetupController@save')->name('customerRegistraionSetup.save');

			Route::get('/customer-registration-setup-view/{id}','Admin\CustomerRegistrationSetupController@viewCustomerDetails')->name('customerRegistraionSetup.view');
			Route::post('/customer-registration-setup-new-product-save','Admin\CustomerRegistrationSetupController@newProductSave')->name('customerRegistraionSetup.NewProductSave');
			
			Route::post('/customer-registration-setup-delete','Admin\CustomerRegistrationSetupController@delete')->name('customerRegistraionSetup.delete');
			Route::post('/customer-registration/get-product-info','Admin\CustomerRegistrationSetupController@getProductInfo')->name('customerRegistration.getProductInfo');

			Route::post('/customer-registration/get-guarantor-info','Admin\CustomerRegistrationSetupController@getGuarantorInfo')->name('customerRegistration.getGuarantorInfo');

			Route::get('/customer-registration-setup-edit/{id}','Admin\CustomerRegistrationSetupController@edit')->name('customerRegistraionSetup.editCustomer');
			Route::post('/customer-registration-setup-update','Admin\CustomerRegistrationSetupController@update')->name('customerRegistraionSetup.update');

			Route::get('/customer-registration-setup/{customerId}/product-edit/{productId}/','Admin\CustomerRegistrationSetupController@editCustomerProduct')->name('customerRegistraionSetup.editCustomerProduct');
			Route::post('/customer-registration-setup/update-customer-product','Admin\CustomerRegistrationSetupController@editCustomerProduct')->name('customerRegistraionSetup.updateCustomerProduct');

			Route::get('/customer-registration-setup/{customerId}/guarantor-edit/{guarantorId}/','Admin\CustomerRegistrationSetupController@editGuarantor')->name('customerRegistraionSetup.editGuarantor');
			Route::post('/customer-registration-setup/update-customer-guarantor','Admin\CustomerRegistrationSetupController@editGuarantor')->name('customerRegistraionSetup.updateCustomerGuarantor');

			Route::get('/customer-registration-setup/print/{customerId}','Admin\CustomerRegistrationSetupController@print')->name('customerRegistraionSetup.print');

			Route::get('/customer-registration-setup/print','Admin\CustomerRegistrationSetupController@customerListPrint')->name('customerRegistraionSetup.customerListPrint');

			//Invoice setup developed by Jisan
			Route::get('/invoice-setup','Admin\InvoiceSetupController@index')->name('invoiceSetup.index');
			Route::get('/invoice-setup-add','Admin\InvoiceSetupController@add')->name('invoiceSetup.add');
			Route::post('/invoice-setup-add','Admin\InvoiceSetupController@add')->name('invoiceSetup.add');
			Route::get('/invoice-setup-view/{id}','Admin\InvoiceSetupController@view')->name('invoiceSetup.view');
			Route::get('/invoice-setup-print-invoice/{invoiceId}','Admin\InvoiceSetupController@printInvoice')->name('invoiceSetup.printInvoice');
			Route::get('/invoice-setup-print-chalan/{invoiceId}','Admin\InvoiceSetupController@printChalan')->name('invoiceSetup.printChalan');
			Route::post('/invoice-setup-delete','Admin\InvoiceSetupController@delete')->name('invoiceSetup.delete');
			Route::post('/invoice-setup/product-list','Admin\InvoiceSetupController@getAllProduct')->name('invoiceSetup.getAllProduct');
			Route::post('/invoice-setup/product-serial-list','Admin\InvoiceSetupController@getAllProductSerial')->name('invoiceSetup.getAllProductSerial');

			//Cash Collection developed by Jisan
			Route::get('/cash-collection','Admin\CashCollectionController@index')->name('cashCollection.index');

			Route::get('/cash-collection-add','Admin\CashCollectionController@add')->name('cashCollection.add');
			Route::post('/cash-collection-save','Admin\CashCollectionController@save')->name('cashCollection.save');
			Route::post('/cash-collection-get-invoice-information','Admin\CashCollectionController@getInvoiceInformation')->name('cashCollection.getInvoiceInformation');

			Route::get('/cash-collection-edit/{id}','Admin\CashCollectionController@edit')->name('cashCollection.edit');
			Route::post('/cash-collection-update','Admin\CashCollectionController@update')->name('cashCollection.update');

			Route::get('/cash-collection-print/{collectionId}','Admin\CashCollectionController@print')->name('cashCollection.print');

			Route::post('/cash-collection-delete','Admin\CashCollectionController@delete')->name('cashCollection.delete');

			//Group Sales Target Setup
			Route::get('/group-sales-target-setup','Admin\GroupSalesTargetSetupController@index')->name('groupSalesTargetSetup.index');
			Route::get('/group-sales-target-setup-add','Admin\GroupSalesTargetSetupController@add')->name('groupSalesTargetSetup.add');
			Route::post('/group-sales-target-setup-save','Admin\GroupSalesTargetSetupController@save')->name('groupSalesTargetSetup.save');
			Route::get('/group-sales-target-setup-edit/{id}','Admin\GroupSalesTargetSetupController@edit')->name('groupSalesTargetSetup.edit');
			Route::post('/group-sales-target-setup-update','Admin\GroupSalesTargetSetupController@update')->name('groupSalesTargetSetup.update');
			Route::post('/group-sales-target-setup-delete','Admin\GroupSalesTargetSetupController@delete')->name('groupSalesTargetSetup.delete');

			// Start Customer Outstanding Report
			Route::get('/customer-outstanding','Admin\CustomerOutstandingController@index')->name('customerOutstanding.index');
			Route::post('/customer-outstanding','Admin\CustomerOutstandingController@index')->name('customerOutstanding.index');
			Route::post('/customer-outstanding/print','Admin\CustomerOutstandingController@print')->name('customerOutstanding.print');

			// Start Customer Statement Report
			Route::get('/customer-statement','Admin\CustomerStatementController@index')->name('customerStatement.index');
			Route::post('/customer-statement','Admin\CustomerStatementController@index')->name('customerStatement.index');
			Route::post('/customer-statement/print','Admin\CustomerStatementController@print')->name('customerStatement.print');

		// End Sales Management

		// Start Installment Management

			/*Installment schedule section*/
			Route::get('/installment-schedule','Admin\InstallmentScheduleController@index')->name('installmentSchedule.index');

			Route::get('/installment-schedule-add','Admin\InstallmentScheduleController@add')->name('installmentSchedule.add');
			Route::post('/installment-schedule-save','Admin\InstallmentScheduleController@save')->name('installmentSchedule.save');

			Route::get('/installment-schedule-edit/{id}','Admin\InstallmentScheduleController@edit')->name('installmentSchedule.edit');
			Route::post('/installment-schedule-update','Admin\InstallmentScheduleController@update')->name('installmentSchedule.update');

			Route::post('/installment-schedule-delete','Admin\InstallmentScheduleController@delete')->name('installmentSchedule.delete');

			Route::post('/installment-schedule-get-customerproduct-info','Admin\InstallmentScheduleController@getCustomerProductInfo')->name('installmentSchedule.getCustomerProductInfo');

			Route::get('/installment-schedule-print/{id}','Admin\InstallmentScheduleController@print')->name('installmentSchedule.print');

			//End Installment Module

			/*Installment  collection*/
			Route::get('/installment-collection','Admin\InstallmentCollectionController@index')->name('installmentCollection.index');

			Route::get('/installment-collection-add','Admin\InstallmentCollectionController@add')->name('installmentCollection.add');
			Route::post('/installment-collection-save','Admin\InstallmentCollectionController@save')->name('installmentCollection.save');

			Route::get('/installment-collection-edit/{id}','Admin\InstallmentCollectionController@edit')->name('installmentCollection.edit');
			Route::post('/installment-collection-update','Admin\InstallmentCollectionController@update')->name('installmentCollection.update');

			Route::post('/installment-collection-delete','Admin\InstallmentCollectionController@delete')->name('installmentCollection.delete');

			Route::post('/installment-collection-get-installment-info','Admin\InstallmentCollectionController@getInstallmentInfo')->name('installmentCollection.getInstallmentInfo');

			//Drop Collection List
			Route::get('/drop-collection-list','Admin\DropCollectionController@index')->name('dropCollection.index');
			Route::post('/drop-collection-list','Admin\DropCollectionController@index')->name('dropCollection.index');
			Route::post('/drop-collection-list-print','Admin\DropCollectionController@print')->name('dropCollection.print');

			//Prospective Collection List
			Route::get('/prospective-collection-list','Admin\ProspectiveCollectionController@index')->name('prospectiveCollection.index');
			Route::post('/prospective-collection-list','Admin\ProspectiveCollectionController@index')->name('prospectiveCollection.index');
			Route::post('/prospective-collection-list-print','Admin\ProspectiveCollectionController@print')->name('prospectiveCollection.print');
			
		// End Installment Management

		// Start Dealer Management

			// Dealer Setup
			Route::get('/dealer-setup','Admin\DealerSetupController@index')->name('dealerSetup.index');
			Route::get('/dealer-setup-add','Admin\DealerSetupController@add')->name('dealerSetup.add');
			Route::post('/dealer-setup-save','Admin\DealerSetupController@save')->name('dealerSetup.save');
			Route::get('/dealer-setup-edit/{id}','Admin\DealerSetupController@edit')->name('dealerSetup.edit');
			Route::post('/dealer-setup-update','Admin\DealerSetupController@update')->name('dealerSetup.update');
			Route::post('/dealer-setup-delete','Admin\DealerSetupController@delete')->name('dealerSetup.delete');
			Route::post('/dealer-setup-status','Admin\DealerSetupController@changeStatus')->name('dealerSetup.status');
			Route::post('/dealer-setup/upazila-list','Admin\DealerSetupController@getAllUpazilaByDistrict')->name('dealerSetup.getAllUpazilaByDistrict');

			// Dealer Product Requisition
			Route::get('/dealer-requisition','Admin\DealerRequisitionController@index')->name('dealerRequisition.index');
			Route::get('/dealer-requisition-add','Admin\DealerRequisitionController@add')->name('dealerRequisition.add');
			Route::post('/dealer-requisition-save','Admin\DealerRequisitionController@save')->name('dealerRequisition.save');
			Route::get('/dealer-requisition-edit/{id}','Admin\DealerRequisitionController@edit')->name('dealerRequisition.edit');
			Route::post('/dealer-requisition-update','Admin\DealerRequisitionController@update')->name('dealerRequisition.update');
			Route::post('/dealer-requisition-delete','Admin\DealerRequisitionController@delete')->name('dealerRequisition.delete');
			Route::post('/dealer-requisition-status','Admin\DealerRequisitionController@changeStatus')->name('dealerRequisition.status');
			Route::post('/dealer-requisition/product-info','Admin\DealerRequisitionController@productInfo')->name('dealerRequisition.productInfo');
			Route::post('/dealer-requisition/requisition-product-info','Admin\DealerRequisitionController@requisitionProductInfo')->name('dealerRequisition.requisitionProductInfo');

			// Dealer Requisition Approval
			Route::get('/dealer-requisition-approval','Admin\DealerRequisitionApprovalController@index')->name('dealerRequisitionApproval.index');
			Route::post('/dealer-requisition-approval-update','Admin\DealerRequisitionApprovalController@update')->name('dealerRequisitionApproval.update');
			Route::post('/dealer-requisition-approval/dealer-requisition-info','Admin\DealerRequisitionApprovalController@dealerRequisitionInfo')->name('dealerRequisitionApproval.dealerRequisitionInfo');

			// Dealer Product Issue
			Route::get('/product-issue','Admin\ProductIssueController@index')->name('productIssue.index');
			Route::get('/product-issue-add','Admin\ProductIssueController@add')->name('productIssue.add');
			Route::post('/product-issue-save','Admin\ProductIssueController@save')->name('productIssue.save');
			Route::get('/product-issue-edit/{id}','Admin\ProductIssueController@edit')->name('productIssue.edit');
			Route::post('/product-issue-update','Admin\ProductIssueController@update')->name('productIssue.update');
			Route::post('/product-issue-delete','Admin\ProductIssueController@delete')->name('productIssue.delete');
			Route::post('/product-issue-status','Admin\ProductIssueController@changeStatus')->name('productIssue.status');
			Route::post('/product-issue/product-info','Admin\ProductIssueController@productInfo')->name('productIssue.productInfo');
			Route::post('/product-issue/product-serial-info','Admin\ProductIssueController@productSerialInfo')->name('productIssue.productSerialInfo');
			Route::post('/product-issue/dealer-requisition-info','Admin\ProductIssueController@dealerRequisitionInfo')->name('productIssue.dealerRequisitionInfo');
		// End Dealer Management
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