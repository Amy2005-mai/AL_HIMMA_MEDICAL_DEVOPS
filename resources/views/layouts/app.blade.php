<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Al Himma Medical')</title>
    @vite(['resources/css/add-produit.css'])
</head>
<body class="bodyR">
    <nav style="padding: 1rem; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(5px); margin-bottom: 2rem; display: flex; gap: 1rem; justify-content: center;">
        <a href="{{ route('produits.lecture') }}" style="color: white; text-decoration: none; font-weight: bold;">Liste des produits</a>
        <a href="{{ url('/ajout') }}" style="color: white; text-decoration: none; font-weight: bold;">Ajouter un produit</a>
    </nav>

    @yield('content')
</body>
</html>
