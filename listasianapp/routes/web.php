<?php

use App\Http\Controllers\Api\AdvertController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SiteController;
use App\Http\Controllers\Api\GeoController;
use App\Http\Controllers\Api\PackagePriceController;
use App\Http\Controllers\Api\PaylogController;
use App\Http\Controllers\Api\UserController;


Route::get('/', function () {
    return view('welcome');
});

// //Advert Route
// Route::middleware('guest')->group(function () {
//     Route::get('/advert/display/{id}', [AdvertController::class, 'display'])->name('advert.display');
// });
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/advert', [AdvertController::class, 'index'])->name('advert.index');
//     Route::get('/advert/create', [AdvertController::class, 'create'])->name('advert.create');
//     Route::post('/advert/store', [AdvertController::class, 'create'])->name('advert.store');
//     Route::get('/advert/{id}', [AdvertController::class, 'view'])->name('advert.view');
//     Route::post('/advert/{id}', [AdvertController::class, 'view'])->name('advert.purchase');
//     Route::get('/advert/{id}/edit', [AdvertController::class, 'edit'])->name('advert.edit');
//     Route::put('/advert/{id}', [AdvertController::class, 'update'])->name('advert.update');
//     Route::delete('/advert/{id}', [AdvertController::class, 'delete'])->name('advert.delete');
//     Route::get('/advert/admin', [AdvertController::class, 'admin'])->name('advert.admin');
//     Route::get('/advert/thanks', [AdvertController::class, 'thanks'])->name('advert.thanks');
//     Route::post('/advert/pay-tracking', [AdvertController::class, 'payTracking'])->name('advert.payTracking');
// });

// //Category Route
// Route::post('/category/list', [CategoryController::class, 'list'])->middleware('ajaxOnly')->name('category.list');
// Route::middleware(['auth', 'can:isAdmin'])->group(function () {
//     Route::get('/category/create-form', [CategoryController::class, 'createForm'])->name('category.createForm');
//     Route::post('/category/create', [CategoryController::class, 'create'])->name('category.create');
//     Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit'); 
//     Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
//     Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
//     Route::get('/category/admin', [CategoryController::class, 'admin'])->name('category.admin');
// });
// Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
// Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
// Route::get('/category/{code}/paid-adverts', [CategoryController::class, 'paidAdverts'])->name('category.paidAdverts');

// //Geo Route
// Route::get('/geo-form', function () {return view('geo-form');})->name('geo.form');
// Route::post('/geo-form', [GeoController::class, 'handleGeoForm'])->name('geo.form.submit');
// Route::middleware(['postOnly'])->group(function () {
//     Route::post('/geo/countries', [GeoController::class, 'countries'])->name('geo.countries');
//     Route::post('/geo/regions', [GeoController::class, 'regions'])->name('geo.regions');
//     Route::post('/geo/cities', [GeoController::class, 'cities'])->name('geo.cities');
// });

// //PackagePrice Price
// Route::middleware(['auth', 'can:admin-role'])->group(function () {
//     Route::get('/package-prices', [PackagePriceController::class, 'index'])->name('package_prices.index');
//     Route::get('/package-prices/create', [PackagePriceController::class, 'create'])->name('package_prices.create');
//     Route::post('/package-prices', [PackagePriceController::class, 'store'])->name('package_prices.store');
//     Route::get('/package-prices/{id}', [PackagePriceController::class, 'show'])->name('package_prices.show');
//     Route::get('/package-prices/{id}/edit', [PackagePriceController::class, 'edit'])->name('package_prices.edit');
//     Route::put('/package-prices/{id}', [PackagePriceController::class, 'update'])->name('package_prices.update');
//     Route::delete('/package-prices/{id}', [PackagePriceController::class, 'destroy'])->name('package_prices.destroy');
//     Route::get('/package-prices/admin', [PackagePriceController::class, 'admin'])->name('package_prices.admin');
// });

// //Paylog Route
// Route::middleware(['auth', 'can:user-role'])->group(function () {
//     Route::get('/paylogs', [PaylogController::class, 'index'])->name('paylogs.index');
// });
// Route::middleware(['auth', 'can:admin-role'])->group(function () {
//     Route::get('/paylogs/create', [PaylogController::class, 'create'])->name('paylogs.create');
//     Route::post('/paylogs', [PaylogController::class, 'store'])->name('paylogs.store');
//     Route::get('/paylogs/{id}', [PaylogController::class, 'show'])->name('paylogs.show');
//     Route::get('/paylogs/admin', [PaylogController::class, 'admin'])->name('paylogs.admin');
//     Route::get('/paylogs/{id}/edit', [PaylogController::class, 'edit'])->name('paylogs.edit');
//     Route::put('/paylogs/{id}', [PaylogController::class, 'update'])->name('paylogs.update');
//     Route::delete('/paylogs/{id}', [PaylogController::class, 'destroy'])->name('paylogs.destroy');
// });

// //Plan Route
// Route::middleware(['auth', 'can:admin'])->group(function () {
//     Route::get('/plans/admin', [PlanController::class, 'admin'])->name('plans.admin');
//     Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
//     Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
//     Route::get('/plans/edit', [PlanController::class, 'edit'])->name('plans.edit');
//     Route::put('/plans/{id}', [PlanController::class, 'update'])->name('plans.update');
//     Route::delete('/plans/{id}', [PlanController::class, 'destroy'])->name('plans.destroy');
// });

// //Price Route
// Route::middleware(['auth', 'can:view,App\Models\Price'])->group(function () {
//     Route::get('/prices', [PriceController::class, 'index'])->name('prices.index');
// });
// Route::middleware(['auth', 'can:admin'])->group(function () {
//     Route::post('/prices/update', [PriceController::class, 'update'])->name('prices.update');
// });

// //Site Route
// Route::middleware('guest')->group(function () {
//     Route::get('/login', [SiteController::class, 'showLoginForm'])->name('login.form');
//     Route::post('/login', [SiteController::class, 'login'])->name('login');
//     Route::get('/register', [SiteController::class, 'showRegisterForm'])->name('register.form');
//     Route::post('/register', [SiteController::class, 'register'])->name('register');
// });
// Route::middleware('auth')->group(function () {
//     Route::post('/hook', [SiteController::class, 'hook'])->name('stripe.hook');
//     Route::get('/restore-password', [SiteController::class, 'showRestorePasswordForm'])->name('password.restore.form');
//     Route::post('/restore-password', [SiteController::class, 'restorePassword'])->name('password.restore');
//     Route::post('/logout', [SiteController::class, 'logout'])->name('logout');
// });
// Route::get('/contact', [SiteController::class, 'showContactForm'])->name('contact.form');
// Route::post('/contact', [SiteController::class, 'contact'])->name('contact');
// Route::get('/error', [SiteController::class, 'error'])->name('error');
// Route::get('/', [SiteController::class, 'index'])->name('home');

// //User Route
// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/user/show/{id}', [UserController::class, 'show'])->name('user.show');
//     Route::get('/user/{id}/view', [UserController::class, 'view'])->name('user.view');
//     Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
//     Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
//     Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
//     Route::middleware('can:admin')->group(function () {
//         Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
//         Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
//         Route::get('/user/admin', [UserController::class, 'admin'])->name('user.admin');
//         Route::delete('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
//         Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
//     });
// });

// //Social Login Route
// Route::get('auth/google', [SocialLoginController::class, 'redirectToGoogle'])->name('auth.google');
// Route::get('auth/google/callback', [SocialLoginController::class, 'handleGoogleCallback']);