<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;



class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }
    public function showLogout()
    {
        return view('logout');
    }

    public function connect(Request $request)
    {
        // validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->confirm == 0){
                Auth::logout();

                return redirect()->back()->withInput()->withErrors([
                    'email' => "Confirmez d'abord votre compte.",
                ]);
            }else if (auth()->user()->disable == 1){
                Auth::logout();

                return redirect()->back()->withInput()->withErrors([
                    'email' => "Ce compte a été desactivé.",
                ]);
            }else{
                //unread messages
                $unread = DB::table('messages')
                ->where('receiver_id', auth()->id())
                ->where('status', 0)
                ->count();

                session(['unread' => $unread]);

                return redirect()->route('profil');
            }
        }
    
        // if authentication fails, redirect the user back to the login page with an error message
        return redirect()->back()->withInput()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }
    

    public function deconnect(Request $request): RedirectResponse
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }

    public function sendEmail(Request $request): RedirectResponse
    {
        $user = User::where('email', $request->input('email'))->first();
        if ($user==false) {
            return redirect()->back()->with('error', 'Aucun compte associé à cet email.');
        }

        $confirmation_token = Str::random(40);
        $user->confirmationToken = $confirmation_token;
        $user->save();

        Mail::send('emails', ['confirmation_token' => $confirmation_token], function ($message) use ($user){ $message->to($user->email); $message->subject('Confirmez votre compte');});

        return redirect()->back()->with('success', 'Email renvoyé.');
    }
}