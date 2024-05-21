<?php

namespace App\Http\Controllers;


use App\Models\Opportunity;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationAlert;




class ApplicationController extends Controller
{
//return apply view
        public function applyOpp($applyId)
        {
            $opp = Opportunity::find($applyId);
            
            return view('apply', ['opp' => $opp]);
        }
//actually aplying
        public function applyForOpp(Request $request, $id) {

        
        $data = $request->all();
        $application = new Application();
        $application->name = $data['name'];
        $application->purpose = $data['purpose'];
        $application->link = $data['link'];
        $application->email =$data['email'];
        $application->phone = $data['phone'];
        $application->opportunity_id = $id;
        
        $opportunity = Opportunity::find($id);
        $application->creator_id = $opportunity->created_by;
       

        
        $application->save();

        $companies = User::all();

        foreach ($companies as $company){
            if($company->name === $application->creator_id){
                $mailData = [
                    'opportunity' => $application,
                    'individual' => $company,
                ];

                Mail::to($company->email)->send(new ApplicationAlert($mailData));
                
            }
        }

        
        return redirect()->route(auth()->user()?'individual':'welcome')->with('Applied for opportunity  successfully');
}
}

