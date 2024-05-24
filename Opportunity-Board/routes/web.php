<?php

namespace App\Http\Middleware\checkCategory;

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\OpportunitiesController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

// the home page for the company or the individual

Route::controller(PagesController::class)
    ->name('pages.')
    ->group(function () {
        Route::get('/company', 'company')->name('company');
        Route::get('/individual', 'individual')->name('individual');
        Route::get('/', 'welcome')->name('welcome');
        Route::get('/signUp', 'showSignUpPage')->name('signUp');
        Route::get('/signIn', 'showSignInPage')->name('signIn');
        Route::get('/create', 'showCreatePage')->name('create');
        Route::post('/users/authenticate', 'authenticate')->name('logIn');
        Route::post('/users', 'storeUser')->name('register');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('opportunity/{opportunity}', 'showDetails')->name('opportunityDetail');
    });

Route::controller(OpportunitiesController::class)
    ->name('opportunities.')
    ->group(function () {
        Route::post('company/{id}', 'publish')->name('publish');

        Route::post('create', 'createOpp')->name('create');

        Route::get('/edit/opportunity/{opportunity}', 'edit')->name('editOpportunity');

        Route::put('edit/{opportunity}', 'update')->name('updateOpportunity');

        Route::delete('/delete/{opportunity}', 'destroy')->name('deleteOpportunity');

    });

Route::controller(ApplicationController::class)
    ->name('applications.')
    ->group(function () {
        Route::get('apply/{applyId}', 'applyOpp')->name('apply');
        Route::post('application/{id}', 'applyForOpp')->name('applyForOpp');

    });
