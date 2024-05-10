<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
// intro routes
Route::get('/', function () {
    return view('welcome');
});

//contact us routes

Route::get('contact-us', [PagesController::class, 'showContactPage'])->name('contact');
Route::get('about-us', [Pagescontroller::class, 'showAboutPage'])->name('about');
Route::get('profile', [Pagescontroller::class, 'showProfilePage'])->name('profile');

//student resourcebundle_get_error_code

Route::get('students', [StudentController::class, 'index'])->name('students');
Route::get('students/new', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('students/{id}', [StudentController::class, "show"])->name('studentsDetails');