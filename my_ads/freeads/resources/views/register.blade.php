<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap')
    <title>FreeAds - Register</title>
</head>
<body>
    @include('header_deco')

        
    <div class="container-sm mt-5" style="max-width: 50%;">

    <h2 class="text-center">S'inscrire</h2>

    <form action="{{ route('save') }}" method="post" class="border border-2 p-3 rounded">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nom :</label>
            <input type="string" id="name" name="name" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail :</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-dark">S'inscrire</button>
        </div>
    </form>
</div>

