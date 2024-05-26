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
        </form>

        <a href="{{ route('pages.create') }}" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full w-[30%]">  <button  type="submit">create</button></a>
        <a href="{{ route('opportunities.publishdOpp') }}" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full w-[30%]">  <button  >Published</button></a>
    </div>

    <div>
        <h1 class="text-center text-4xl"> Published Opportunities</h1>
        <div class="flex gap-5">
            @foreach($publishedOpportunities as $publishedOpportunity)
            <div class="card" style="width: 18rem;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <img src="{{ $publishedOpportunity['photo'] }}" alt="image here" height="200" width="200" />
                    <h5 class="card-title">
                        <p>{{ $publishedOpportunity['title'] }}</p>
                    </h5>
                    <p class="card-text">{{ $publishedOpportunity['description'] }}</p>

                </div>
                <p>created at {{ $publishedOpportunity['created_at'] }} by '{{$publishedOpportunity['created_by']}}'</p>
                
                        <p class="text-indigo-400 p-3 bg-slate-300">
                            published</p>
                  

                </div>


            </div>

        </div>
        @endforeach
    </div>

</div>
<a href="{{route('pages.company')}}" class="text-black ml-4"> Back </a>

@endsection