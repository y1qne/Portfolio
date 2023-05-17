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
    <h2 class="text-center">Poster une annonce</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Titre :</label>
                            <input type="string" id="title" name="title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description :</label>
                            <textarea id="description" name="description" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prix :</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" id="price" name="price" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="city" class="form-label">Ville :</label>
                            <input type="text" name="city" id="city" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Catégorie :</label>
                            <select name="category" id="category" class="form-select" required>
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
                        <div class="mb-3">
                            <label for="color" class="form-label">Couleur: </label>
                            <select name="color" id="color" class="form-select" required>
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
                        <div class="mb-3">
                            <label for="images" class="form-label">Images :</label>
                            <input type="file" id="images" name="images[]" class="form-control" accept="image/png, image/gif, image/jpeg" multiple>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark">Poster</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
