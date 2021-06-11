<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request, $id, Reply $reply)
    {
        $reply = new Reply();

        $reply->content = $request->content;
        $reply->thread_id = $id;
        $reply->save();
        
        return redirect()->route('thread.show', ['id' => $id]);
    }
}
