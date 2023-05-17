<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap')
    <title>FreeAds - Annonce</title>
</head>
<body>
@include('header_co')

<div class="container mt-5">
    <h2 class="text-center">Modifier une annonce</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('edit_annonce',['annonce_id' => $annonce->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre :</label>
                            <input type="string" id="title" name="title" class="form-control" value="{{ $annonce->title }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description :</label>
                            <textarea id="description" name="description" class="form-control" required>{{ $annonce->description }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix :</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="price" name="price" class="form-control" value="{{ $annonce->price }}" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Ville :</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ $annonce->city }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Catégorie :</label>
                            <select name="category" id="category" class="form-select" required>
                                <option value="" selected disabled>Catégorie</option>
                                <option value="vehicule" @if($annonce->category == "vehicule") selected @endif>Véhicule</option>
                                <option value="mode" @if($annonce->category == "mode") selected @endif>Mode</option>
                                <option value="multimedia" @if($annonce->category == "multimedia") selected @endif>Multimédia</option>
                                <option value="meuble" @if($annonce->category == "meuble") selected @endif>Meuble</option>
                                <option value="animaux" @if($annonce->category == "animaux") selected @endif>Animaux</option>
                                <option value="sport" @if($annonce->category == "sport") selected @endif>Sport</option>
                                <option value="livres" @if($annonce->category == "livres") selected @endif>Livres</option>
                            </select>

                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label">Couleur: </label>
                            <select name="color" id="color" class="form-select" required>
                                <option value="" selected disabled>Couleur</option>
                                <option value="red" @if($annonce->color == "red") selected @endif>Rouge</option>
                                <option value="blue" @if($annonce->color == "blue") selected @endif>Bleu</option>
                                <option value="green" @if($annonce->color == "green") selected @endif>Vert</option>
                                <option value="yellow" @if($annonce->color == "yellow") selected @endif>Jaune</option>
                                <option value="orange" @if($annonce->color == "orange") selected @endif>Orange</option>
                                <option value="purple" @if($annonce->color == "purple") selected @endif>Violet</option>
                                <option value="pink" @if($annonce->color == "pink") selected @endif>Rose</option>
                                <option value="beige" @if($annonce->color == "beige") selected @endif>Beige</option>
                                <option value="black" @if($annonce->color == "black") selected @endif>Noir</option>
                                <option value="white" @if($annonce->color == "white") selected @endif>Blanc</option>
                                <option value="gray" @if($annonce->color == "gray") selected @endif>Gris</option>
                            </select>

                        </div>
                        <div class="mb-3 row">
                            @foreach ($annonce->images as $image)
                            <div class="col-md-4 mb-3">
                                <img src="{{ asset($image->picture) }}" class="card-img-top" alt="Image">
                                <input type="checkbox" id="supprimer-{{ $image->id }}" name="supprimer[]" value="{{ $image->id }}">
                                <label for="supprimer-{{ $image->id }}">Supprimer</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label for="images" class="form-label">Ajouter des images :</label>
                            <input type="file" id="images" name="images[]" class="form-control" accept="image/png, image/gif, image/jpeg" multiple>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Modifier</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
