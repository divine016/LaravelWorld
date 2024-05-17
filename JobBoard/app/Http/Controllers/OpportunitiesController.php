<?php

namespace App\Http\Controllers;

use App\Mail\OpportunityAlert;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OpportunitiesController extends Controller
{
    //getting the opportunities




    public function createOpp(Request $request)
    {

        $data = $request->all();
        $filename = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $filename, 'public');
        $data['photo'] = config('app.url') . '/storage/' . $path;

        $opp = new Opportunity;
        $opp->title = $data['title'];
        $opp->description = $data['description'];
        $opp->category = $data['category'];
        $opp->created_by = auth()->user()->name;
        $opp->photo = $data['photo'];
        $opp->save();

        

        // return redirect('company');

        return redirect()->route('company')->with('success opportunity create successfully');

    }

    

    public function publish($id)
    {
        $opp = Opportunity::find($id);
        $opp->published_at = now();
        $opp->save();
        // return redirect('company');


        //sendign out the emails

        $individuals = User::all();

        foreach ($individuals as $individual){
            if($individual->category === $opp->category){
                $mailData = [
                    'opportunity' => $opp,
                    'individual' => $individual,
                ];
                // dd($individual->email);
                Mail::to($individual->email)->send(new OpportunityAlert($mailData));
                // break;
                
            }
        }

        return redirect('company');
    }



    public function edit(Opportunity $opportunity) {
        return view('edit', ['opportunity' => $opportunity]);
    }

    public function update(Request $request, Opportunity $opportunity) {
        // Make sure logged in user is owner
        if($opportunity->created_by != auth()->user()->name) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'description' => ['required'],
            'category' => 'required',
            'photo' => 'required',
        ]);


        $opportunity->update($formFields);

        dd($opportunity);

        return back()->with('message', 'opportunity updated successfully!');
    }


    public function destroy(Opportunity $opportunity) {
        // Make sure logged in user is owner
        if($opportunity->created_by != auth()->user()->name) {
            // dd(auth()->user());
            abort(403, 'Unauthorized Action');
        }
        // if($opportunity->logo && Storage::disk('public')->exists($opportunity->logo)) {
        //     Storage::disk('public')->delete($opportunity->logo);
        // }
        $opportunity->delete();
        return redirect('company')->with('message', 'opportunity deleted successfully');
    }

    //handling emailing


}
