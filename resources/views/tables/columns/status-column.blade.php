<div>
    <input type="hidden" name="" value="{{$record = $getRecord()}}">
    <input type="hidden" name="" value="{{$now = strtotime(now())}}">

    @if ($record->date_fin_abonnement)
        <input type="hidden" name="" value="{{$dateFinAbonnement = strtotime($record->date_fin_abonnement)}}">
        @if($dateFinAbonnement < $now)

            <div class="badge" style="background-color: rgb(247, 76, 76)">
                Expiré
            </div>

        @elseif($dateFinAbonnement - $now < 14 * 24 * 60 * 60)

            <div class="badge" style="background-color: rgb(252, 252, 101)">
                Attention
            </div>

        @else

            <div class="badge" style="background-color: rgb(88, 173, 88)">
                Valide
            </div>

        @endif
    @else
            <input type='hidden' {{$i = 0}}>
            @foreach ($record->reabonnements as $reabonnement)
            <input type='hidden' {{$i++}}>
            @endforeach

        <input type="hidden" name="" value="{{$dateFinAbonnement = strtotime($record->reabonnements[$i-1]['date_fin_abonnement'])}}">
        @if($dateFinAbonnement < $now)

            <div class="badge" style="background-color: rgb(247, 76, 76)">
                Expiré
            </div>

        @elseif($dateFinAbonnement - $now < 14 * 24 * 60 * 60)

            <div class="badge" style="background-color: rgb(252, 252, 101)">
                Attention
            </div>

        @else

            <div class="badge" style="background-color: rgb(88, 173, 88)">
                Valide
            </div>

        @endif
    @endif

</div>
<style>
    .badge{
        font-size:75%;
        line-height:1;
        text-align:center;
        color: white ;
        white-space:nowrap;
        vertical-align: baseline;
        border-radius: 15px 15px 15px 15px ;
        text-transform: uppercase;
        min-width: 50px;
        padding:12px;
    }
</style>
