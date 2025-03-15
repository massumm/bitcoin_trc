<?php

use App\Http\Controllers\Admin\PaymentListController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\C_Code_Controller;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PrescriptionOrderController;


Route::post('register', [AuthController::class, 'register']);


Route::post('login', [AuthController::class, 'login']);
// Route::post('check-user/{mobile}', [AuthController::class, 'check_user']);
Route::post('check-user', [AuthController::class, 'check_user']);
Route::put('forget-password/{mobile}', [AuthController::class, 'forget_password']);
Route::get('country-codes', [C_Code_Controller::class, 'api_view']);
//get all  payment list
Route::get('payment-list', [PaymentListController::class, 'api_view']);
     //Get basic settings
Route::get('settings', [SettingsController::class, 'api_settings_view']);
       //Get pages settings
Route::get('settings/pages', [SettingsController::class, 'api_pages_view']);

Route::get('getline/{user_name}', [AuthController::class, 'userinfo']);

Route::put('line/{user_id}', [AuthController::class, 'line_updated']);
Route::middleware(['auth:sanctum'])->group(function () {

    //user logout api
    Route::post('logout', [AuthController::class, 'logout']);

    //Update user profile api
    Route::put('update-profile/{user_id}', [AuthController::class, 'update_profile']);
     //line added
 

    //Prescription photo adding api
    Route::post('prescription-order/add', [PrescriptionOrderController::class, 'order_from_api']);

    //Get All Order List by user api
    Route::get('get-all-order/{user_id}', [PrescriptionOrderController::class, 'api_show']);

    //Get All medicine list from Order by order id api
    Route::get('get-medicine-list/{order_id}', [PrescriptionOrderController::class, 'order_medicine_list']);

    //Order Reject/Cancel api
    Route::put('reject-order/{order_id}', [PrescriptionOrderController::class, 'rejectOrder']);

    //Order Accept api
    Route::put('accept-order/{order_id}', [PrescriptionOrderController::class, 'acceptOrder']);

    //Get All Notification List by user api
    Route::get('get-notifications/{user_id}', [NotificationController::class, 'api_show']);

});
