<?php

use App\Http\Controllers\CigarsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCigarController;
use App\Models\Cigar;
use App\Models\CigarBrand;
use App\Models\FlavorProfile;
use App\Models\UserCigar;
use App\Models\Wrapper;
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
        'cigars' => UserCigar::with(['cigar.brand.manufacturer', 'images'])->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/my/cigars', function (Request $request) {
        $subquery = UserCigar::select('cigar_id', DB::raw('avg(rating) as average_rating'), DB::raw('count(*) as total'))
            ->groupBy('cigar_id');

        $query = UserCigar::joinSub($subquery, 'sub', function ($join) {
            $join->on('user_cigar.cigar_id', '=', 'sub.cigar_id');
        })
            ->join('user_cigar_images', 'user_cigar_images.user_cigar_id', '=', 'user_cigar.id')
            ->join('cigars', 'cigars.id', '=', 'user_cigar.cigar_id')
            ->join('cigar_brands', 'cigar_brands.id', '=', 'cigars.cigar_brand_id')
            ->join('cigar_manufacturers', 'cigar_manufacturers.id', '=', 'cigar_brands.cigar_manufacturer_id')
            ->select('cigars.name as cigar_name', 'user_cigar.*', 'sub.average_rating', 'sub.total', 'cigar_manufacturers.name as manufacturer_name', 'cigar_brands.name as brand_name', 'user_cigar_images.*')
            ->groupBy('cigar_id')
            ->orderBy('user_cigar.created_at', 'desc');

        return $query->get();
    });
    Route::get('/cigars/rate', function (Request $request) {
        // pass cigars back with brand and manufacturer, and flavor profiles
        return Inertia::render('UserCigar/Create', [
            'cigars' => Cigar::with(['brand.manufacturer', 'flavorProfile'])->get()
        ]);
    })->name('cigar.rate');

    Route::post('cigar/rate', [UserCigarController::class, 'store'])->name('cigar.rate.store');

    Route::get('/cigar/create', function () {
        return Inertia::render('Cigar/Create');
    })->name('cigar.create');

    Route::get('/brand/create', function () {
        return Inertia::render('Brand/Create');
    })->name('brand.create');

    Route::get('/brands/', function () {
        return CigarBrand::with('manufacturer')->get();
    })->name('brands.json.all');

    Route::get('/cigars/', function () {
        return Cigar::with(['brand.manufacturer', 'flavorProfile'])->get();
    })->name('cigars.json.all');

    Route::post('/cigar/', [CigarsController::class, 'store'])->name('cigar.store');

    Route::get('/wrappers/', function () {
        return Wrapper::orderby('name', 'ASC')->get();
    })->name('wrappers.json.all');

    Route::get('cigar-options', function () {
        $flavorProfiles = FlavorProfile::orderBy('name', 'ASC')->get(['id', 'name']);
        $wrappers = Wrapper::orderBy('name', 'ASC')->get(['id', 'name']);

        return [
            'flavor_profiles' => $flavorProfiles,
            'wrappers' => $wrappers,
        ];
    });

    Route::get('imagekit-token', function () {
        /** @var ImageKit\ImageKit $imagekit */
        $imagekit = app('imagekit');
        $token = $imagekit->getAuthenticationParameters();

        return $token;
    });
});

function get_enum_options($table, $field)
{
    $column = DB::select("SHOW COLUMNS FROM `" . $table . "` WHERE Field = '" . $field . "'")[0]->Type;
    $enumValues = substr($column, 6, -2); // Extract the enum values from the type string
    // dump($column, $enumValues);

    return explode("','", $enumValues);
}
