<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Document</title>

    <style>
        .kanan{
            text-align: right;
            margin-right: 15px;
            background-color: #96c786;
            
        }
        div{
            width: 50%;
            
        }
        .kiri{
            background-color: #74bbfb;
        }

        </style>
</head>
<body>
    <h1>Chat B</h1>

     <div id="tableFormData">
        

    </div>


  <form id="form-chat">
   <input type="text" class="form-control" name="chat" value="{{ old('chat') }}" placeholder="chat">
   @csrf
    <input type="hidden" name="_method" value="POST">
    <br>
     <input type="hidden" name="user" value="user B">
    <button type="submit" class="btn btn-primary" name="submit" value="POST">Submit</button>
    </form>
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

database.ref('Chats/Room1').on('value', function(snapshot){
    let value = snapshot.val();
    let htmls = [];
    let posisi = " ";
    console.log(value);
    $.each(value, function(index, value){
    	if(value) {
  if(value.User === "user B"){
                posisi = 'kanan';
            }
            else{
               posisi = "kiri";
            }
    		htmls.push('<dl class ="'+ posisi +'">\
        		<dt>'+ value.User +'</dt>\
        		<dd>'+ value.Chat +'</dd>\
        	</dl>');
    	}    	
    	lastIndex = index;
    });
    $('#tableFormData').html(htmls);
    
});


$('#form-chat').submit(function(e){
    e.preventDefault();
    $.ajax({
        url: 'http://localhost/laravel-with-firebase/public/chat',
        type: "POST",
        data: new FormData(this),
		contentType: false,
        processData: false,
        success:function(data){
            console.log(data);
        }
    })
});

</script>
</html>