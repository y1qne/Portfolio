<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Annonce;
use App\Models\Message;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller
{
    public function sendMessage(Request $request){

        $annonce = new Message;
        $annonce->sender_id = auth()->id();
        $annonce->receiver_id = $request->input('receiver_id');
        $annonce->annonce_id = $request->input('annonce_id');
        $annonce->content = $request->input('content');

        $annonce->save();

        $respond=false;

        // $messages = DB::table('messages')
        //             ->join('users', 'messages.receiver_id', '=', 'users.id')
        //             ->join('annonces', 'messages.annonce_id', '=', 'annonces.id')
        //             ->select('messages.id', 'messages.content', 'messages.status', 'messages.created_at as sent_at', 'users.name', 'annonces.title')
        //             ->where('messages.sender_id', auth()->id())
        //             ->get();

        return $this->showSent();
    }

    public function showMessageForm($annonce_id, $receiver_id){
        return view('new_message', compact('annonce_id', 'receiver_id'));
    }
    

    public function showMessages(){
        $messages = DB::table('messages')
        ->join('users', 'messages.receiver_id', '=', 'users.id')
        ->join('annonces', 'messages.annonce_id', '=', 'annonces.id')
        ->select('messages.id', 'messages.content', 'messages.status', 'messages.created_at as sent_at', 'users.name', 'annonces.title','messages.annonce_id','messages.sender_id','messages.receiver_id')
        ->where('messages.receiver_id', auth()->id())
        ->orderBy('id', 'desc')
        ->get();

        // messages -> lus
        DB::table('messages')
        ->where('receiver_id', auth()->id())
        ->update(['status' => 1]);

        session(['unread' => 0]);

        $respond=true;
        return view('mailbox', compact('messages', 'respond'));
    }

    public function showSent(){
        $messages = DB::table('messages')
        ->join('users', 'messages.receiver_id', '=', 'users.id')
        ->join('annonces', 'messages.annonce_id', '=', 'annonces.id')
        ->select('messages.id', 'messages.content', 'messages.status', 'messages.created_at as sent_at', 'users.name', 'annonces.title','messages.annonce_id','messages.sender_id','messages.receiver_id')
        ->where('messages.sender_id', auth()->id())
        ->orderBy('id', 'desc')
        ->get();

        $respond=false;

        return view('mailbox', compact('messages', 'respond'));  
    }
}