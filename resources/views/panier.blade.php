<h1>Mon panier</h1>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1">
    <tr>
        <th>Produit</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Total</th>
    </tr>

    @foreach($panier as $item)
        <tr>
            <td>{{ $item['nom'] }}</td>
            <td>{{ $item['prix'] }}</td>
            <td>{{ $item['quantite'] }}</td>
            <td>{{ $item['prix'] * $item['quantite'] }}</td>
        </tr>
    @endforeach
</table>

<form action="{{ route('commander') }}" method="POST">
    @csrf
    <button type="submit">Valider la commande</button>
</form>
