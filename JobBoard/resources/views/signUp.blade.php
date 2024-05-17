<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign yp</title>
    @vite('resources/css/app.css')
</head>

<body class="flex w-full h-full box-border">
    <main class="h-full w-full m-20 p-10 flex-col  text-center justify-center items-center gap-10 drop-shadow-xl bg-indigo-100">
        <div class="w-full">
            <h1>Sign Up to <span>opportunity Board</span></h1>
            <div class="flex justify-center items-center">
                <form method="POST" action="/users">
                    @csrf 
                    <div class="flex items-start flex-col gap-5 capitalize ">
                        <label>name</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="text" placeholder="Enter name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label>Phone number</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="tel" placeholder="enter Pnone number" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label>Email</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="email" placeholder="enter email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <p class="text-red-500 text-xs mt-1">{{$message}} </p>
                        @enderror

                        <label>password</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="password" name="password" placeholder="Enter password" value="{{ old('password') }}">
                        @error('password')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label>confirm password</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="password" name="password_confirmation" placeholder="confirm password" value="{{ old('password_confrimation') }}">
                        @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                     

                    <div class=" gap-5 items-center justify-between">
                        <label>
                            <input type="radio" name="user_type" value="student" class="font-medium">
                            Individual
                        </label>
                        <label class="ml-4">
                            <input type="radio" name="user_type" value="company" class="font-medium">
                            Company
                        </label>
                    </div>
                    <div class=" gap-5 items-center justify-between"  style="display: none;" id="category" >
                        <label>What are you looking for??</label> 
                        <select name="category" >
                            <option value="">-- Select Category --</option>
                            <option value="volunteer">Volunteer</option>
                            <option value="internship">Internship</option>
                            <option value="job">Job</option>
                        </select>
                    </div>


                    <button type="submit" class="bg-indigo-300 border-none hover:border-2 hover:border-indigo-500 rounded-lg p-3 hover:rounded-full w-full mt-5">
                    Submit  
                    </button>

                </form>
            </div>
            <!-- registration form -->



            <p>already have an account? <a href="{{ route('signIn') }}">SignIn</a></p>
        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
            const categoryField = document.getElementById('category');

            userTypeRadios.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.value === 'student') {
                        categoryField.style.display = 'block';
                    } else {
                        categoryField.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>