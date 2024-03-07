<!-- resources/views/emails/email.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mentalits Kits</title>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body class="bg-gray-100">
<div class="max-w-2xl mx-auto p-8 bg-white shadow-lg rounded-lg">
    <div class="text-center">
        <img src="{{asset('images/logo_admin.png')}}" alt="Logo de votre application" class="mx-auto mb-4">
        <h1 class="text-2xl font-bold mb-2">Votre abonnement est sur le point d'expirer</h1>
        <p class="text-gray-700">Veuillez renouveler votre abonnement avant le <b>{{ $dateFinAbonnement }}</b>, pour eviter toute
            interruption.</p>

    </div>
</div>
</body>
</html>
