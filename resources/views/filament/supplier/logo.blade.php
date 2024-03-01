
<style>
    img.logo{
        width: 300%;
        height: 300%;
    }
</style>
@if (request()->is('supplier/login') || request()->isMethod('post'))

@else
    <!-- Code pour afficher le logo de la marque -->
    <img class="logo" src="{{asset('images/logo_supplier.png')}}" alt="logo administrateur" >
@endif
