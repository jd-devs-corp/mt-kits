<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de paiement</title>
    <style>
        body {
            font-family: 'Sora', sans-serif;
            font-size: 16px;
            margin: 20px;
            color: #000000;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1{
            font-size: 2rem;
            text-decoration: underline;
        }
        h2{
            font-size: 1.25rem;
            text-decoration: underline;
            text-align: center;
        }

        .header {
            background-color: #334155;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .header img {
            height: 100px;
        }

        .section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #D3DCE6;
            border-radius: 5px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table td, .table th {
            padding: 5px;
            border: 1px solid #D3DCE6;
        }

        .table th {
            text-align: left;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <img src="{{ public_path().'/images/logo.png'}}" alt="Logo">
        <h1>Reçu de paiement</h1>
    </div>

    <div class="section">
        <h2>Informations du client</h2>
        <p>Nom : {{ $abonnement->kit->client->name }}</p>
    </div>

    <div class="section">
        <h2>Informations du kit</h2>
        <p>Numéro du kit : {{ $abonnement->kit->kit_number }}</p>
    </div>

    <div class="section">
        <h2>Informations d'abonnement</h2>
        <table class="table">
            <tr>
                <th>Date de début</th>
                <td>{{ $abonnement->date_abonnement }}</td>
            </tr>
            <tr>
                <th>Date de fin</th>
                <td>{{ $abonnement->date_fin_abonnement }}</td>
            </tr>
            <tr>
                <th>Plan tarifaire</th>
                <td>{{ $abonnement->plan_tarifaire }} XAF</td>
            </tr>
        </table>
    </div>

    @if($abonnement->kit->user)
        <div class="section">
            <h2>Informations du fournisseur</h2>
            <p>Nom du fournisseur : {{ $abonnement->kit->user->name }}</p>
        </div>
    @endif
</div>
</body>
</html>

