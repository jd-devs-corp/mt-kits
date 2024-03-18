<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MtKits | Accueil</title>

    <link
        rel="shortcut icon"
        {{--        href="{{asset('images/logo.png')}}"--}}
        type="image/x-icon"
    />
    <link rel="stylesheet" href="{{asset('css/animate.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/tailwind.css')}}"/>

    <!-- ==== WOW JS ==== -->
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script>
        new WOW().init();
    </script>

</head>
<body class="bg-img">


<!-- ====== Navbar Section Start -->
<nav>
    <div
        class="ud-header absolute left-0 top-0 z-40 flex w-full items-center bg-transparent"
    >
        <div class="container">
            <div class="relative -mx-4 flex items-center justify-between">
                <div class="w-60 max-w-full px-4">
                    <a href="{{url('/')}}" class="navbar-logo block w-full py-5">
                        <img
                            src="{{asset('images/logo.png')}}"
                            alt="logo"
                            class="header-logo w-full"
                        />
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- ====== Navbar Section End -->

<!-- ====== Hero Section Start -->
<div
    id="home"
    class="relative overflow-hidden  pt-[120px] md:pt-[130px] lg:pt-[160px]"
>
    <div class="container">
        <div class="-mx-4 flex flex-wrap items-center">
            <div class="w-full px-4">
                <div
                    class="hero-content wow fadeInLeft mx-auto max-w-[780px] text-center"
                    data-wow-delay=".2s"
                >
                    <h1
                        class="mb-6 text-5xl hover:text-body-color font-extrabold leading-snug sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-[1.2]"
                    >Bienvenue sur <span class="auto-type1"
                                         style="color: red;font-family: 'Poppins', sans-serif;"></span>
                    </h1>
                    <p class="mx-auto mb-9 max-w-[600px] font-medium text-5xl sm:text-lg sm:leading-[1.44]">
                    <h1 class="text-5xl">Votre plateforme de, <span class="auto-type font-extrabold"
                                                                    style="font-family: 'Poppins', sans-serif;color: darkblue"></span>
                    </h1>
                </div>
                <ul
                    class="mb-10 mt-8 flex flex-wrap items-center justify-center gap-5"
                >
                    @if ($userRole === 'admin')
                        <a
                            href="{{url('admin')}}"
                            class="inline-flex items-center justify-center rounded-md bg-white px-7 py-[14px] text-center text-base font-medium text-dark shadow-1 transition duration-300 ease-in-out hover:bg-gray-2 hover:text-body-color"
                        >
                            Accéder à ma session
                        </a>
                    @elseif ($userRole === 'fournisseur')
                        <a
                            href="{{url('supplier')}}"
                            class="inline-flex items-center justify-center rounded-md bg-white px-7 py-[14px] text-center text-base font-medium text-dark shadow-1 transition duration-300 ease-in-out hover:bg-gray-2 hover:text-body-color"
                        >
                            Accéder à ma session
                        </a>
                    @else
                        <li>
                            <a
                                href="{{url('admin')}}"
                                class="inline-flex items-center justify-center rounded-md bg-white px-7 py-[14px] text-center text-base font-medium text-dark shadow-1 transition duration-300 ease-in-out hover:bg-gray-2 hover:text-body-color"
                            >
                                Je suis administrateur
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{url('supplier')}}"
                                class="flex items-center gap-4 rounded-md bg-white/[0.12] px-6 py-[14px] text-base font-medium text-white transition duration-300 ease-in-out hover:bg-white hover:text-dark"
                            >
                                Je suis fournisseur
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </div>


    </div>
</div>

<!-- ====== Footer Section Start -->
<footer class="footer">


    <div class="relative border-[#8890A4] border-opacity-40">
        <div class="w-full flex justify-center">


                <div class="w-full px-4 md:w-1/3 lg:w-1/2 text-white ">
                    <div class="my-1 flex justify-center md:justify-center">
                        <p class="font-medium text-center" >
                           <span class="" id="copyright"><script>
                                document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                               </script></span> &copy; MtKits developpé par :
                            <a
                                href="mailto:brainforcode@gmail.com"
                                target="_blank"
                                class="hover:text-primary"
                            >
                                Brain4Code
                            </a>
                        </p>
                    </div>
            </div>
        </div>
    </div>
</footer>
<!-- ====== Footer Section End -->

<!-- Load library from the CDN -->
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

<!-- Setup and start animation! -->
<script>

    var typed = new Typed('.auto-type1', {
        strings: ['Mentalists Kits'],
        typeSpeed: 300,
        backSpeed: 100,
        loop: true
    }, new Typed('.auto-type', {
        strings: [' vente de kits de connexion',' et ', 'de reabonnements de vos kits '],
        typeSpeed: 200,
        backSpeed: 100,
        loop: true
    }));
</script>
</body>
</html>
