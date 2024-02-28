<div>
    <input type="hidden" name="" {{$record = $getRecord();}}>
    <input type="hidden" name="" {{$dateFinAbonnement = strtotime($record->date_fin_abonnement);}}>
        <input type="hidden" name="" {{$now = strtotime(now());}}>

            @if($dateFinAbonnement < $now)

                    <div style="background-color:rgb(247, 76, 76)">Expire
                    </div>

            @elseif($dateFinAbonnement - $now < 14 * 24 * 60 * 60)

                <div style="background-color: rgb(252, 252, 101);">Warning</div>

            @else
            {{-- {{$dateFinAbonnement}}
            {{$now}} --}}
                <div class="badge" style="background-color:rgb(88, 173, 88);">Valide</div>

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
