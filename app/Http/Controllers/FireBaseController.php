<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;


class FireBaseController extends Controller
{
        public function store(Request $request){

            $title = $request->title;
            $body = $request->body;

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $database = $firebase->getDatabase();
        
        $newPost = $database
        ->getReference('blog/posts')
        ->push([
            'title' => $title,
            'body' => $body
        ]);

    // $newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
    // $newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-

    // $newPost->getChild('title')->set('Changed post title');
    $newPost->getValue(); 

    
        return response()->json(['messages'=> 'Success Insert']);
    }

    public function index(){
         $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $database = $firebase->getDatabase();

        $ref = $database->getReference('blog/posts');
        
        
        $posts = $ref->getValue();

        $datas = array();

        foreach ($posts as $post) {
            $datas[] = array(
'title' => $post['title'],
'body' => $post['body']
            );
        }
        
         
         return response()->json($datas);
        
    }
}