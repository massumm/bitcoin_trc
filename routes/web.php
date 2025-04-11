<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\Client\Client_LogController::class, 'index']);
Route::get('/register', [App\Http\Controllers\Client\Client_RegisterController::class, 'index']);

Route::post('/register_client', [App\Http\Controllers\Client\Client_RegisterController::class, 'create_client']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//ute::get('/admin-login', [App\Http\Controllers\Admin\LogController::class, 'index'])->name('admin-login');
 //line view    view
 Route::get('/liff', [App\Http\Controllers\API\C_Code_Controller::class, 'liff_view'])->name(('liff'));
Route::prefix('client')->middleware(['auth'])->group(function () {
  Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index']);
  Route::get('/projectspage', [App\Http\Controllers\Client\MenuController::class, 'index']);
  Route::get('/projectdetails', [App\Http\Controllers\Client\MenuController::class, 'menudetails']);
  Route::get('/recordlist', [App\Http\Controllers\Client\RecordlistControllert::class, 'index']);
  Route::get('mine/deposit', [App\Http\Controllers\Client\PaymentController::class, 'deposit']);
  Route::get('mine/virtualdetail', [App\Http\Controllers\Client\PaymentController::class, 'virtualdetail']);
  Route::post('mine/depositpost', [App\Http\Controllers\Client\PaymentController::class, 'postVirtualDetail']);
  Route::post('mine/wallet', [App\Http\Controllers\Client\PaymentController::class, 'postWallet']);
  Route::get('mine/deposit_recordlist', [App\Http\Controllers\Client\PaymentController::class, 'deposit_recordlist']);
  Route::get('mine/withdraw_recordlist', [App\Http\Controllers\Client\PaymentController::class, 'withdraw_recordlist']);
  Route::post('mine/withdraw', [App\Http\Controllers\Client\PaymentController::class, 'store_withdraw']);
  Route::get('mine/card_manage', [App\Http\Controllers\Client\PaymentController::class, 'card_manage']);
  Route::get('mine/profile', [App\Http\Controllers\Client\MineController::class, 'profile']);
  Route::get('mine/withdraw', [App\Http\Controllers\Client\PaymentController::class, 'withdraw']);
  Route::get('mine/invite_friend', [App\Http\Controllers\Client\MineController::class, 'invite_friend']);
  Route::get('mine/team', [App\Http\Controllers\Client\MineController::class, 'team']);
  Route::get('mine/virtualcurrency', [App\Http\Controllers\Client\MineController::class, 'virtualcurrency']);
  Route::get('/mine', [App\Http\Controllers\Client\MineController::class, 'index']);
  Route::get('/setting', [App\Http\Controllers\Client\MineController::class, 'setting']);
  Route::get('/orders', [App\Http\Controllers\Client\OrderlistController::class, 'getOrders']);
  Route::post('/submit-order', [App\Http\Controllers\Client\OrderlistController::class, 'submitOrder']);
  Route::get('/random-products', [App\Http\Controllers\Client\OrderlistController::class, 'getRandomProducts']);
    Route::get('/platform-rules', function () {
      return view('client.screens.platform_rules');
  })->name('platform.rules');

  Route::get('/platform-profiles', function () {
    return view('client.screens.platform_profiles');
})->name('platform.profiles');
Route::get('/platform-cooperation', function () {
  return view('client.screens.platform_cooperation');
})->name('platform.cooperation');

Route::get('/platform-instruction', function () {
  return view('client.screens.platform_instruction');
})->name('platform.instruction');

  Route::get('/service', function () {
    return view('client.screens.services');
    })->name('service'); 

  Route::get('/help', function () {
    return view('client.screens.help');
  })->name('help');

});

Route::post('/logout', function () {
  Auth::logout();
  return redirect('/');
})->name('logout');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);


  

    //store medicine csv data
    Route::get('/add-medicine', [App\Http\Controllers\Admin\MedcineListController::class, 'view']);
    Route::post('/add-medicine', [App\Http\Controllers\Admin\MedcineListController::class, 'store']);
    Route::get('/download-medicines', [App\Http\Controllers\Admin\MedcineListController::class, 'downloadMedicineList']);
    //delete medicine from csv
    Route::get('/delete-medicine/{medicine_id}', [App\Http\Controllers\Admin\MedcineListController::class, 'destroy']);
     //edit medicine from csv
    Route::get('/edit-medicine/{medicine_id}', [App\Http\Controllers\Admin\MedcineListController::class, 'edit']);
      //update medicine from csv
    Route::put('/update-medicine/{medicine_id}', [App\Http\Controllers\Admin\MedcineListController::class, 'update']);
    //view medicine csv data
    Route::get('/view-medicine', [App\Http\Controllers\Admin\MedcineListController::class, 'view_medicine_list']);




    //Country Code
    Route::get('/add-Country-Code', [App\Http\Controllers\API\C_Code_Controller::class, 'index']);
    Route::post('/add-Country-Code', [App\Http\Controllers\API\C_Code_Controller::class, 'store']);
    //view country code
    Route::get('/view-country-code', [App\Http\Controllers\API\C_Code_Controller::class, 'view']);
    //edit country code
    Route::get('/edit-country-code/{c_code_id}', [App\Http\Controllers\API\C_Code_Controller::class, 'edit']);
    //update country code
    Route::put('/update-country-code/{c_code_id}', [App\Http\Controllers\API\C_Code_Controller::class, 'update']);
    //delete country code
    Route::get('/delete-country-code/{c_code_id}', [App\Http\Controllers\API\C_Code_Controller::class, 'destroy']);

    //users
    Route::get('/view-userslist', [App\Http\Controllers\Admin\UsersController::class, 'view']);
     //users delete
     Route::get('/delete-userslist/{user_id}', [App\Http\Controllers\Admin\UsersController::class, 'destroys']);
     //user status
     Route::get('/update-user-status/{user_id}', [App\Http\Controllers\Admin\UsersController::class, 'sts_update']);

     //medicine cart
     Route::get('/view-medicinecart', [App\Http\Controllers\Admin\MedicineCartController::class, 'view']);

     //pending order
     Route::get('/update-pstatus/{p_order_id}', [App\Http\Controllers\Admin\PendingOrderController::class, 'p_sts_update']);
      //pending order list  view
     Route::get('/view-pending-order', [App\Http\Controllers\Admin\PendingOrderController::class, 'view']);
    //pending order status update

    Route::get('/update-o_status/{p_order_id}', [App\Http\Controllers\Admin\PendingOrderController::class, 'o_sts_update']);
    //pending order cart status update

    Route::get('/update-cart_status/{p_order_id}', [App\Http\Controllers\Admin\PendingOrderController::class, 'cart_sts_update']);

    // Route::get('/orderdetails', [App\Http\Controllers\Admin\PendingOrderController::class, 'getOrderDetails']);
    Route::get('/order/details', [App\Http\Controllers\Admin\PendingOrderController::class, 'getOrderDetails'])->name('orderdetails');

    //  Route::get('/add-product-cart/{order_id}', [App\Http\Controllers\Admin\OrderDetailsController::class, 'add_cart']);
     Route::get('/add-product-cart', [App\Http\Controllers\Admin\OrderDetailsController::class, 'add_cart']);


     Route::post('/add-product-cart/{order_id}', [App\Http\Controllers\Admin\OrderDetailsController::class, 'store']);
     Route::post('/insert-product-cart', [App\Http\Controllers\Admin\OrderDetailsController::class, 'store']);

     Route::post('/update-product-cart', [App\Http\Controllers\Admin\OrderDetailsController::class, 'update']);

     Route::get('/Goto-pending_prescrip', [App\Http\Controllers\Admin\OrderDetailsController::class, 'pendingPrescrip']);

     //cancelled order list view
      Route::get('/view-cancalled-order', [App\Http\Controllers\Admin\CancelledOrderController::class, 'view']);
     //completed order list view
     Route::get('/view-completed-order', [App\Http\Controllers\Admin\CompletedOrderController::class, 'view']);

      //payment   list view
      Route::get('/view-payment-list', [App\Http\Controllers\Admin\PaymentListController::class, 'view']);
     //payment edit view
      Route::get('/add-payment-list/{payment_id}', [App\Http\Controllers\Admin\PaymentListController::class, 'edit_view']);

      //payment update
      Route::put('/update-payment-list/{payment_id}', [App\Http\Controllers\Admin\PaymentListController::class, 'update_payment']);


      //calender    view
      Route::get('/view-calender', [App\Http\Controllers\Admin\CalenderController::class, 'view']);

      //page setting    view
      Route::get('/view-pages-settings', [App\Http\Controllers\Admin\SettingsController::class, 'pages_view']);
       // add setting    info
       Route::get('/add-setting-info', [App\Http\Controllers\Admin\SettingsController::class, 'view']);

       //basic setting    view
      Route::get('/view-basic-settings', [App\Http\Controllers\Admin\SettingsController::class, 'basic_view']);

      //add basic setting
      Route::post('/add-basic-setting', [App\Http\Controllers\Admin\SettingsController::class, 'store_basic_view']);
         //add basic setting
      Route::post('/add-pages-setting', [App\Http\Controllers\Admin\SettingsController::class, 'store_pages_view']);


      Route::get('uploads/sample/{file}', function ($file) {
        $pathToFile = public_path('uploads/sample/' . $file);
        return response()->download($pathToFile);
    })->name('file.download');

    // Add these new routes
    Route::get('/add-user', [App\Http\Controllers\Admin\UsersController::class, 'addUser']);
    Route::post('/store-user', [App\Http\Controllers\Admin\UsersController::class, 'storeUser']);

    Route::get('/user-details/{user_id}', [App\Http\Controllers\Admin\UsersController::class, 'userDetails']);

    Route::post('/store-combo', [App\Http\Controllers\Admin\UsersController::class, 'storeCombo'])->name('admin.store-combo');

});

Route::post('/client/upload-profile-image', [App\Http\Controllers\Client\ProfileController::class, 'uploadProfileImage'])->name('client.uploadProfileImage');


Route::post('/client/mine/depositpost', [App\Http\Controllers\Client\BinanceController::class, 'postVirtualDetail'])->name('client.depositpost');
Route::post('/client/get-deposit-address', [App\Http\Controllers\Client\BinanceController::class, 'getDepositAddress'])->name('client.getDepositAddress');
Route::get('/client/check-deposit-addresss', [App\Http\Controllers\Client\BinanceController::class, 'fetchdeposit_info'])->name('client.fetchdeposit_info');

Route::get('language/{lang}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('language.switch');

Route::get('/create-admin', function() {
    DB::table('users')->insert([
        'name' => 'admin',
        'password' => Hash::make('123456'),
        'role' => 0
    ]);
    return 'Admin user created!';
});

// Withdrawal password and wallet routes
Route::get('/client/check-withdrawal-password', [WalletController::class, 'checkWithdrawalPassword'])->name('client.check-withdrawal-password');
Route::post('/client/set-withdrawal-password', [WalletController::class, 'setWithdrawalPassword'])->name('client.set-withdrawal-password');
Route::post('/client/store-wallet', [WalletController::class, 'storeWallet'])->name('client.store-wallet');
