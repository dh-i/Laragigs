<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\List_;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/posts/{id}', function ($id) {
    //dd($id) -> stop and log $id, similarly we have ddd.
    return response('Post id is : ' . $id);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    return response($request->name . ' is from ' . $request->city);
});

Route::get('/listings', [ListingController::class, 'index']);

// We can handle this with eloquent with route model binding as below
// Route::get('/listings/{id}', function ($id) {
//     return view('listing', [
//         'listing' => Listing::find($id)
//     ]);
// });

Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');
Route::delete('/listings/{id}', [ListingController::class, 'destroy'])->middleware('auth');
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');
//the wildcard route should come later
Route::get('/listings/{id}', [ListingController::class, 'show']);


//users

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users', [UserController::class, 'store'])->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
