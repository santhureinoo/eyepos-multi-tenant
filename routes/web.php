<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\IntakeController;
use App\Http\Controllers\SatisfactionController;

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

Route::get('/samplereceipt', function() {
    return view('pdf.receipt');
});

Route::prefix('intake')->group(function () {
    Route::name('intake')->group(function () {
        Route::get('/', [IntakeController::class, 'index']);
        Route::get('/create', [IntakeController::class, 'create'])->name('.create');
        Route::put('/create', [IntakeController::class, 'store'])->name('.store');
    });
    Route::get('/', function () {
        return view('questionnaire.intake.show');
    });
});

Route::prefix('satisfaction')->group(function () {
    Route::name('satisfaction')->group(function () {
        Route::get('/create', [SatisfactionController::class, 'create'])->name('.create');
        Route::put('/create', [SatisfactionController::class, 'store'])->name('.store');
        Route::get('/{visit}', [SatisfactionController::class, 'show'])->name('.show')->middleware('signed');
    });
});

Route::prefix('dev')->group(function () {
    Route::get('satisfaction', function () {
        return URL::signedRoute('satisfaction.show', ['visit' => 1]);
    });
});

Route::get('/success', function () {
    return view('success');
})->name('success');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Customers
Route::prefix('customers')->group(function () {
    Route::name('customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('/create', [CustomerController::class, 'create'])->name('.create');
        Route::put('/create', [CustomerController::class, 'store'])->name('.store');
        Route::get('/edit/{customer}', [CustomerController::class, 'edit'])->name('.edit');
        Route::put('/edit/{customer}', [CustomerController::class, 'update'])->name('.update');
        Route::get('/{customer}', [CustomerController::class, 'show'])->name('.show');
        Route::get('/destroy/{customer}', [CustomerController::class, 'destroy'])->name('.destroy');
    });
});

// Inventory
Route::prefix('inventory')->group(function () {
    Route::name('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index']);
        Route::get('/create', [InventoryController::class, 'create'])->name('.create');
        Route::put('/create', [InventoryController::class, 'store'])->name('.store');
        Route::get('/edit/{item}', [InventoryController::class, 'edit'])->name('.edit');
        Route::put('/edit/{item}', [InventoryController::class, 'update'])->name('.update');
        Route::get('/{item}', [InventoryController::class, 'show'])->name('.show');
        Route::get('/destroy/{item}', [InventoryController::class, 'destroy'])->name('.destroy');
    });
});

// Orders
Route::prefix('orders')->group(function () {
    Route::name('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index']);
        Route::get('/create', [OrderController::class, 'create'])->name('.create');
        Route::put('/create', [OrderController::class, 'store'])->name('.store');
        Route::get('/edit/{order}', [OrderController::class, 'edit'])->name('.edit');
        Route::put('/edit/{order}', [OrderController::class, 'update'])->name('.update');
        Route::get('/{order}', [OrderController::class, 'show'])->name('.show');
        Route::get('/destroy/{order}', [OrderController::class, 'destroy'])->name('.destroy');
    });
});

require __DIR__ . '/auth.php';
