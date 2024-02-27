
<style>
    img.logo{
        width: 8vw;
        height: 8vh;
    }
</style>
@if (request()->is('supplier/login'))

@else
    <!-- Code pour afficher le logo de la marque -->
    <img class="logo" src="{{asset('images/logo_supplier.png')}}" alt="logo administrateur" >
@endif
