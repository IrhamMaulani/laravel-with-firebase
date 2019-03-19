<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class ChatController extends Controller
{
    public function store(Request $request)
    {
        $chat = $request->chat;
        $user = $request->user;

        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/FirebaseKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        $database = $firebase->getDatabase();
        
        $newPost = $database
        ->getReference('Chats/Room1')
        ->push([
            'User' => $user,
            'Chat' => $chat
        ]);

        // $newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
        // $newPost->getUri(); // => https://my-project.firebaseio.com/blog/posts/-KVr5eu8gcTv7_AHb-3-

        // $newPost->getChild('title')->set('Changed post title');
        $newPost->getValue();

    
        return response()->json(['messages'=> 'Success Insert']);
    }
}
