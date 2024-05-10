@extends('layouts.app')

@section('content')
<h1>creating student</h1>

<div class="p-5 m-3 bg-dark">
    <h1 class="text-white p-2 text-center">Create new student</h1>

    <div class="bg-white p-4">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf 
            <div class="form-group mb-4">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name">
            </div>
            <div class="form-group mb-4">
                <label for="name">Score</label>
                <input type="number" class="form-control" name="score">
            </div>
            <div class="form-froup mb-4">
                <button type="submit" class=" mb-4 btn btn-primary">submit</button>
            </div>

        </form>
    </div>

</div>

@endsection