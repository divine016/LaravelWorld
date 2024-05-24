<?php

namespace App\Http\Middleware\checkCategory;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\PagesController;
use App\Models\Opportunity;
use Illuminate\Support\Facades\Route;


// the home page for the company or the individual

Route::controller (PagesController::class)
        ->name('pages.')
        ->group(function () {
            Route::get('company', 'company')->name('company');
            Route::get('individual', 'individual')->name('individual');
            Route::get('/', 'welcome')->name('welcome');
            Route::get('signUp', 'showSignUpPage')->name('signUp');
            Route::get('signIn', 'showSignInPage')->name('signIn');
            Route::get('create', 'showCreatePage')->name('create');
        });

// Route::get('company', [PagesController::class, 'company'])->name('company');
Route::post('company/{id}', [OpportunitiesController::class, 'publish'])->name('publish');


Route::post('/users/authenticate', [PagesController::class, 'authenticate']);


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
