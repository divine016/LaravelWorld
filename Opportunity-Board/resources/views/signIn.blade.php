<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign IN</title>
    @vite('resources/css/app.css')
</head>

<body class="flex w-full h-full box-border">
    <main class="h-full w-full m-20 p-10 flex-col  text-center justify-center items-center gap-10 drop-shadow-xl bg-indigo-100">
        <div class="w-full">
            <h1>Sign in to <span>Opportunity Board</span></h1>
            <div class="flex justify-center items-center">
                <form method="POST" action="/users/authenticate">
                    @csrf 
                    <div class="flex items-start flex-col gap-5 capitalize ">

                        <label>Email</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="email" placeholder="enter email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{$message}} </p>
                        @enderror

                        <label>password</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="password" name="password" placeholder="Enter password">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror    
                    </div>

                    <button type="submit" class="bg-indigo-300 border-none hover:border-2 hover:border-indigo-500 rounded-lg p-3 hover:rounded-full w-full mt-5">
                    Submit  
                    </button>

                </form>
            </div>
            <!-- registration form -->



            <p>dont yet have an account? <a href="{{ route('signUp') }}">SignUp</a></p>
        </div>

    </main>


</body>



