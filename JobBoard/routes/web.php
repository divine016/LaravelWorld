<?php
namespace App\Http\Middleware\checkCategory;

use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\PagesController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;



//landing page route
// Route::get('/', function () {
//     return view('welcome');
// });

// the hhome page for the company or the individual
Route::get('company', function () {
    return view('Home.company');
});
// ->middleware('CheckCategory:company');
Route::get('individual', function () {
    return view('Home.individual');
});
// ->middleware('CheckCategory:individual');

Route::get('/', [OpportunitiesController::class, 'welcome'])->name('welcome');


//signin/ signup route

Route::get('signUp', [PagesController::class, 'showSignUpPage'])->name('signUp');

Route::get('signIn', [PagesController::class, 'showSignInPage'])->name('signIn');
Route::post('/users/authenticate', [PagesController::class, 'authenticate']);

Route::get('apply', [PagesController::class, 'showApplyPage'])->name('apply');

//creating a new user
Route::post('/users', [PagesController::class, 'storeUser']);

//loginh out a user

Route::post('/logout', [PagesController::class, 'logout']);
