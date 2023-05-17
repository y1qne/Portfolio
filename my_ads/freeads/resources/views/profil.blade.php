<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap')
    <title>FreeAds - Profil</title>
</head>
<body>
@include('header_co')

    <div class="p-3 ml-3">{{ 'Bienvenue, ' . $user->name . '!' }}</div>

    <div class="d-flex justify-content-start">
    <form class="mx-2" method="GET" action="{{ route('edit_profil') }}">
        @csrf
        <button class="btn btn-dark" type="submit">Modifier profil</button>
    </form>
    <form class="mx-2" method="GET" action="{{ route('mesannonces') }}">
        @csrf
        <button class="btn btn-dark" type="submit">Mes annonces</button>
    </form>
    <form class="mx-2" method="GET" action="{{ route('poster') }}">
        @csrf
        <button class="btn btn-dark" type="submit">Nouvelle annonce</button>
    </form>
    <form class="mx-2" method="POST" action="{{ route('disable') }}">
        @csrf
        <button class="btn btn-danger" type="submit">Disable</button>
    </form>
</div>


</form>
</body>
</html>