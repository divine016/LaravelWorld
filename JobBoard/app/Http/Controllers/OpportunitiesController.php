<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;

class OpportunitiesController extends Controller
{
    //getting the opportunities

    public function welcome() {
        // $opportunities = [];
        $opportunities = Opportunity::all();
        // dd($opportunities);
        return view('welcome', compact('opportunities'));
    }
}
