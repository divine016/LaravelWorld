<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApplicationController;
use App\Models\Opportunity;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplictionController extends Controller
{
//return apply view
        public function applyOpp($applyId)
        {
            $opp = Opportunity::find($applyId);
            
            return view('apply', ['opp' => $opp]);
        }
//actually aplying
        public function createOpp(Request $request) {

        $data = $request->all();
        $application = new Application();
        $application->title = $data['name'];
        $application->description = $data['purpose'];
        $application->category = $data['link'];
        $application->email =$data['email'];
        $application->phone = $data['phone'];
        $application->created_by = $data['created_by'];
        $application->opp_id = $data['created_by'];


        
        $application->save();

        
        return redirect()->route('company')->with('success opportunity create successfully');
}
}