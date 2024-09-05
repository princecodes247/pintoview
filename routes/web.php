<?php

use App\Http\Controllers\BannerAdController;
use App\Http\Controllers\ButtonAdController;
use App\Http\Controllers\EmbedCodeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pricing', [SubscriptionController::class, 'pricing'])->name('pricing.index');

Route::get('/banner/{id}', [BannerAdController::class, 'redirectToLink'])->name('banner-ads.redirect');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
  
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/settings', [UserController::class, 'settings'])->name('posts.settings');
    Route::post('posts/settings', [UserController::class, 'updateSettings'])->name('posts.settings.update');
    // Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('posts/{id}/update', [PostController::class, 'update'])->name('posts.update');
    Route::put('posts/{id}/update', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
 
    Route::post('/profile',  [UserController::class, 'update'])->name('profile.update');

    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.index');
    Route::post('/pay', [SubscriptionController::class, 'redirectToGateway'])->name('subscriptions.pay');
    Route::get('/payment/callback', [SubscriptionController::class, 'handleGatewayCallback'])->name('payment.callback');
    Route::post('/subscriptions', [SubscriptionController::class, 'startPremium'])->name('subscriptions.store');
    Route::post('/subscriptions/start-trial', [SubscriptionController::class, 'startTrial'])->name('subscriptions.start-trial');
    Route::post('/subscriptions/{subscription}/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');


    Route::middleware([
        'check.subscription'

    ])->group(function () {
        Route::get('/embeds', [EmbedCodeController::class, 'index'])->name('embeds.index');
        Route::get('/embeds/api-tokens', [EmbedCodeController::class, 'api'])->name('embeds.api-tokens');
        Route::post('/embeds', [EmbedCodeController::class, 'store'])->name('embeds.store');
        Route::put('/embeds/{id}/update', [EmbedCodeController::class, 'update'])->name('embed.update');
        Route::delete('/embeds/{id}/destroy', [EmbedCodeController::class, 'destroy'])->name('embed.destroy');
        Route::get('/banner-ads', [BannerAdController::class, 'index'])->name('banner-ads.index');
        Route::post('/banner-ads', [BannerAdController::class, 'store'])->name('banner-ads.store');
        Route::put('/banner-ads/{id}/update', [BannerAdController::class, 'update'])->name('banner-ads.update');
        Route::delete('/banner-ads/{id}/destroy', [BannerAdController::class, 'destroy'])->name('banner-ads.destroy');
        Route::get('/button-ads', [ButtonAdController::class, 'index'])->name('button-ads.index');
        Route::post('/button-ads', [ButtonAdController::class, 'store'])->name('button-ads.store');
        Route::post('/button-ads/{id}/pause', [ButtonAdController::class, 'pause'])->name('button-ads.pause');
        Route::put('/button-ads/{id}/update', [ButtonAdController::class, 'update'])->name('button-ads.update');
        Route::delete('/button-ads/{id}/destroy', [ButtonAdController::class, 'destroy'])->name('button-ads.destroy');

        Route::post('templates/store', [TemplateController::class, 'store'])->name('templates.store');
        Route::delete('templates/{template}', [TemplateController::class, 'destroy'])->name('templates.destroy');
    });
});

Route::middleware([
    'check.subscription.public'

])->group(function () {
    Route::get('/{user_slug}',  [UserController::class, 'profile'])->name('user.profile_public');
});

    Route::get('/{user_slug}/{short_link}', [PostController::class, 'showPublic'])->name('posts.show_public');
    Route::post('{user_slug}/{short_link}/password', [PostController::class, 'checkPassword'])->name('posts.check_password');
