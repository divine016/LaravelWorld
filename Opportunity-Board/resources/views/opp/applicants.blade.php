<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <p>here are the people that applied for the opportunity {{$opp->title}}</p>
   <p>DEscription:  {{$opp->description}}</p>
   <p>Category: {{$opp->category}}</p>


    @foreach($applicants as $applicant)
    <div class="card" style="width: 18rem;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                    <h5 class="card-title">
                        <p>{{ $applicant['name'] }}</p>
                    </h5>
                    <p class="card-text">{{ $applicant['email'] }}</p>
                    <p class="card-text">{{ $applicant['phone'] }}</p>

                </div>
    </div>
    @endforeach
    <a href="{{route('pages.company')}}" class="text-black ml-4"> Back  to home page</a>

</body>
</html>