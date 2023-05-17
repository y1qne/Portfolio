<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap')
    <title>FreeAds - Annonces</title>
</head>
<body>
@include('header_co')

        <h1 class='text-center'>Annonces</h1>

        @if ($mesannonces)
        <div class="container mt-5">
            <form action="{{ route('search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="words" placeholder="Rechercher" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="city" placeholder="Ville" class="form-control">
                    </div>
                    <div class="col-md-3">
                    <select name="filtre" class="form-select">
                        <option value="time_desc" selected>Plus récent</option>
                        <option value="time_asc">Plus ancien</option>
                        <option value="view">Popularité</option>
                        <option value="price_asc">Prix croissant</option>
                        <option value="price_desc">Prix décroissant</option>
                    </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Rechercher</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <input type="number" id="min-price" name="min-price" placeholder="Prix -" min="0" step="1" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <input type="number" id="max-price" name="max-price" placeholder="Prix +" min="0" step="1" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <select name="category" class="form-select">
                        <option value="" selected disabled>Catégorie</option>
                        <option value="vehicule">Véhicule</option>
                        <option value="mode">Mode</option>
                        <option value="multimedia">Multimédia</option>
                        <option value="meuble">Meuble</option>
                        <option value="animaux">Animaux</option>
                        <option value="sport">Sport</option>
                        <option value="livres">Livres</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                    <select name="color" class="form-select">
                        <option value="" selected disabled>Couleur</option>
                        <option value="red">Rouge</option>
                        <option value="blue">Bleu</option>
                        <option value="green">Vert</option>
                        <option value="yellow">Jaune</option>
                        <option value="orange">Orange</option>
                        <option value="purple">Violet</option>
                        <option value="pink">Rose</option>
                        <option value="beige">Beige</option>
                        <option value="black">Noir</option>
                        <option value="white">Blanc</option>
                        <option value="gray">Gris</option>
                    </select>
                    </div>
                </div>
            </form>
        </div>

        @else
        <div class="container mt-5">
            <form action="{{ route('poster') }}" method="get">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                    <button class="btn btn-dark btn-block" type="submit">Nouvelle annonce</button>
                    </div>
                </div>
            </form>
        </div>

        @endif

        <div class="container mt-5">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                @foreach ($annonces as $annonce)
                <div class="col">
                    <div class="card h-100">
                        <div class="flex-row d-flex flex-wrap">
                            @foreach ($annonce->images as $image)
                                <img src="{{ asset($image->picture) }}" class="card-img-top" alt="Image">
                            @endforeach
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $annonce->title }}</h5>
                            <p class="card-text">{{ $annonce->description }}</p>
                            <p class="card-text"><small class="text-muted">Prix : {{ $annonce->price }} €</small></p>
                            @if ($annonce->user_id == $user['id'])
                                <a href="{{ route('edit_annonce_form', ['annonce_id' => $annonce->id]) }}" class="btn btn-dark">Modifier</a>
                                <a href="{{ route('supprimer_annonce', ['annonce_id' => $annonce->id]) }}" class="btn btn-danger">Supprimer</a>
                            @else
                                <a href="{{ route('contacter', ['annonce_id' => $annonce->id, 'receiver_id' => $annonce->user_id]) }}" class="btn btn-dark">Contacter</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>

</body>