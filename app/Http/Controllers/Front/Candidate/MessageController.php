<?php

namespace ReclutaTI\Http\Controllers\Front\Candidate;

use Auth;
use ReclutaTI\Message;
use Illuminate\Http\Request;
use ReclutaTI\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('candidate.auth');
    }

    public function index()
    {
    	//Get all the message unread
    	$unreadMessages = Message::where('addressee', Auth::user()->id)->where('status', 0)->get();
    	$unreadMessages->each(function ($message) {
    		$message->status = 1;

    		$message->save();
    	});

    	//Get all parent messages
    	$messages = Message::where('addressee', Auth::user()->id)
    							->where('parent_id', 0)
    							->where('status', 1)
    							->orderBy('created_at', 'DESC')
    							->get();

    	return view('front.candidate.dashboard.message.index', ['messages' => $messages]);
    }
}
