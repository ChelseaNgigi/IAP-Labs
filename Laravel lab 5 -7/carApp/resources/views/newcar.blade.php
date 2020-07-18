<!DOCTYPE html>
<html >
    <head>
        
    </head>
    <body>
        @if(Session::has('form_submit'))
        {{session('form_status')}}
        @endif
        @if(count($errors))
        @foreach ($errors->all() as $error )
        <li>{{$error}}</li>
            
        @endforeach
        @endif

        <form method="post" action="/car" enctype="multipart/form-data" >
         {{ csrf_field() }}
        Car Make: <input name="make" value="{{old('make')}}"/><br>

          Car Model: <input name="model" type="text" value="{{old('model')}}"/><br>
            Date produced: <input type="date" name="produced_on" value="{{old('produced_on')}}"/><br>
            <input type="file" name="image"/><br>
            <input type="submit" value="Save"/>
        </form>
        
    </body>
</html>
