<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\User;

class ConfirmationController extends Controller
{
    public function confirm(Request $request){
        $confirmation_token = $request->input('token');
        $user = User::where('confirmationToken', $confirmation_token)->firstOrFail();
        $user->confirm = true;
        $user->email_verified_at = now();
        $user->save();
        return redirect()->route('done')->with('success', 'Compte confirmé');

    }
}