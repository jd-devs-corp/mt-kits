<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Réçu</title>
    <link rel="shortcut icon" href="{{ public_path('images/logo_admin.png') }}" type="image/x-icon">
    <style>
       @font-face {
            font-family: 'Sora';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Sora.ttf') }}) format('truetype');
        } @font-face {
            font-family: 'Montserrat';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Montserrat.ttf') }}) format('truetype');
        }
        @font-face {
            font-family: 'Montserrat Italic';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Montserrat-Italic.ttf') }}) format('truetype');
        }

        @font-face {
            font-family: 'Poppins';
            font-weight: normal;
            font-style: normal;
            font-variant: normal;
            src: url({{ storage_path('fonts/Poppins-Regular.ttf') }}) format('truetype');
        }
body{
    font-family: "Sora",sans-serif;
}
    </style>
<link rel="stylesheet" href="{{ public_path('pdf.css') }}" type="text/css">
</head>
<body>
<table class="w-full">
    <tr>
        <td class="w-half">
            <img src="{{ public_path('images/logo_supplier_dark.png') }}" alt="laravel daily" width="200" />
        </td>
        <td class="w-half">
            <h2>Paiement ID: {{time()}}</h2>
        </td>
    </tr>
</table>

<div class="margin-top">
    <table class="w-full">
        <tr>
            <td class="w-half">
                <div><h4>Client:</h4></div>
                <div>{{ $abonnement->kit->client->name }}</div>
                <div>{{ $abonnement->kit->client->email }}</div>
                <div>{{ now()->translatedFormat('d M Y') }}
                </div>
            </td>
            <td class="w-half">
                <div><h4>Nous:</h4></div>
                <div>Mentalists</div>
                <div>Bonamoussadi, Douala</div>
            </td>
        </tr>
    </table>
</div>

<div class="margin-top">
    <table class="products">
        <tr>
            <th>Numéro de kit</th>
            <th>Plan tarifaire</th>
            <th>Date d'abonnement</th>
            <th>Durée d'abonnement</th>
        </tr>
        <tr class="items">
                <td>
                    KIT{{ $abonnement->kit->unpay_kit->kit_number }}
                </td>
                <td>
                    {{ Number::currency($abonnement->plan_tarifaire,'xaf','de') }}
                </td>
                <td>
                    {{ $dateDebut }}
                </td>
                <td>
                    {{ $dureeMois }} Mois
                </td>
        </tr>
    </table>
</div>

<div class="total">
    Total: {{Number::currency($dureeMois*$abonnement->plan_tarifaire,'xaf','de')}}
</div>

<div class="footer margin-top">
    <div>Thank you</div>
    <div>&copy; <a href="https://www.mentalists.ca">Mentalits</a></div>
</div>
</body>
</html>
