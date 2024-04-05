
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .receipt-container {
            background-color: #fff;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #ffcc00;
            padding: 10px;
            color: #000;
            text-align: center;
        }
        .header .company-name {
            font-weight: bold;
        }
        .info-section {
            margin: 20px 0;
        }
        .info-section h2 {
            background-color: #ffcc00;
            padding: 5px;
            display: inline-block;
        }
        .info-section table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-section th, .info-section td {
            text-align: left;
            padding: 8px;
        }
        .info-section .highlight {
            background-color: #e0e0e0;
        }
        .total {
            background-color: #ffcc00;
            padding: 10px;
            font-weight: bold;
            text-align: right;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="receipt-container">
    <div class="header">
        <div class="company-name">MTKits</div>
        <div>Reçu de Paiement n° {{time()}}</div>
    </div>
    <div class="info-section">
        <h2>Facturé à :</h2>
        <table>
            <tr>
                <th>Nom</th>
                <td>{{ $abonnement->kit->client->name }}</td>
            </tr>
            <tr>
                <th>Adresse</th>
                <td>{{ $abonnement->kit->client->email }}</td>
            </tr>
            <tr>
                <th>Date</th>
                <td>{{now()->format('D, d M Y H:i:s')}}</td>
            </tr>{{--
            <tr>
                <th>Méthode de paiement</th>
                <td class="highlight">Carte</td>
            </tr>--}}
        </table>
    </div>
    <div class="info-section">
        <h2>Produits</h2>
        <table>
            <tr class="highlight">
                <th>Numéro de kit</th>
                <th>Plan tarifaire</th>
                <th>Date de début</th>
                <th>Durée d'abonnement</th>
            </tr>
            <tr>
                <td>KIT{{ $abonnement->kit->unpay_kit->kit_number }}</td>
                <td>{{ Number::currency($abonnement->plan_tarifaire,'xaf') }}</td>
                <td>{{ $dateDebut }}</td>
                <td>{{ $dureeMois }} Mois</td>
            </tr>
        </table>
        <div class="total">Total: {{Number::currency($dureeMois*$abonnement->plan_tarifaire,'xaf')}}</div>
    </div>
    <div class="footer">
        Page 1
    </div>
</div>
</body>
</html>
