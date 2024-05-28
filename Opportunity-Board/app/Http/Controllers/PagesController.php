<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class PagesController extends Controller
{
    /**
     * Selects all opportunities that are published
     * Returns a view of the welcome page
     */
    public function welcome(): View
    {
        $opportunities = Opportunity::whereNotNull('published_at')->get();

        return view('welcome', compact('opportunities'));
    }

    /**
     * returns the sign up form
     */
    public function showSignUpPage(): View
    {
        return view('signUp');
    }

    /**
     * returns the sign in form
     */
    public function showSignInPage(): View
    {
        return view('signIn');
    }

    /**
     * returns the form to create a new opportunity by the company
     */
    public function showCreatePage(): View
    {
        return view('create');
    }

    /**
     * show details of an opportunity
     *
     * @param  object  $opportunity
     */
    public function showDetails(Opportunity $opportunity): View
    {
        return view('details', ['opportunity' => $opportunity]);
    }

    /**
     * Stores a new user information and logs the user in
     *
     * @param  object  $request
     *
     * returns a redirectResponse
     */
    public function storeUser(Request $request): RedirectResponse
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
            try {
                $user = User::create($formFields);

                //login user
                auth()->login($user);

                //redirect to a specific dashbord user
                return redirect()->route('pages.company')->with('welcome to your company dashboard');
            } catch (Throwable $e) {
                report($e);

                return redirect()->back()->with('error', 'user creation failed');
            }

        } else {
            try {
                $formFields['category'] = $request->category;
                $user = User::create($formFields);

                //login user
                auth()->login($user);

                //redirect to a specific dashbord user
                return redirect()->route('pages.individual')->with('welcome to your individual dashboard');
            } catch (Throwable $e) {
                report($e);

                return redirect()->back()->with('error', 'user creation failed');
            }

        }

        return 'we could not log you in. veryfy credentials and try again';
    }

    /**
     * Logging in an existing user to the webApp
     *
     * @param  object  $request
     *
     * returns a redirectResponse
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($formFields)) {

            $user = auth()->user();

            if ($user->user_type === 'company') {
                $request->session()->regenerate();

                return redirect()->route('pages.company')->with('welcome to your company dashboard');
            } else {
                $request->session()->regenerate();

                return redirect()->route('pages.individual')->with('welcome to your individual dashboard');
            }
        }

        return back()->withErrors(['email' => 'invalid Credentials'])->onlyInput('email');
    }

    /**
     * Logging out an existing user to the webApp
     *
     * @param  object  $request
     *
     * returns a redirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect()->route('pages.welcome')->with('message', 'you have logged out successfully');
    }

    /**
     * Takes an user to the company page if they are signed in
     *
     * returns a redirectResponse
     */
    public function company(): View|RedirectResponse
    {
        $user = auth()->user();
        if ($user) {
            $currentUser = $user->name;

            $opportunities = Opportunity::where('created_by', $currentUser)->whereNull('Published_at')->get();

            return view('Home.company', [
                'opportunities' => $opportunities,
            ]);
        } else {
            // The user is not logged in, handle the case accordingly (e.g., redirect to login)
            return redirect()->route('pages.signIn');
        }
    }

    /**
     * Takes an user to the individual page if they are signed in
     *
     * returns a redirectResponse
     */
    public function individual(): RedirectResponse|View
    {
        $user = auth()->user();
        if ($user) {
            $currentUserCategory = $user->category;
            $opportunities = Opportunity::where('category', $currentUserCategory)->whereNotNull('published_at')->get();

            return view('Home.individual', compact('opportunities'));
        } else {
            return redirect()->route('pages.signIn');
        }
    }
}
