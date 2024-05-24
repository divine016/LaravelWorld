<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationAlert;
use App\Models\Application;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ApplicationController extends Controller
{
    /**
     * show the page to apply for a particular opportunity
     *
     * @param  int  $applyId
     *
     * returns a view
     */
    public function applyOpp($applyId): View
    {
        $opp = Opportunity::find($applyId);

        return view('apply', ['opp' => $opp]);
    }

    /**
     * applying an opportunity
     *
     * @param  int  $id
     * @param  object  $request
     *
     * returns a redirectResponse
     */
    public function applyForOpp(Request $request, $id): RedirectResponse
    {

        $data = $request->validate([
            'name' => ['required', 'string'],
            'purpose' => ['required'],
            'link' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'size:9'],

        ]);

        $application = new Application();
        $application->name = $data['name'];
        $application->purpose = $data['purpose'];
        $application->link = $data['link'];
        $application->email = $data['email'];
        $application->phone = $data['phone'];
        $application->opportunity_id = $id;

        $opportunity = Opportunity::find($id);
        $application->creator_id = $opportunity->created_by;

        $application->save();

        $companies = User::all();

        foreach ($companies as $company) {
            if ($company->name === $application->creator_id) {
                $mailData = [
                    'opportunity' => $application,
                    'individual' => $company,
                ];

                Mail::to($company->email)->send(new ApplicationAlert($mailData));

            }
        }

        return redirect()->route(auth()->user() ? 'pages.individual' : 'pages.welcome')->with('Applied for opportunity  successfully');
    }
}
