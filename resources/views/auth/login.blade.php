<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRM RH - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:700,600" rel="stylesheet" type="text/css" />
    @vite('resources/css/auth.css')
</head>
<body>



<form method="post" action="{{ route('handleLogin') }}">
    @csrf
    @method('POST')

    <div class="box">
        <h1>Espace de connexion</h1>
        @if (Session::get('error_msg'))
            <span class='error'>* {{ Session::get('error_msg') }}</span>
        @endif
        <div class="champ">
            <label for="email">Adresse mail</label>
            <input type="email" name="email" class="email" placeholder="Votre adresse mail" />
        </div>
        <div class="champ">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="email" placeholder="Votre mot de passe" />
        </div>
        <div class="btn-container">
            <button type="submit">Connexion</button>
        </div>
    </div>
</form>

@vite('resources/js/auth.js')
</body>
</html>