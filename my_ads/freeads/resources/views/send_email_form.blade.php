<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap')
    <title>FreeAds - Login</title>
</head>
<body>
@include('header_deco')

<div class="container-sm mt-5" style="max-width: 50%;">

    <h2 class="text-center">Se connecter</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif


    <form action="{{ route('send_email') }}" method="post" class="border border-2 p-3 rounded">
        @csrf
        {{ method_field('POST') }}

        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail :</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark">Renvoyer l'email</button>
        </div>
    </form>
</div>

</body>
</html>
