<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Models\Item;

/*
Search next task search bar:  https://www.youtube.com/watch?v=ig8gXxFHO6s
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $itemlist = Item::orderBy('item_name','asc')->get();
    return view('dashboard',compact('itemlist'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/store-item', [AdminController::class, 'store'])->name('store.item');
    Route::post('/edit-item', [AdminController::class, 'edit'])->name('edit.item');
    Route::post('/sold-item', [AdminController::class, 'sold'])->name('submitsolditems');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sales', [AdminController::class, 'sales'])->name('sales');
    Route::get('/sales-week', [AdminController::class, 'salesweek'])->name('salesw');
    Route::get('/sales-month', [AdminController::class, 'salesmonth'])->name('salesm');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/inventory', [AdminController::class, 'inventory'])->name('inventory');
    Route::get('/search-item', [AdminController::class, 'search']);
});

require __DIR__.'/auth.php';
