<?php


use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PagesController;
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

// require_once __DIR__ . './dem_routes.php';

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('public_home');;

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/individuelle', [PagesController::class, 'individuelle'])->name('individuelle');

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// });

Route::get('/dem-administrative', [PagesController::class, 'adm'])->name('dem-administrative');
Route::get('/dem-demenagement', [PagesController::class, 'dem'])->name('dem-demenagement');
Route::get('/dem-market', [PagesController::class, 'market'])->name('dem-market');
Route::get('/test', [PagesController::class, 'test']);

// Route::inertia('/dem-administrative', 'Adm')->name('dem-administrative');;
// Route::inertia('/dem-demenagement', 'Demenagement')->name('dem-demenagement');;
// Route::inertia('/dem-market', 'Market')->name('dem-market');;


//Route::resource('contact', App\Http\Controllers\ContactController::class)->only('index', 'store');





Route::middleware(['auth:sanctum'])->get('/dem-administrative', [PagesController::class, 'adm'])->name('dem-administrative');
Route::middleware(['auth:sanctum'])->get('/dem-demenagement', [PagesController::class, 'dem'])->name('dem-demenagement');
Route::middleware(['auth:sanctum'])->get('/dem-market', [PagesController::class, 'market'])->name('dem-market');


Route::get('/administrative', [PagesController::class, 'administrative'])->name('administrative');
Route::get('/demenagement', [PagesController::class, 'demenagement'])->name('demenagement');
Route::get('/marketplace', [PagesController::class, 'marketplace'])->name('marketplace');





