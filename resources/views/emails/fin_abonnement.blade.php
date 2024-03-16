<table style="background-color: #F3F4F6; padding: 0; margin: 0; width: 100%;" cellspacing="0" cellpadding="0">
    <tbody>
    <tr>
        <td style="max-width: 30rem; margin: auto; background-color: #ffffff; padding: 2rem; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); border-radius: 0.5rem;">
            <table style="width: 100%;" cellspacing="0" cellpadding="0">
                <tbody>
                <tr>
                    <td style="text-align: center;">

                        <img src="{{ $message->embed(public_path().'/images/logo.png')}}" alt="MTKits"
                             style="margin: auto auto 1rem;max-width: 100%; height: auto;">
                        <h1 style="font-size: 5rem;font-family: 'Sora', sans-serif; font-weight: bold; margin-bottom: 0.5rem;">
                            Votre abonnement est sur le point d'expirer</h1>
                        <p style="color: #4B5563;font-size: 2rem;font-family: 'Arial Black', sans-serif">Veuillez renouveler votre abonnement avant le
                            <b>{{ $dateSeule }}</b> à <b>{{$heureMinute}}</b>, pour eviter toute interruption.</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
