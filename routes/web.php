<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\WhyusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::middleware('auth')->group(function() {
    //Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::post('/about', [AboutController::class, 'update']);

    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::post('/portfolio', [PortfolioController::class, 'update']);

    Route::get('/whyus', [WhyusController::class, 'index'])->name('whyus.index');
    Route::post('/whyus', [WhyusController::class, 'update']);

    Route::get('/contactus', [ContactUsController::class, 'index'])->name('contactus.index');
    Route::post('/contactus', [ContactUsController::class, 'update']);

    Route::get('/footer', [FooterController::class, 'index'])->name('footer.index');
    Route::post('/footer', [FooterController::class, 'update']);

    Route::get('/document', [DocumentController::class, 'index'])->name('document.index');
    Route::get('/document-add', [DocumentController::class, 'add'])->name('document.add');
    Route::get('/document-edit/{id}', [DocumentController::class, 'edit'])->name('document.edit');
    Route::get('/document-delete/{id}', [DocumentController::class, 'delete'])->name('document.delete');
    Route::post('document-upload', [DocumentController::class, 'upload'])->name('document.upload');
    Route::post('document-update', [DocumentController::class, 'update'])->name('document.update');

    Route::get('/subscribers', [SubscribeController::class, 'showSubs'])->name('subscribers.show');
    Route::get('/unsubscribes', [SubscribeController::class, 'showUnSubs'])->name('unsubscribes.show');
    Route::get('/complete/{id}', [SubscribeController::class, 'complete'])->name('complete');
});

//Emails (Contact-Us)
Route::post('/send-mail', [ContactController::class,'sendEmail'])->name('send.email');

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');

Route::get('change-password', [ChangePasswordController::class, 'index'])->name('changepassword');
Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');

//Subscribe To Newsletter
Route::get('/direct-pay-return_url', [SubscribeController::class, 'return_urlPayment'])->name('subscribe.return_url');
Route::get('/subscribe', [SubscribeController::class,'index'])->name('newsletter.subscribe');
Route::get('/unsubscribe', [SubscribeController::class,'unsubscribe'])->name('newsletter.unsubscribe');
Route::get('/dp-get-status', [SubscribeController::class,'status'])->name('subscribe.status');
Route::post('/order-cancel', [SubscribeController::class,'orderCancel'])->name('order.cancel');

//For Testing
// Route::get('/test', [WelcomeController::class, 'test'])->name('test');
