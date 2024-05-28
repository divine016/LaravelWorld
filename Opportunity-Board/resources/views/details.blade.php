<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>welcome to the details page</h1>
<p>names {{$opportunity->title}} </p>
<p>desc {{$opportunity->description}} </p>



<a href="{{route('applications.apply', ['applyId' => $opportunity['id']]) }}" class="bg-indigo-400 border-none hover:border-2 hover:bg-indigo-500 rounded-lg p-3 hover:rounded-full ">Apply</a>



</body>
</html>