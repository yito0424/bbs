<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request, $id, Reply $reply)
    {
        $reply = new Reply();
        $user = \Auth::user();

        $reply->content = $request->content;
        $reply->thread_id = $id;
        $reply->user_id = $user->id;
        $reply->save();
        
        return redirect()->route('thread.show', ['id' => $id]);
    }
}
