<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="MtKits | Mentalits Kits">
    <meta name="theme-color" content="#e23725">
    <meta name="description" content="MTKITS: Une solution complète pour la gestion de Starlink

MTKITS est une interface intuitive qui centralise la gestion de vos kits de connexion Starlink.

Avec MTKITS, vous pouvez:

Acheter: Passez commande et recevez vos kits Starlink directement.
Gérer: Suivez l'état de vos kits, activez/désactivez des services et rechargez vos crédits.
Reabonner: Renouvelez vos abonnements en toute simplicité et profitez de forfaits adaptés à vos besoins.
Vendre: Devenez revendeur agréé Starlink et proposez des kits à vos clients.

MTKITS s'adapte aux besoins des particuliers, des entreprises et des professionnels. Outil puissant et convivial, MTKITS vous permet de profiter pleinement de votre connexion Starlink.
">

    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('images/site.webmanifest')}}">
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
<body>

<div class="bg-img">
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
                                             style="color: #e23725;font-family: 'Poppins', sans-serif;"></span>
                        </h1>
                        <p class="mx-auto mb-9 max-w-[600px] font-medium text-5xl sm:text-lg sm:leading-[1.44]">
                        <h1 class="text-5xl">La plateforme de, <span class="auto-type font-extrabold"
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
                                    href="{{url('supplier')}}"
                                    class="inline-flex items-center justify-center rounded-md bg-white px-7 py-[14px] text-center text-base font-medium text-dark shadow-1 transition duration-300 ease-in-out hover:bg-gray-2 hover:text-body-color"
                                >
                                    Je suis fournisseur
                                </a>
                            </li>
                            <li>
                                <a
                                    href="{{url('admin')}}"
                                    class="flex items-center gap-4 rounded-md bg-white/[0.12] px-6 py-[14px] text-base font-medium text-white transition duration-300 ease-in-out hover:bg-white hover:text-dark"
                                >
                                    Je suis administrateur
                                </a>
                            </li>
                        @endif

                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- ====== Services Section Start -->
<section class="pb-8 pt-20 dark:bg-dark lg:pb-[70px] lg:pt-[120px]">
    <div class="container">
        <div class="-mx-4 flex flex-wrap">
            <div class="w-full px-4">
                <div class="mx-auto mb-12 max-w-[485px] text-center lg:mb-[70px]">
              <span class="mb-2 block text-lg font-semibold text-primary">
                C'est quoi starlink ?
              </span>
                    <h2
                        class="mb-3 text-3xl font-bold text-dark dark:text-white sm:text-4xl md:text-[40px] md:leading-[1.2]"
                    >
                        Avec la technologie starlink, vous pouvez :
                    </h2>
                    <p class="text-base text-body-color dark:text-dark-6">
                        Starlink est une technologie révolutionnaire qui a le potentiel de changer la façon dont nous
                        vivons, travaillons et communiquons.
                    </p>
                </div>
            </div>
        </div>
        <div class="-mx-4 flex flex-wrap">
            <div class="text-center sm:flex justify-center w-full px-4 md:w-1/2 lg:w-1/4">
                <div class="wow fadeInUp group mb-12" data-wow-delay=".1s">
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                <span
                    class="absolute left-0 top-0 -z-[1] mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary bg-opacity-20 duration-300 group-hover:rotate-45"
                ></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418"/>
                        </svg>

                    </div>
                    <h4 class="mb-3 text-xl font-bold text-dark dark:text-white text-center">
                        Internet haut débit
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9 text-center">
                        Accès rapide et fiable<br>
                        Couverture mondiale<br>
                        Parfait pour les zones rurales
                    </p>

                </div>
            </div>
            <div class="sm:flex justify-center w-full px-4 md:w-1/2 lg:w-1/4">
                <div class="wow fadeInUp group mb-12" data-wow-delay=".15s">
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                <span
                    class="absolute left-0 top-0 -z-[1] mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary bg-opacity-20 duration-300 group-hover:rotate-45"
                ></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z"/>
                        </svg>

                    </div>
                    <h4 class="mb-3 text-xl font-bold text-dark dark:text-whit text-centere">
                        Streaming et jeux vidéo
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9 text-center">
                        Faible latence pour une expérience fluide<br>
                        Streaming vidéo HD sans interruption<br>
                        Jeux en ligne sans décalage
                    </p>
                </div>
            </div>
            <div class="sm:flex justify-center w-full px-4 md:w-1/2 lg:w-1/4">
                <div class="wow fadeInUp group mb-12" data-wow-delay=".2s">
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                <span
                    class="absolute left-0 top-0 -z-[1] mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary bg-opacity-20 duration-300 group-hover:rotate-45"
                ></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                        </svg>

                    </div>
                    <h4 class="mb-3 text-xl font-bold text-dark dark:text-white text-center">
                        Téléphonie et visioconférence
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9 text-center">
                        Appels clairs et vidéo fluide<br>
                        Connexion stable même en zone rurale<br>
                        Idéal pour rester connecté
                    </p>
                </div>
            </div>
            <div class="sm:flex justify-center w-full px-4 md:w-1/2 lg:w-1/4">
                <div class="wow fadeInUp group mb-12" data-wow-delay=".25s">
                    <div
                        class="relative z-10 mb-10 flex h-[70px] w-[70px] items-center justify-center rounded-[14px] bg-primary"
                    >
                <span
                    class="absolute left-0 top-0 -z-[1] mb-8 flex h-[70px] w-[70px] rotate-[25deg] items-center justify-center rounded-[14px] bg-primary bg-opacity-20 duration-300 group-hover:rotate-45"
                ></span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/>
                        </svg>

                    </div>
                    <h4 class="mb-3 text-xl font-bold text-dark dark:text-white text-center">
                        Education et urgence
                    </h4>
                    <p class="mb-8 text-body-color dark:text-dark-6 lg:mb-9 text-center">
                        Education à distance de qualité<br>
                        Accès internet en cas de catastrophe<br>
                        Aide aux interventions d'urgence
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- ====== Services Section End -->

<!-- ====== Footer Section Start -->
<footer class="footer">


    <div class="relative border-[#8890A4] border-opacity-40">
        <div class="w-full flex justify-center">


            <div class="w-full px-4 md:w-1/3 lg:w-1/2 text-white ">
                <div class="my-1 flex justify-center md:justify-center">
                    <p class="font-medium text-center">
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
        strings: [' vente de kits de connexion', ' et ', 'de reabonnements de vos kits '],
        typeSpeed: 200,
        backSpeed: 100,
        loop: true
    }));
</script>
</body>
</html>
