@component('mail::message')
    # Confirmation de Réabonnement

    Cher Client,

    Votre kit ({{ $reabonnement->kit->kit_number }}) a été réabonné avec succès.

    **Date de début:** {{ $reabonnement->date_debut_abonnement->format('d/m/Y') }}
    **Date de fin:** {{ $reabonnement->date_fin_abonnement->format('d/m/Y') }}
    **Plan tarifaire:** {{ $reabonnement->plan_tarifaire }} FCFA

    Merci,
    L'équipe [Nom de votre application]
@endcomponent
