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

        <a href="{{ route('pages.create') }}" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full w-[30%]">  <button  type="submit">create</button></a>
    </div>

    <div>
        <h1 class="text-center text-4xl"> Opportunities</h1>
        <div class="flex gap-5">
            @foreach($opportunities as $opportunity)
            <div class="card" style="width: 18rem;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <img src="{{ $opportunity['photo'] }}" alt="image here" height="200" width="200" />
                    <h5 class="card-title">
                        <p>{{ $opportunity['title'] }}</p>
                    </h5>
                    <p class="card-text">{{ $opportunity['description'] }}</p>
                    <!-- <a href="#" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full ">published</a> -->

                </div>
                <p>created at {{ $opportunity['created_at'] }} by '{{$opportunity['created_by']}}'</p>
                <div class="flex gap-10">
                    <form action="{{ route('opportunities.publish', ['id' => $opportunity['id']]) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full">
                            publish</button>
                    </form>

                    <!-- <form method="POST" action="/delete/{{$opportunity->id}}"> -->
                    <form method="POST" action="{{ route('opportunities.deleteOpportunity', [$opportunity->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full">
                            <!-- <i class="fa-solid fa-trash"></i>  -->
                            Delete</button>
                    </form>
                    <!--  -->
                    <!-- <button class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full">
                        <a href="{{route('opportunities.editOpportunity', ['opportunity' => $opportunity['id']]) }}">Edit</a>
                    </button> -->
                    <!-- <button><a href="viewApplicants"></a>view applicants</button> -->
                 
                   
                </div>


            </div>

        </div>
        @endforeach
    </div>
</div>

@endsection