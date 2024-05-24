<?php

namespace App\Http\Controllers;

use App\Mail\OpportunityAlert;
use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OpportunitiesController extends Controller
{
    /**
     * Creates a new opportunity
     *
     * @param  object  $request
     *
     * returns a redirectResponse
     */
    public function createOpp(Request $request): RedirectResponse
    {

        $data = $request->validate([
            'title' => ['required', 'string'],
            'description' => ['required'],
            'category' => ['required'],
            'photo' => ['required', 'mimes: jpeg, png, jpg'],
        ]);

        $filename = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $filename, 'public');
        $data['photo'] = config('app.url').'/storage/'.$path;

        $opp = new Opportunity;
        $opp->title = $data['title'];
        $opp->description = $data['description'];
        $opp->category = $data['category'];
        $opp->created_by = auth()->user()->name;
        $opp->photo = $data['photo'];
        $opp->save();

        return redirect()->route('pages.company')->with('success opportunity create successfully');
    }

    /**
     * publishes a new opportunity
     *
     * @param  int  $id
     *
     * returns a redirectResponse
     */
    public function publish($id): RedirectResponse
    {
        $opp = Opportunity::find($id);
        $opp->published_at = now();
        $opp->save();

        //sendign out the emails

        $individuals = User::all();

        foreach ($individuals as $individual) {
            if ($individual->category === $opp->category) {
                $mailData = [
                    'opportunity' => $opp,
                    'individual' => $individual,
                ];

                Mail::to($individual->email)->send(new OpportunityAlert($mailData));
            }
        }

        return redirect()->route('pages.company')->with('success opportunity published successfully');
    }

    /**
     * return the view to the edit opportunity form
     *
     * @param  object  $opportunity
     */
    public function edit(Opportunity $opportunity): View
    {
        return view('edit', ['opportunity' => $opportunity]);
    }

    /**
     * edits an opportunity
     *
     * @param  object  $request
     *
     * returns a redirectResponse
     */
    public function update(Request $request, Opportunity $opportunity): RedirectResponse
    {

        // Make sure logged in user is owner

        if ($opportunity->created_by != auth()->user()->name) {
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

    /**
     * deletes an opportunity
     *
     * @param  object  $opportunity
     *
     * returns a redirectResponse
     */
    public function destroy(Opportunity $opportunity): RedirectResponse
    {

        // Make sure logged in user is owner
        if ($opportunity->created_by != auth()->user()->name) {

            abort(403, 'Unauthorized Action');
        }

        $opportunity->delete();

        return redirect()->route('pages.company')->with('message', 'opportunity deleted successfully');
    }
}
