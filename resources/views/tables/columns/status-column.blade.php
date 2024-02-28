<div>
    <input type="hidden" name="" {{$record = $getRecord();}}>
    <input type="hidden" name="" {{$now = strtotime(now());}}>
    @if ($record->date_fin_abonnement)
        
        <input type="hidden" name="" {{$dateFinAbonnement = strtotime($record->date_fin_abonnement);}}>

            @if($dateFinAbonnement < $now)     
            <div class='badge' style="background-color:rgb(247, 76, 76)">Expire
                    </div>
                    
            @elseif($dateFinAbonnement - $now < 14 * 24 * 60 * 60)

                <div class="badge" style="background-color: rgb(172, 172, 70);">Warning</div>

            @else
            
            
            <div class="badge" style="background-color:rgb(88, 173, 88);">Valide</div>
            
            @endif
    @else

    <input type="hidden" name="" {{$dateFinAbonnement = strtotime($record->reabonnements[0]["date_fin_abonnement"]);}}>
    @if($dateFinAbonnement < $now)     
            <div class='badge' style="background-color:rgb(247, 76, 76)">Expire
                    </div>
                    
            @elseif($dateFinAbonnement - $now < 14 * 24 * 60 * 60)

                <div class="badge" style="background-color: rgb(172, 172, 70);">Warning</div>

            @else
            
            
            <div class="badge" style="background-color:rgb(88, 173, 88);">Valide</div>
            
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
