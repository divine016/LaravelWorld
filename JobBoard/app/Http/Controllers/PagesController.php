<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Opportunity;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function welcome()
    {
        // $opportunities = [];
        // $opportunities = Opportunity::all();

        $opportunities = Opportunity::whereNotNull('published_at')->get();

        // dd($opportunities);
        return view('welcome', compact('opportunities'));
    }

    //signup page
    public function showSignUpPage()
    {
        return view('signUp');
    }

    //sign in page
    public function showSignInPage()
    {
        return view('signIn');
    }

    //create page
    public function showCreatePage()
    {
        return view('create');
    }

    //show oppportunity details
    public function showDetails(Opportunity $opportunity)
    {
        return view('details', ['opportunity' => $opportunity]);
    }
    

   public function viewApplicant(Application $applicant){
    return view('viewApplicant', ['id' => $applicant]);
   }

    //edit the opportunity

    // public function editOpps(Opportunity $opportunity)
    // {
    //     return view('edit', ['opportunity' => $opportunity]);
    // }



    //creating a new user
    public function storeUser(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
            'user_type' => ['required'],
        ]);

        //hash password


        $formFields['password'] = bcrypt($formFields['password']);

        //create user
        if ($request->user_type === 'company') {
            $user = User::create($formFields);

            //login user
            auth()->login($user);

            //redirect to a specific dashbord user
            return redirect('company')->with('welcome to your company dashboard');
        } else {
            $formFields['category'] = $request->category;
            $user = User::create($formFields);

            //login user
            auth()->login($user);

            //redirect to a specific dashbord user
            return redirect('individual')->with('welcome to your individual dashboard');
        }
        // $user = User::create($formFields);




        return 'we could not log you in. veryfy credentials and try again';
    }

    //authenticate user (login)
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($formFields)) {


            $user = auth()->user();

            if ($user->user_type === 'company') {
                $request->session()->regenerate();
                return redirect('company')->with('welcome to your company dashboard');
            } else {
                $request->session()->regenerate();
                return redirect('individual')->with('welcome to your individual dashboard');
            }
        }

        return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
    }

    //logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();


        return redirect('/')->with('message', 'you have logged out successfully');
    }

    public function company()
    {
        $user = Auth::user();
        if ($user) {
            $currentUser = $user->name;

            $opportunities = Opportunity::where('created_by', $currentUser)->whereNull('Published_at')->get();
            return view('Home.company', [
                'opportunities' => $opportunities,
            ]);
        } else {
            // The user is not logged in, handle the case accordingly (e.g., redirect to login)
            return redirect('signIn');
        }
    }

    public function individual()
    {
        $user = Auth::user();
        if($user){
            $currentUserCategory = $user->category;
        $opportunities = Opportunity::where('category', $currentUserCategory)->whereNotNull('published_at')->get();
        return view('Home.individual', compact('opportunities'));
        } else{
            return redirect('signIn');
        }
        
        
    }
}
