<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Produit</title>
<!-- <link rel="stylesheet" href=" resources('css/add-produit.css') }}">  pas possible avk resources-->
    @vite(['resources/css/add-produit.css'])
</head>

<body class="bodyR">
<div class="auth-container">
<div class="auth-form-container">
<h2 class="auth-title">Ajouter un produit</h2>

<form action="/store" method="POST" class="auth-form">
    @csrf
    <div class="form-group">
    Nom: <input type="text" name="nom" id="nom" required class="form-input"> <br>
    </div>

    <div class="form-group">
    Stock: <input type="number" name="stock" id="stock" required class="form-input"> <br>
    </div>

    <div class="form-group">
    Prix: <input type="number" name="prix" id="prix" required class="form-input"> <br>
    </div>

    <div class="form-group"> Description
    <textarea name="description" id="descri" cols="30" rows="5" required class="form-input-textarea"></textarea>
    <br>
    </div>

    <div class="form-group">
    <label for="classification" class="form-label">Classification</label>
    <select name="classification" id="" class="form-input">
        <option value="" selected disabled hidden="" ></option>
        <option value="I" class="form-input">classe I</option>
        <option value="IIa">classe IIa</option>
        <option value="IIb">classe IIb</option>
        <option value="III">classe III</option>
    </select> <br>
    </div>

    <button type="submit"  class="auth-button">Ajouter</button>
</form>
</div>
</div>
</body>

</html>

 