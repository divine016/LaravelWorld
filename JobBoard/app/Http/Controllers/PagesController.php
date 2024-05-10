<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\User;

class PagesController extends Controller
{
    public function showSignUpPage() {
        return view('signUp');
    }

    //creating a new user
    public function storeUser(Request $request) {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', 'number'],
            'email' => ['required','email', Rule::unique('users', 'email')],
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


    //logout

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();


        return redirect('/')->with('message', 'you have logged out successfully');
    }
    public function showSignInPage() {

        return view('signIn');
    }

    //authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if(auth()->attempt($formFields)){
            

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

    public function showApplyPage() {
        return view('apply');
    }
}
