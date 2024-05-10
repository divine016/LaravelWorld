@extends('layouts.navComp')

@section('content')
<div>
    <div class="text-center ">
        <h1 class="text-4xl">welcome to job board<span class="text-indigo-500 font-semibold"> {{auth()->user()->name}}</span></h1>
        <p>provide opportunities<span class="text-indigo-500">opportunities</span> at your door step.</p>
    </div>

    <div class="flex my-20 gap-20 justify-between w-full items-center ">
        <form class="flex gap-3 mx-10" role="search">
            <input class="border-2 rounded-full p-3 " id="search" type="search" placeholder="&#x1F50D; Search..." aria-label="Search">
            <!-- <button class="bg-indigo-500 px-3 rounded-lg" type="submit">Search</button> -->
        </form>

        <p>create</p>

    </div>
</div>

@endsection