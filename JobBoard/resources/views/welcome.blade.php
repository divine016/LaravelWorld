@extends('layouts.app')

@section('content')
<div class="text-center mt-40  w-full">

    <h1 class="text-7xl ">welcome to <span class="text-indigo-500 font-semibold">job board </span></h1>
    <p>World class <span class="text-indigo-500">opportunities</span> at your door step.</p>
    <div class="flex my-20 gap-20 mx-20 justify-around items-center ">
        <button class="bg-indigo-300 border-none hover:border-2 hover:bg-indigo-400 rounded-lg p-3 hover:rounded-full w-[30%]" type="submit"><a href="{{ route('signUp') }}">Sign Up</a></button>
        <button class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full w-[30%]" type="submit"><a href="{{ route('signIn') }}">Sign In</a></button>
    </div>

</div>

<div>
    <h1 class="text-center text-4xl"> Opportunities</h1>
    <div class="flex gap-5">
        @foreach($opportunities as $opportunity)
       
        <div class="card" style="width: 18rem;">
            
            <div class="card-body">
                <div>
                   
                <img src="{{ $opportunity['photo'] }}" alt="image here" height="200" width="200" />
                <div>
                <h5 class="card-title">
                    <p>{{ $opportunity['title'] }}</p>
                </h5>

                <p class="card-text">{{ $opportunity['description'] }}</p>
                </div>
                </div>
               
                
                
                <a href="{{route('apply', ['applyId' => $opportunity['id']]) }}" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full ">Apply</a>
                <a href="{{ route('opportunityDetail', ['opportunity' => $opportunity['id']] ) }}" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full ">Details</a>

            </div>
            <p>published at {{ $opportunity['published_at'] }} by '{{$opportunity['created_by']}}'</p>
        </div>

    </div>
    @endforeach
</div>



<footer class="py-16 text-center text-sm text-black dark:text-white/70">
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) copyright @Kouts
</footer>
@endsection