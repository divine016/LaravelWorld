<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function showContactPage() {

        return view('contact');

    }

    public function showAboutPage() {
        return view('about');
    }

    public function showProfilePage() {
        return view('profile');
    }
}
