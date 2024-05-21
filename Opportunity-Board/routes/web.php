<?php
namespace App\Http\Middleware\checkCategory;

use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\PagesController;
USE App\Http\Controllers\ApplicationController;
use App\Models\Opportunity;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;



//landing page route
// Route::get('/', function () {
//     return view('welcome');
// });

// the hhome page for the company or the individual
Route::get('company', [PagesController::class, 'company'])->name('company') ;
Route::post('company/{id}', [OpportunitiesController::class, 'publish'])->name('publish') ;
    
// ->middleware('CheckCategory:company');
Route::get('individual', [PagesController::class, 'individual'])->name('individual') ;

// 
// ->middleware('CheckCategory:individual');

Route::get('/', [PagesController::class, 'welcome'])->name('welcome');


//signin/ signup route

Route::get('signUp', [PagesController::class, 'showSignUpPage'])->name('signUp');

Route::get('signIn', [PagesController::class, 'showSignInPage'])->name('signIn');
Route::post('/users/authenticate', [PagesController::class, 'authenticate']);

Route::get('create', [PagesController::class, 'showCreatePage'])->name('create');

//creating a new user
Route::post('/users', [PagesController::class, 'storeUser']);

//creating a new user
Route::post('create', [OpportunitiesController::class, 'createOpp']);

//loginh out a user

Route::post('/logout', [PagesController::class, 'logout']);

//show details about an oppp
Route::get('opportunity/{opportunity}', [PagesController::class, 'showDetails'])->name('opportunityDetail');


// //edit opp
Route::get('/opportunity/{opportunity}/edit', [OpportunitiesController::class, 'edit'])->name('editOpportunity');
Route::put('edit/{opportunity}', [OpportunitiesController::class, 'update']);

//delet

Route::delete('/delete/{opportunity}', [OpportunitiesController::class, 'destroy']);



Route::get('apply/{applyId}', [ApplicationController::class, 'applyOpp'])->name('apply');

// Route::post('application', [ApplicationController::class, 'applyForOpp']);


//this is to handle applications
Route::post('/application/{id}', [ApplicationController::class, 'applyForOpp'])->name('applyForOpp');

// Route::get('Opportunity', [PagesController::class, 'showDetails'])->name('opportunityDetail');

// Route::get('view/{id}', [PagesController::class, 'viewApplicant'])->name('view');
