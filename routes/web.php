<?php

use App\Http\Controllers\CigarsController;
use App\Http\Controllers\ProfileController;
use App\Models\Cigar;
use App\Models\CigarBrand;
use App\Models\UserCigar;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
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
    ]);
});

Route::get('/dashboard', function (Request $request) {
    return Inertia::render('Dashboard', [
        'cigars' => UserCigar::with(['cigar.brand.manufacturer'])->get(),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/my/cigars', function (Request $request) {
        return UserCigar::with(['cigar.brand.manufacturer'])->get();
    });
    Route::get('/cigars/rate', function (Request $request) {
        return Inertia::render('UserCigar/Create', [
            'cigars' => Cigar::with('brand.manufacturer')->get(),
        ]);
    })->name('cigar.rate');

    Route::post('cigar', [CigarsController::class, 'store'])->name('cigars.index');

    Route::get('/cigar/create', function () {
        return Inertia::render('Cigar/Create');
    })->name('cigar.create');

    Route::get('/brand/create', function () {
        return Inertia::render('Brand/Create');
    })->name('brand.create');

    Route::get('/brands/', function () {
        return CigarBrand::with('manufacturer')->get();
    })->name('brands.json.all');

    Route::get('cigar-options', function(){
        $flavorProfiles = get_enum_options('cigars', 'flavor_profile');
        $wrappers = get_enum_options('cigars', 'wrapper');

        return [
            'flavor_profiles' => $flavorProfiles,
            'wrappers' => $wrappers,
        ];
    });

});

function get_enum_options($table, $field){
    $column = DB::select("SHOW COLUMNS FROM `" . $table ."` WHERE Field = '". $field ."'")[0]->Type;
    $enumValues = substr($column, 6, -2); // Extract the enum values from the type string
    // dump($column, $enumValues);

    return explode("','", $enumValues);
}