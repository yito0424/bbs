<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::all();
        return view('dashboard', ['threads' => $threads]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $thread = new Thread();
        $user = \Auth::user();

        $thread->content = $request->content;
        $thread->user_id = $user->id;
        $thread->save();
        
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, Thread $thread)
    {
        $thread = Thread::find($id);
        $replies = $thread->reply;
        return view('thread', ['thread' => $thread, 'replies' => $replies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, Thread $thread){
        $thread = Thread::find($id);
        return view('edit', ['thread' => $thread]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Thread $thread)
    {
        $thread = Thread::find($id);
        $user = \Auth::user();
        if($user->id == $thread->user_id || $user->role == 'admin'){
            $thread->content = $request->content;
            $thread->save();
        }
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Thread $thread)
    {
        $thread = Thread::find($id);
        $user = \Auth::user();
        if($user->id == $thread->user_id || $user->role == 'admin'){
            $thread->delete();
        }
        return redirect()->route('dashboard');
    }
}
