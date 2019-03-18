<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>

    <form id="formDataBangsat">
          <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title">
          <br>
            <input type="text" class="form-control" name="body" value="{{ old('body') }}" placeholder="Body">
   @csrf
    <input type="hidden" name="_method" value="POST">
    <br>
    <button type="submit" class="btn btn-primary" name="submit" value="POST">Submit</button>
    </form>

    <h1>Isi Data Firebase </h1>

    <table id="tableFormData">
        <tr>
            <th>Title</th> 
            <th>Body</th>
        </tr>

    </table>
    
</body>
<script src="https://www.gstatic.com/firebasejs/5.9.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.9.0/firebase-database.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });
 var config = {
    apiKey: "AIzaSyCf6EdLZ2hzVx5dLcoLQXMy6VOA__iN2EY",
    authDomain: "belajar-laravel-2eaab.firebaseapp.com",
    databaseURL: "https://belajar-laravel-2eaab.firebaseio.com",
    projectId: "belajar-laravel-2eaab",
    storageBucket: "belajar-laravel-2eaab.appspot.com",
    messagingSenderId: "628273137317"
};
firebase.initializeApp(config);
let database = firebase.database();
let lastIndex = 0;

database.ref('blog/posts').on('value', function(snapshot){
    let value = snapshot.val();
    let htmls = [];
    $.each(value, function(index, value){
    	if(value) {
    		htmls.push('<tr>\
        		<td>'+ value.body +'</td>\
        		<td>'+ value.title +'</td>\
        	</tr>');
    	}    	
    	lastIndex = index;
    });
    $('#tableFormData').html(htmls);
    
});


$('#formDataBangsat').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: "http://localhost/laravel-with-firebase/public/firebase",
        type: "POST",
        data: new FormData(this),
		contentType: false,
        processData: false,
        success:function(data){
            console.log(data);
        }
    })
});

/* $(document).ready(function(){
    $.ajax({
        url: "http://localhost/laravel-with-firebase/public/firebase",
        type: "GET",
        success:function(data){
            data.forEach(function(data){
                $('#tableFormData').append('<tr><td>'+data.body+'</td><td>'+data.title+'</td></tr>');
            })
        }
    })
}) */
</script>
</html>