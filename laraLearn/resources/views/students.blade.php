@extends('layouts.app')

@section('content')
<div class="text-center p-4 m-0">
    <h1>classlist from controller</h1>
</div>

<div class="p-4 pt-0">
    @foreach($students as $student)
    <div class="p-4 bg-info mb-2">
        <p>
        {{$student['id']}}
        {{$student['name']}}
        <a href="{{route('studentsDetails', ['id' => $student['id']] )}}"> details</a>
        </p>
        
        <p>
            @if($student['score'] >= 30)
            <span class="text-success">congratulations you scored {{$student['score']}} which is a pass mark</span>
            
            @else
            <span class="text-danger">Oops, sorry you scored {{$student['score']}} which is a failed mark</span>
            @endif
        </p>

    </div>
    @endforeach
</div>


<!-- <h1>class list</h1>
<ol>
    <li>Kouti Divine <a href="{{route('studentsDetails', ['id' => 1] )}}"> details</a></li>
    <li>Fongoh Martin <a href="{{route('studentsDetails', ['id' => 2] )}}"> details</a>
    </li>
    <li>Mbella KIngsley <a href="{{route('studentsDetails', ['id' => 3] )}}"> details</a>
    </li>
    <li>Enow Viney <a href="{{route('studentsDetails', ['id' => 4] )}}"> details</a>
    </li>
    <li>Jane Doe <a href="{{route('studentsDetails', ['id' => 5] )}}"> details</a>
    </li>
</ol> -->
@endsection