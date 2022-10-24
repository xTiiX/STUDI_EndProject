<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $mailData['title'] }}</title>
</head>
<body>
    <h1>Bienvenue sur Loockers !</h1>
    <br>
    <p>Voici vos identifiants pour votre première connexion,
         vous pourrez modifier votre mot de passe dans l'onglet Paramètres</p>
    <br>
    <p>Email : {{ $mailData['email'] }}</p>
    <p>Mot de passe temporaire : {{ $mailData['password'] }}</p>
    <br>
    <p>A très vite sur votre plateforme de gestion Loockers !</p>
</body>
</html>
