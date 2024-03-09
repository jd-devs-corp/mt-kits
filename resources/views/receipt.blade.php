<!DOCTYPE html>
<html>
<head>
    <title>Reçu</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; }
        .container { width: 100%; margin: 0 auto; }
        .header { text-align: center; margin-bottom: 50px; }
        .content { width: 80%; margin: 0 auto; }
        .footer { text-align: center; margin-top: 50px; }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Reçu de Paiement</h1>
    </div>
    <div class="content">
        <p><strong>Nom du Fournisseur:</strong> {{ $user->name }}</p>
        <p><strong>Somme à Percevoir:</strong> {{ $user->somme_a_percevoir }} FCFA</p>
        <p><strong>Date:</strong> {{ now()->format('d/m/Y') }}</p>
        <!-- Autres informations -->
    </div>
    <div class="footer">
        <p>Merci pour votre business !</p>
    </div>
</div>
</body>
</html>
