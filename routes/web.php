<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\Dashboard\ChatsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserlistController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Auth::routes();
// Route::get('/migrate', function () {
//     Artisan::call('migrate:rollback', ['--step' => 2]);
//     Artisan::call('db:seed', ['--class' => 'ApiSeeder']);
//     return 'ok';
// });


Route::middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::middleware(['checkStatus'])->group(function () {
        // Users Routes
        Route::get('user/create', [UserController::class, 'create']);
        Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::post('user/update/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('user/delete/{id}', [UserController::class, 'delete'])->name('delete');

        Route::get('user/account-detail', [UserController::class, 'index']);
        Route::get('user-list', [UserlistController::class, 'index'])->name('users.list');

        Route::get('chat', [ChatsController::class, 'index'])->name('chat');

        Route::get('/update-user-chat-stats', [HomeController::class, 'Count'])->name('update.user.chat.stats');

        // Edit Profile
        Route::get('profile', [UserController::class, 'EditProfile'])->name('edit.profile');
        Route::post('profile/update', [UserController::class, 'UpdateProfile'])->name('update.profile');

        // API's
        Route::get('conversation', [ChatsController::class, 'Conversation'])->name('conversation');
        Route::get('conversation/messages', [ChatsController::class, 'ConversationMessages'])->name('messages');
        Route::post('conversation/messages/send-message', [ChatsController::class, 'SendMessages'])->name('send.messages');
        Route::get('delete/conversation', [ChatsController::class, 'DeleteConversation'])->name('delete.conversation');

        // Accounts
        Route::get('accounts', [AccountController::class, 'Account'])->name('accounts');
        Route::get('accounts/create', [AccountController::class, 'CreateAccount'])->name('create.accounts');
        Route::post('accounts/store', [AccountController::class, 'StoreAccount'])->name('store.accounts');
        Route::get('accounts/edit/{id}', [AccountController::class, 'EditAccount'])->name('edit.accounts');
        Route::post('accounts/update/{id}', [AccountController::class, 'UpdateAccount'])->name('update.accounts');
        Route::delete('accounts/delete/{id}', [AccountController::class, 'DeleteAccount'])->name('delete.accounts');
        Route::get('accounts/delete/xmark', [AccountController::class, 'DeleteSingleAccount'])->name('user.delete.accounts');
        Route::post('accounts/import', [AccountController::class, 'Import'])->name('import.accounts');

        Route::get('update-registration', [AccountController::class, 'updateRegistration'])->name('registration_on');

        // Settings
        Route::get('settings', [SettingController::class, 'Setting'])->name('setting');
        Route::post('settings/store', [SettingController::class, 'StoreSetting'])->name('store.setting');

        // Payment
        Route::get('payment', [PaymentsController::class, 'index'])->name('payment');
        Route::post('upload/payment', [PaymentsController::class, 'UploadPayment'])->name('upload.payment');
        Route::get('payment/edit/{id}', [PaymentsController::class, 'EditPayment'])->name('edit.payment');
        Route::post('payment/update/{id}', [PaymentsController::class, 'UpdatePayment'])->name('update.payment');
        Route::delete('payment/delete/{id}', [PaymentsController::class, 'DeletePayment'])->name('delete.payment');
        Route::get('payment/remove', [PaymentsController::class, 'RemovePayment'])->name('remove.payment');
        Route::get('payment/chat/{id}', [PaymentsController::class, 'Chat'])->name('chat.view');
        Route::get('payment/view', [PaymentsController::class, 'PaymentView'])->name('payment.view');

        // Einnahmen
        Route::get('einnahmen', [PaymentsController::class, 'index'])->name('user.payment');
        Route::get('einnahmen/view', [PaymentsController::class, 'PaymentView'])->name('user.payment.view');
        Route::get('einnahmen/chat/{id}', [PaymentsController::class, 'Chat'])->name('user.chat.view');

        // Assign Accounts
        Route::get('assign-account', [ChatsController::class, 'AssignAccount'])->name('assign');
        Route::get('re-assign-account', [ChatsController::class, 'ReAssignAccount'])->name('re.assign');
        Route::get('reload-account', [ChatsController::class, 'ReloadAccount'])->name('reload');
        Route::get('delete-inactive-accounts', [ChatsController::class, 'DeleteInactive'])->name('delete.inactive');
    });
});

Route::get('test-imap',[ChatsController::class,'testImap']);
