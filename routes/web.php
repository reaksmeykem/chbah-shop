<?php

use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AnalyticsController;
use App\Livewire\Admin\Analytics;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Keys;
use App\Livewire\Admin\Orders;
use App\Livewire\Admin\ProductForm;
use App\Livewire\Admin\Products;
use App\Livewire\Home;
use App\Livewire\InfoPage;
use App\Livewire\LicenseCheck;
use App\Livewire\ProductCatalog;
use App\Livewire\ProductDetail;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/shop', ProductCatalog::class)->name('shop');
Route::get('/product/{slug}', ProductDetail::class)->name('product.show');
Route::get('/license', LicenseCheck::class)->name('license');
Route::get('/about', fn () => Livewire\Livewire::mount(InfoPage::class, ['page' => 'about']))->name('about');
Route::get('/terms', fn () => Livewire\Livewire::mount(InfoPage::class, ['page' => 'terms']))->name('terms');
Route::get('/privacy', fn () => Livewire\Livewire::mount(InfoPage::class, ['page' => 'privacy']))->name('privacy');

Route::get('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, SetLocale::SUPPORTED, true), 400);

    session(['locale' => $locale]);

    return redirect()->back();
})->name('locale.set');

Route::post('/analytics/track', [AnalyticsController::class, 'track'])
    ->middleware('throttle:120,1')
    ->name('analytics.track');

// ------------------------------ admin dashboard ------------------------------

Route::get('/admin/login', [AdminLoginController::class, 'show'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'store'])->name('admin.login.attempt');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/analytics', Analytics::class)->name('analytics');
    Route::get('/products', Products::class)->name('products');
    Route::get('/products/create', ProductForm::class)->name('products.create');
    Route::get('/products/{product}/edit', ProductForm::class)->name('products.edit');
    Route::get('/keys', Keys::class)->name('keys');
    Route::get('/orders', Orders::class)->name('orders');
});
