<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-figtree font-bold mb-4">Reçu</h1>
  
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <div class="bg-white p-4 rounded-md shadow-sm">
        <h2 class="text-xl font-semibold font-figtree mb-2">Informations du client</h2>
        <p class="mb-1">Nom du propriétaire: {{ $abonnement->kit->client->name }}</p>
      </div>
  
      <div class="bg-white p-4 rounded-md shadow-sm">
        <h2 class="text-xl font-semibold font-figtree mb-2">Informations du kit</h2>
        <p class="mb-1">Numéro du kit: {{ $abonnement->kit->kit_number }}</p>
      </div>
  
      <div class="bg-white p-4 rounded-md shadow-sm">
        <h2 class="text-xl font-semibold font-figtree mb-2">Informations d'abonnement</h2>
        <p class="mb-1">Date de début: {{ $abonnement->date_abonnement }}</p>
        <p class="mb-1">Date de fin: {{ $abonnement->date_fin_abonnement }}</p>
        <p class="mb-1">Plan tarifaire: {{ $abonnement->plan_tarifaire }}</p>
      </div>
  
      @if($abonnement->kit->user)
      <div class="bg-white p-4 rounded-md shadow-sm">
        <h2 class="text-xl font-semibold font-figtree mb-2">Informations du fournisseur</h2>
        <p class="mb-1">Nom du fournisseur: {{ $abonnement->kit->user->name }}</p>
      </div>
      @endif
    </div>
  </div>
  