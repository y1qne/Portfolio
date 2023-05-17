<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class ProfilController extends Controller
{
    public function showProfil(Request $request){
        $id = auth()->id();
        $user = User::where('id', $id)->firstOrFail();
        return view('profil', compact('user'));
    }

    public function showEdit(Request $request){
        $id = auth()->id();
        $user = User::where('id', $id)->firstOrFail();
        return view('edit_profil', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
        ]);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // if ($request->input('password')){
        //     $user->password = Hash::make($request->input('password'));
        // }
        $user->save();
        return redirect()->route('edit_profil')->with('success', 'Profil mis à jour avec succès.');
    }

}