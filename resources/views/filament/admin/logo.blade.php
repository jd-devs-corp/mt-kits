<style>
    img.logo {
        width: 300%;
        height: 300%;
    }

    img.logo:hover {
        animation: ease-in-out;

    }
</style>
@if (request()->is('admin/login')||request()->is('admin/email-verification/prompt')||request()->is('admin/register') || request()->isMethod('post')||request()->is('admin/two-factor-authentication') |request()->is('admin/password-reset/request'))
@else
    <!-- Code pour afficher le logo de la marque -->
    <img class="logo" src="{{asset('images/logo_admin.png')}}" title="logo administrateur" alt="Logo administrateur">
@endif

