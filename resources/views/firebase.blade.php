<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="firebase" method="POST" id="form">
          <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
          <br>
            <input type="text" class="form-control" name="body" value="{{ old('body') }}" placeholder="Body">
   @csrf
    <input type="hidden" name="_method" value="POST">
    <br>
    <button type="submit" class="btn btn-primary" name="submit" value="POST">Submit</button>
    </form>

    <h1>Isi Data Firebase </h1>

    <table id="table">
        <tr>
            <th>Title</th> 
            <th>Body</th>
            
        </tr>

    </table>
    
</body>

<script>


    </script>
</html>