<!DOCTYPE html>
<html >
    <head>
</head>
<body>
@foreach($cars as $car)
   <li> {{$car->make}}
    {{$car->model}}
    {{$car->produced_on}}<li>
 @endforeach
</body>
</html>
