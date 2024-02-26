<style>
    img.logo {
        width: 8vw;
        height: 9vh;
    }
</style>
@if (request()->is('admin/login'))
@else
    <!-- Code pour afficher le logo de la marque -->
    <img class="logo" src="{{asset('images/logo_admin.png')}}" alt="logo administrateur">
@endif

