<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Annonce;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;


class AnnonceController extends Controller
{

    public function showAnnonce()
    {
        return view('new_annonce');
    }

    public function showAnnonces()
    {
        $annonces = Annonce::orderBy('id', 'desc')->get();
        $user_id = auth()->id();
        $user = ['id'=>$user_id];
        $mesannonces = true;
        return view('annonces', compact('annonces','user','mesannonces'));  
    }

    public function showMyAnnonces()
    {
        $user_id = auth()->id();
        $user = ['id'=>$user_id];
        $annonces = Annonce::where('user_id', $user_id)->orderBy('id', 'desc')->get();
        $mesannonces = false;
        return view('annonces', compact('annonces','user','mesannonces'));    
    }

    public function searchAnnonces(Request $request)
    {
        $user_id = auth()->id();
        $user = ['id'=>$user_id];
    
        $annonces = Annonce::query();
    
        if ($request->input('words')!='') {
            $keywords = explode(' ', $request->input('words'));
            $annonces->where(function($query) use ($keywords) {
                foreach($keywords as $keyword) {
                    $query->where('title', 'LIKE', '%'.$keyword.'%')
                          ->orWhere('description', 'LIKE', '%'.$keyword.'%');
                }
            });
        }
    
        if ($request->input('city')!='') {
            $annonces->where('city', '=', $request->input('city'));
        }
    
        if ($request->input('category')!='') {
            $annonces->where('category', '=', $request->input('category'));
        }

        if ($request->input('color')!='') {
            $annonces->where('color', '=', $request->input('color'));
        }

        if ($request->input('min-price')!='') {
            $annonces->where('price', '>=', $request->input('min-price'));
        }

        if ($request->input('max-price')!='') {
            $annonces->where('price', '<=', $request->input('max-price'));
        }

        $filter = $request->input('filtre');
        switch ($filter) {
            case 'time_desc':
                $annonces->orderBy('id', 'desc');
                break;
            case 'time_asc':
                $annonces->orderBy('id', 'asc');
                break;
            case 'views':
                $annonces->orderBy('views', 'desc');
                break;
            case 'price_asc':
                $annonces->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $annonces->orderBy('price', 'desc');
                break;
            default:
                break;
        }

    
        $annonces = $annonces->get();
        $mesannonces = true;
    
        return view('annonces', compact('annonces', 'user', 'mesannonces'));
    }
    
    


    public function uploadAnnonce(Request $request)
    {
        $annonce = new Annonce;
        $annonce->user_id = auth()->id();
        $annonce->title = $request->input('title');
        $annonce->description = $request->input('description');
        $annonce->price = $request->input('price');
        $annonce->category = $request->input('category');
        $annonce->color = $request->input('color');
        $annonce->city = $request->input('city');

        $annonce->save();

        foreach ($request->file('images') as $file){
            $filename = $file->store('images');
            $image = new Image();
            $image->picture = $filename;
            $image->annonce_id = $annonce->id;
            $image->save();
        }

        return redirect()->route('done')->with('success', 'Annonce creee avec succes');
    }
    
    public function editAnnonceForm(Request $request)
    {
        // Retrieve the annonce with the specified $annonce_id
        $annonce_id = $request->query('annonce_id');
        $annonce = Annonce::where('id', $annonce_id)->first();
    
        // Check if the annonce exists
        if (!$annonce || $annonce->user_id!=auth()->id()) {
            abort(404);
        }
    
        // Return the view with the $annonce data
        return view('edit_annonce', ['annonce' => $annonce]);
    }

    public function editAnnonce(Request $request){
        $annonce_id = $request->query('annonce_id');
        $annonce = Annonce::find($annonce_id);
        
        if (!$annonce) {
            abort(404);
        }

        foreach ($annonce->images as $image){
            if ($request->has('supprimer') && in_array($image->id, $request->input('supprimer'))) {
                Storage::delete($image->picture);
                $image->delete();
            }
        }

        $annonce->title = $request->input('title');
        $annonce->description = $request->input('description');
        $annonce->price = $request->input('price');
        $annonce->category = $request->input('category');
        $annonce->color = $request->input('color');
        $annonce->city = $request->input('city');
        $annonce->save();

        if ($request->file('images')){
            foreach ($request->file('images') as $file){
                $filename = $file->store('images');
                $image = new Image();
                $image->picture = $filename;
                $image->annonce_id = $annonce->id;
                $image->save();
            }
        }
        
        return redirect()->route('done')->with('success', 'Annonce modifiée');
    }

    public function deleteAnnonce(Request $request){
        $annonce_id = $request->query('annonce_id');

        $annonce = Annonce::where('id', $annonce_id)->delete();
        return redirect()->route('done')->with('success', 'Annonce supprimée');
    }
}