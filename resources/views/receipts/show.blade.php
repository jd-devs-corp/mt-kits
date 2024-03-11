<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>


    <!-- Invoice styling -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@100..800&display=swap');


        * {
            font-family: "Arial Black", sans-serif;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            text-align: center;
            color: #777;
            background: #e0e0e0;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0;
            padding-bottom: 0;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 1rem;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
<h1>Recu de confirmation</h1>
<h3>Le paiement est demandé dans les 15 jours suivant la réception de cette facture.</h3>

<div class="invoice-box">
    <table>
        <tr class="top">
            <td colspan="2">
                <table>
                    <tr>
                       {{-- <td class="title">
                            <img src="{{ public_path().'/images/logo.png'}}" alt="Company logo"
                                 style="width: 100%; max-width: 300px"/>
                        </td>--}}

                        <td class="title">
                            Facture N°: {{time()}}<br/>
                             Date: {{now()->format('D, d M Y H:i:s')}}<br/>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            Mentalists, Inc.<br/>
                            Bonamoussadi, Douala<br/>
                            mtkits@mentalists.com
                        </td>

                        <td>
                            {{ $abonnement->kit->client->name }}.<br/>
                            {{ $abonnement->kit->client->email }}.<br/>
                            {{ $abonnement->kit->client->phone }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>


        {{--<tr class="heading">
            <td>Domaine</td>

            <td>Caractéristique</td>
        </tr>--}}

        <tr class="item">
            <td> Date de debut</td>

            <td>{{ $abonnement->date_abonnement }}</td>
        </tr>

        <tr class="item">
            <td>Date de fin</td>

            <td>{{ $abonnement->date_fin_abonnement }}</td>
        </tr>
        <tr class="total">
            <td></td>

            <td>Total: {{ $abonnement->plan_tarifaire }} FCFA</td>
        </tr>
    </table>
</div>
</body>
</html>

