<?php

use App\Http\Controllers\CigarsController;
use App\Http\Controllers\ProfileController;
use App\Models\Cigar;
use App\Models\UserCigar;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'cigars' => Cigar::all(),
    ]);
});

Route::get('/dashboard', function (Request $request) {
    return Inertia::render('Dashboard', [
        'cigars' => UserCigar::all(),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:sanctum')->get('/my/cigars', function (Request $request) {
    return $request->user()->cigar;
});

Route::get('cigar/create', function () {
    return Inertia::render('Cigar/Create');
})->name('cigars.index');

Route::post('cigar', [CigarsController::class, 'store'])->name('cigars.index');

require __DIR__.'/auth.php';
