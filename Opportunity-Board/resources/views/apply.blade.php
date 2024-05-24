<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    @vite('resources/css/app.css')

</head>
<body>
<div class="w-full">
            <h1>Apply for opportunity {{$opp->title}}</h1>
            <p>here is the description{{$opp->description}}</p>
            <div class="flex justify-center items-center">
                <form method="POST" action="{{ route('applications.applyForOpp', ['id' => $opp->id]) }}">
                    @csrf 
                
                <!-- <label>why are you applying for this role?</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="text" name="purpose" placeholder="Purpose of application" value="{{ old('purpose') }}">
                        @error('purpose')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label>provide a link to your cv</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="text" name="link" placeholder="enter link here password" value="{{ old('link') }}">
                        @error('link')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        -->
                    <div class="flex items-start flex-col gap-5 capitalize ">
                    <!-- <label>please typethe number you see in the url</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="text" placeholder="Enter id" name="oppId" value="{{ old('oppId') }}">
                        @error('oppId')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror     -->
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

                        <label>why are you applying for this role?</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="text" name="purpose" placeholder="Purpose of application" value="{{ old('purpose') }}">
                        @error('purpose')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label>provide a link to your cv</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="text" name="link" placeholder="enter link here password" value="{{ old('link') }}">
                        @error('link')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                    </div>
                  


                    <button type="submit" class="bg-indigo-300 border-none hover:border-2 hover:border-indigo-500 rounded-lg p-3 hover:rounded-full w-full mt-5">
                    Submit  
                    </button>

                </form>
            </div>
        </div>
</body>
</html>