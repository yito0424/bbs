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

    public function edit(Request $request, $rep_id, Reply $reply)
    {
        $reply = Reply::find($rep_id);

        return view('edit_reply', ['reply' => $reply]);
    }

    public function update(Request $request, $rep_id, Reply $reply)
    {
        $reply = Reply::find($rep_id);
        $user = \Auth::user();
        if($user->id == $reply->user_id || $user->role == 'admin'){
            $reply->content = $request->content;
            $reply->save();
        }
        return redirect()->route('thread.show', ['id' => $reply->thread_id]);
    }

    public function destroy($rep_id, Reply $reply)
    {
        $reply = Reply::find($rep_id);
        $user = \Auth::user();
        if($user->id == $reply->user_id || $user->role == 'admin'){
            $reply->delete();
        }
        return redirect()->route('thread.show', ['id' => $reply->thread_id]);
    }
}
