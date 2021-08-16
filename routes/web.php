<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PartnerController;

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

Route::get('/',[AdminController::class,  'login']);
Route::post('/login-submit',[AdminController::class, 'login_submit'])->name('login_submit');

Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function(){
	Route::get('/dashboard',[AdminController::class,  'dashboard'])->name('dashboard');
	Route::get('/change-password',[AdminController::class,  'change_password'])->name('change_password');
	Route::post('/confirm-password-submit',[AdminController::class,  'confirm_password_submit'])->name('confirm_password_submit');
	Route::get('/industries-list',[AdminController::class,  'industries_list'])->name('industries_list');
	Route::get('/industry-add',[AdminController::class,  'industry_add'])->name('industry_add');
	Route::get('/tenure-list',[AdminController::class,  'tenure_list'])->name('tenure_list');
	Route::post('/industry-add-submit',[AdminController::class,  'industry_add_submit'])->name('industry_add_submit');
	Route::get('/industry-edit/{id}',[AdminController::class,  'industry_edit'])->name('industry_edit');
	Route::post('/industry-edit-submit',[AdminController::class,  'industry_edit_submit'])->name('industry_edit_submit');
	Route::get('/tenure-fee-details/{id}',[AdminController::class,  'tenure_fee_details'])->name('tenure_fee_details');
	Route::post('/tenure-fee-details-submit',[AdminController::class,  'tenure_fee_details_submit'])->name('tenure_fee_details_submit');
    Route::get('/fresh-cte-add',[AdminController::class,  'fresh_cte_add'])->name('fresh_cte_add');
    Route::get('/industry-id-to-category/{id}',[AdminController::class,  'industry_id_to_category'])->name('industry_id_to_category');    
    Route::get('/fresh-cte-fee-calculate',[AdminController::class,  'fresh_cte_fee_calculate'])->name('fresh_cte_fee_calculate');

    Route::get('/extension-cte-fee-calculate',[AdminController::class,  'extension_cte_fee_calculate'])->name('extension_cte_fee_calculate');

	Route::get('/generated-cte-list',[AdminController::class,  'generated_cte_list'])->name('generated_cte_list');
    Route::get('/fresh-cto-add',[AdminController::class,  'fresh_cto_add'])->name('fresh_cto_add');
    // Route::get('/fee-calculate-cto',[AdminController::class,  'fee_calculate_cto'])->name('fee_calculate_cto');

    Route::get('/fresh-cte-add-page',[AdminController::class,  'fresh_cte_add_page'])->name('fresh_cte_add_page');
    Route::get('/extension-cte-add-page',[AdminController::class,  'extension_cte_add_page'])->name('extension_cte_add_page');

    Route::get('/fresh-cto-add-page',[AdminController::class,  'fresh_cto_add_page'])->name('fresh_cto_add_page');
    Route::get('/fresh-cto-fee-calculate',[AdminController::class,  'fresh_cto_fee_calculate'])->name('fresh_cto_fee_calculate');

    Route::get('/extension-cto-add-page',[AdminController::class,  'extension_cto_add_page'])->name('extension_cto_add_page');

    Route::get('/industry-id-to-category-cto/{id}',[AdminController::class,  'industry_id_to_category_cto'])->name('industry_id_to_category_cto');
    Route::get('/extension-cto-fee-calculate',[AdminController::class,  'extension_cto_fee_calculate'])->name('extension_cto_fee_calculate');    

    Route::get('/ajax-extension-cto-penalty-check',[AdminController::class,  'ajax_extension_cto_penalty_check'])->name('ajax_extension_cto_penalty_check');    
     Route::get('/fresh-cte-pdf/{id}/{pdf?}',[AdminController::class,  'fresh_cte_pdf'])->name('fresh_cte_pdf');

     Route::get('/generated-extension-cte-list',[AdminController::class,  'generated_extension_cte_list'])->name('generated_extension_cte_list');
     Route::get('/extension-cte-pdf/{id}/{pdf?}',[AdminController::class,  'extension_cte_pdf'])->name('extension_cte_pdf');
     Route::get('/export_fresh_cte/{id}',[AdminController::class,  'export_fresh_cte'])->name('export_fresh_cte');

     Route::get('/fresh-extension-pdf/{id}/{pdf?}',[AdminController::class,  'fresh_extension_pdf'])->name('fresh_extension_pdf');

    Route::get('/export_fresh_extension/{id}',[AdminController::class,  'export_fresh_extension'])->name('export_fresh_extension');

    Route::get('/renew-cto-calculate',[AdminController::class,  'renew_cto_fee_calculate'])->name('renew_cto_fee_calculate');

	Route::get('/generated-cto-list',[AdminController::class,  'generated_cto_list'])->name('generated_cto_list');
	 Route::get('/renew-cto-pdf/{id}/{pdf?}',[AdminController::class,  'renew_cto_pdf'])->name('renew_cto_pdf');

	     Route::get('/regulation-add',[AdminController::class,  'regulation_add'])->name('regulation_add');
    Route::get('/regulation-fee-calculate',[AdminController::class,  'regulation_fee_calculate'])->name('regulation_fee_calculate');

    Route::get('/industry-id-to-category-cte-extension',[AdminController::class,  'industry_id_to_category_cte_extension'])->name('industry_id_to_category_cte_extension');


    



























	Route::get('/company-financial-api',[AdminController::class,  'company_financial_api'])->name('company_financial_api');
	Route::get('/company-financial-api-submit/{symbol}',[AdminController::class,  'company_financial_api_submit']);


	Route::get('/company-financial-data',[AdminController::class,  'company_financial_data'])->name('company_financial');
	Route::get('/profile-edit',[AdminController::class,  'profile_edit'])->name('profile_edit');

	Route::get('/role-list',[RoleController::class,  'role_list'])->name('role_list');
	Route::get('/role-add',[RoleController::class,  'role_add'])->name('role_add');
	Route::post('/role-add-submit',[RoleController::class,  'role_add_submit'])->name('role_add_submit');

	Route::get('/user-list',[AdminController::class,  'user_list'])->name('user_list');
	Route::get('/user-add',[AdminController::class,  'user_add'])->name('user_add');
	Route::post('/user-add-submit',[AdminController::class,  'user_add_submit'])->name('user_add_submit');

	Route::get('/user-edit/{id}',[AdminController::class,  'user_edit'])->name('user_edit');
	Route::post('/user-edit-submit',[AdminController::class,  'user_edit_submit'])->name('user_edit_submit');
	Route::get('/user-delete/{id}',[AdminController::class,  'user_delete'])->name('user_delete');

	Route::get('/partner-list',[PartnerController::class,  'partner_list'])->name('partner_list');
	Route::get('/partner-add',[PartnerController::class,  'partner_add'])->name('partner_add');
	Route::post('/partner-add-submit',[PartnerController::class,  'partner_add_submit'])->name('partner_add_submit');
	Route::get('/partner-change-status/{id}/{status}',[PartnerController::class,  'partner_change_status'])->name('partner_change_status');
	Route::get('/partner-edit/{id}',[PartnerController::class,  'partner_edit'])->name('partner_edit');
	Route::post('/partnet-edit-submit',[PartnerController::class,  'partner_edit_submit'])->name('partner_edit_submit');
	Route::get('/partner-delete/{id}',[PartnerController::class,  'partner_delete'])->name('partner_delete');



















	Route::get('/logout',function(){
		session()->flush();
		return redirect('/')->with('error_message','You have successfully logout');
	})->name('logout');

       
});