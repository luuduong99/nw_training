<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Subjects you have not registered yetsubjects you have not registered yet</h1>
@foreach($data as $subject => $value)
    <p>{{ $value }}</p>
@endforeach
<h3>Please register for the missing subjects</h3>
</body>
</html>