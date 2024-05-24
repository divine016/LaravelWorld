@extends('layouts.navComp')
@section('content')

<div class="flex w-full h-full box-border">
    <main class="h-full w-full m-20 p-10 flex-col  text-center justify-center items-center gap-10 drop-shadow-xl bg-indigo-100">
        <div class="w-full">
            <h1 class="text-4xl m-2">Edit <span>opportunity</span></h1>
            <p>edit {{$opportunity->title}}</p>
            <div class="flex justify-center items-center">
                <form method="POST" action="{{ route('opportunities.updateOpportunity', [$opportunity->id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="flex items-start flex-col gap-5 capitalize ">
                        <div class="flex justify-center items-start flex-col gap-5">
                        <label for="image">click to upload image (jpeg, jpg, png)</label>
                        <img width="200" height="200" src="{{ $opportunity['photo'] }}" alt="place holder for image todo" id="profileDislay" style=" text-align: center;" onclick="triggerClick()" class="flex justify-center items-center object-contain">
                        
                        <input type="file" 
                        accept="image/png, image/jpg, image/jpeg" 
                        name="photo" 
                        
                        value="{{ $opportunity['photo'] }}"   
                        onchange="displayImage(this)" 
                        id="uploadImage" 
                        > 
                        </div>
                        

                        

                        @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror


                        <label>title</label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="text" placeholder="Enter title" name="title" value="{{ $opportunity['title'] }}">
                        @error('title')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <label>Description </label>
                        <input class="w-full border-2 p-2 rounded-md border-indigo-300" type="tel" placeholder="enter Description" name="description" value="{{ $opportunity['description'] }}">
                        @error('description')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror


                        <div class=" gap-5 items-center justify-between" id="category">
                            <label>Who is this for??</label>
                            <select name="category">
                                <option value="">-- Select Category --</option>
                                <option value="volunteer">Volunteer</option>
                                <option value="internship">Internship</option>
                                <option value="job">Job</option>
                            </select>

                            @error('category')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        </div>


                        <button type="submit" class="bg-indigo-300 border-none hover:border-2 hover:border-indigo-500 rounded-lg p-3 hover:rounded-full w-full mt-5">
                            Update Opportunity
                        </button>

                        <a href="{{route('pages.company')}}" class="text-black ml-4"> Back </a>
                    </div>

                </form>
    </main>
</div>
@endsection