<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    this are applicants

    <p>name{{$application->name}}</p>
    <p>name{{$application->email}}</p>
    <p>name{{$application->phone}}</p>

    <button><a href="{{route('company')}}"></a></button>
</body>
</html>