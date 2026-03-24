<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Al Himma Medical')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/add-produit.css'])
</head>
<body class="bodyR">
    <nav class="navbar-glass">
        <a href="{{ route('produits.lecture') }}" class="nav-brand">AL HIMMA MEDICAL</a>
        <div class="nav-links">
            <a href="{{ route('produits.lecture') }}" class="nav-link">Catalogue</a>
            <a href="{{ route('checkout') }}" class="nav-cart-btn">
                🛒 Mon Panier <span style="background: white; color: var(--primary-color); padding: 0.1rem 0.5rem; border-radius: 50px; font-size: 0.8rem;">{{ count(session('panier', [])) }}</span>
            </a>
        </div>
    </nav>

    @yield('content')
</body>
</html>
