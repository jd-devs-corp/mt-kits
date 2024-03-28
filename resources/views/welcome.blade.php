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
    {{--    @vite('resources/css/app.css')--}}
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
                    <div class="flex w-full items-center justify-between px-4">
                        <div>
                            <button
                                id="navbarToggler"
                                class="absolute right-4 top-1/2 block -translate-y-1/2 rounded-lg px-3 py-[6px] ring-primary focus:ring-2 lg:hidden"
                            >
                <span
                    class="relative my-[6px] block h-[2px] w-[30px] bg-white"
                ></span>
                                <span
                                    class="relative my-[6px] block h-[2px] w-[30px] bg-white"
                                ></span>
                                <span
                                    class="relative my-[6px] block h-[2px] w-[30px] bg-white"
                                ></span>
                            </button>
                            <nav
                                id="navbarCollapse"
                                class="absolute right-4 top-full hidden w-full max-w-[250px] rounded-lg bg-white py-5 shadow-lg dark:bg-dark-2 lg:static lg:block lg:w-full lg:max-w-full lg:bg-transparent lg:px-4 lg:py-0 lg:shadow-none dark:lg:bg-transparent xl:px-6"
                            >
                                <ul class="blcok  2xl:ml-20 lg:hidden">
                                    @if ($userRole === 'admin')
                                        <li class="group relative">
                                            <a class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70"
                                               href="{{url('admin')}}"
                                            >
                                                Accéder à ma session
                                            </a></li>

                                    @elseif ($userRole === 'fournisseur')
                                        <li class="group relative">
                                            <a class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70"
                                               href="{{url('supplier')}}"
                                            >
                                                Accéder à ma session
                                            </a></li>
                                    @else
                                        <li class="group relative">
                                            <a class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70"
                                               href="{{url('supplier')}}"
                                            >
                                                Je suis fournisseur
                                            </a>
                                        </li>
                                        <li class="group relative">
                                            <a class="ud-menu-scroll mx-8 flex py-2 text-base font-medium text-dark group-hover:text-primary dark:text-white lg:mr-0 lg:inline-flex lg:px-0 lg:py-6 lg:text-white lg:group-hover:text-white lg:group-hover:opacity-70"
                                               href="{{url('admin')}}"
                                            >
                                                Je suis administrateur
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                        <div class="flex items-center justify-end pr-16 lg:pr-0">
                            <label
                                for="themeSwitcher"
                                class="inline-flex cursor-pointer items-center"
                                aria-label="themeSwitcher"
                                name="themeSwitcher"
                            >
                                <input
                                    type="checkbox"
                                    name="themeSwitcher"
                                    id="themeSwitcher"
                                    class="sr-only"
                                />
                                <span class="block dark:hidden">
                  <svg
                      class="fill-current text-dark"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                        d="M13.3125 1.50001C12.675 1.31251 12.0375 1.16251 11.3625 1.05001C10.875 0.975006 10.35 1.23751 10.1625 1.68751C9.93751 2.13751 10.05 2.70001 10.425 3.00001C13.0875 5.47501 14.0625 9.11251 12.975 12.525C11.775 16.3125 8.25001 18.975 4.16251 19.0875C3.63751 19.0875 3.22501 19.425 3.07501 19.9125C2.92501 20.4 3.15001 20.925 3.56251 21.1875C4.50001 21.75 5.43751 22.2 6.37501 22.5C7.46251 22.8375 8.58751 22.9875 9.71251 22.9875C11.625 22.9875 13.5 22.5 15.1875 21.5625C17.85 20.1 19.725 17.7375 20.55 14.8875C22.1625 9.26251 18.975 3.37501 13.3125 1.50001ZM18.9375 14.4C18.2625 16.8375 16.6125 18.825 14.4 20.0625C12.075 21.3375 9.41251 21.6 6.90001 20.85C6.63751 20.775 6.33751 20.6625 6.07501 20.55C10.05 19.7625 13.35 16.9125 14.5875 13.0125C15.675 9.56251 15 5.92501 12.7875 3.07501C17.5875 4.68751 20.2875 9.67501 18.9375 14.4Z"
                    />
                  </svg>
                </span>
                                <span class="hidden text-white dark:block">
                  <svg
                      class="fill-current"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                  >
                    <g clip-path="url(#clip0_2172_3070)">
                      <path
                          d="M12 6.89999C9.18752 6.89999 6.90002 9.18749 6.90002 12C6.90002 14.8125 9.18752 17.1 12 17.1C14.8125 17.1 17.1 14.8125 17.1 12C17.1 9.18749 14.8125 6.89999 12 6.89999ZM12 15.4125C10.125 15.4125 8.58752 13.875 8.58752 12C8.58752 10.125 10.125 8.58749 12 8.58749C13.875 8.58749 15.4125 10.125 15.4125 12C15.4125 13.875 13.875 15.4125 12 15.4125Z"
                      />
                      <path
                          d="M12 4.2375C12.45 4.2375 12.8625 3.8625 12.8625 3.375V1.5C12.8625 1.05 12.4875 0.637497 12 0.637497C11.55 0.637497 11.1375 1.0125 11.1375 1.5V3.4125C11.175 3.8625 11.55 4.2375 12 4.2375Z"
                      />
                      <path
                          d="M12 19.7625C11.55 19.7625 11.1375 20.1375 11.1375 20.625V22.5C11.1375 22.95 11.5125 23.3625 12 23.3625C12.45 23.3625 12.8625 22.9875 12.8625 22.5V20.5875C12.8625 20.1375 12.45 19.7625 12 19.7625Z"
                      />
                      <path
                          d="M18.1125 6.74999C18.3375 6.74999 18.5625 6.67499 18.7125 6.48749L19.9125 5.28749C20.25 4.94999 20.25 4.42499 19.9125 4.08749C19.575 3.74999 19.05 3.74999 18.7125 4.08749L17.5125 5.28749C17.175 5.62499 17.175 6.14999 17.5125 6.48749C17.6625 6.67499 17.8875 6.74999 18.1125 6.74999Z"
                      />
                      <path
                          d="M5.32501 17.5125L4.12501 18.675C3.78751 19.0125 3.78751 19.5375 4.12501 19.875C4.27501 20.025 4.50001 20.1375 4.72501 20.1375C4.95001 20.1375 5.17501 20.0625 5.32501 19.875L6.52501 18.675C6.86251 18.3375 6.86251 17.8125 6.52501 17.475C6.18751 17.175 5.62501 17.175 5.32501 17.5125Z"
                      />
                      <path
                          d="M22.5 11.175H20.5875C20.1375 11.175 19.725 11.55 19.725 12.0375C19.725 12.4875 20.1 12.9 20.5875 12.9H22.5C22.95 12.9 23.3625 12.525 23.3625 12.0375C23.3625 11.55 22.95 11.175 22.5 11.175Z"
                      />
                      <path
                          d="M4.23751 12C4.23751 11.55 3.86251 11.1375 3.37501 11.1375H1.50001C1.05001 11.1375 0.637512 11.5125 0.637512 12C0.637512 12.45 1.01251 12.8625 1.50001 12.8625H3.41251C3.86251 12.8625 4.23751 12.45 4.23751 12Z"
                      />
                      <path
                          d="M18.675 17.5125C18.3375 17.175 17.8125 17.175 17.475 17.5125C17.1375 17.85 17.1375 18.375 17.475 18.7125L18.675 19.9125C18.825 20.0625 19.05 20.175 19.275 20.175C19.5 20.175 19.725 20.1 19.875 19.9125C20.2125 19.575 20.2125 19.05 19.875 18.7125L18.675 17.5125Z"
                      />
                      <path
                          d="M5.32501 4.125C4.98751 3.7875 4.46251 3.7875 4.12501 4.125C3.78751 4.4625 3.78751 4.9875 4.12501 5.325L5.32501 6.525C5.47501 6.675 5.70001 6.7875 5.92501 6.7875C6.15001 6.7875 6.37501 6.7125 6.52501 6.525C6.86251 6.1875 6.86251 5.6625 6.52501 5.325L5.32501 4.125Z"
                      />
                    </g>
                    <defs>
                      <clipPath id="clip0_2172_3070">
                        <rect width="24" height="24" fill="white"/>
                      </clipPath>
                    </defs>
                  </svg>
                </span>
                            </label>
                            <div class="sm:hidden sd:hidden  lg:flex">
                                @if ($userRole === 'admin')
                                    <a
                                        href="/admin"
                                        class="loginBtn px-[22px] py-2 text-base font-medium text-white hover:opacity-70"
                                    >
                                        Mon compte
                                    </a>
                                @elseif($userRole==='fournisseur')
                                    <a
                                        href="/supplier"
                                        class="loginBtn px-[22px] py-2 text-base font-medium text-white hover:opacity-70"
                                    >
                                        Mon compte
                                    </a>
                                @else

                                    <a
                                        href="/admin"
                                        class="loginBtn px-[22px] py-2 text-base font-medium text-white hover:opacity-70"
                                    >
                                        Administrateur
                                    </a>
                                    <a
                                        href="/supplier"
                                        class="loginBtn px-[22px] py-2 text-base font-medium text-white hover:opacity-70"
                                    >
                                        Fournisseur
                                    </a>
                                @endif
                            </div>
                        </div>
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
                            class="mb-6 dark:text-white text-5xl font-extrabold leading-snug sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-[1.2]"
                        >Bienvenue sur <span class="auto-type1"
                                             style="color: #e23725;font-family: 'Poppins', sans-serif;"></span>
                        </h1>
                        <p class="mx-auto mb-9 max-w-[600px] font-medium text-5xl sm:text-lg sm:leading-[1.44]">
                        <h1 class="text-5xl dark:text-white">La plateforme <span class="auto-type font-extrabold"
                                                                                 style="font-family: 'Poppins', sans-serif;color: darkblue"></span>
                        </h1>
                    </div>
                    <ul
                        class="mb-10 mt-8 flex flex-wrap items-center justify-center gap-5"
                    >


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
                             stroke="currentColor" class="w-6 h-6 svg">
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
                             stroke="currentColor" class="w-6 h-6 svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z"/>
                        </svg>

                    </div>
                    <h4 class="mb-3 text-xl font-bold text-dark dark:text-white text-center">
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
                             stroke="currentColor" class="w-6 h-6 svg">
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
                             stroke="currentColor" class="w-6 h-6 svg">
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
<!-- ====== Contact Start ====== -->
<section id="contact" class="relative py-20 md:py-[120px]">
    <div
        class="absolute left-0 top-0 -z-[1] h-full w-full dark:bg-dark"
    ></div>
    <div
        class="absolute left-0 top-0 -z-[1] h-1/2 w-full  dark:bg-dark-700 lg:h-[45%] xl:h-1/2"
        style="background-color: #57667e"
    ></div>
    <div class="container px-4">
        <div class="-mx-4 flex flex-wrap items-center">
            <div class="w-full px-4 lg:w-7/12 xl:w-8/12">
                <div class="ud-contact-content-wrapper">
                    <div class="ud-contact-title mb-12 lg:mb-[150px]">
                <span
                    class="mb-6 block text-base font-medium text-dark dark:text-white"
                >
                  CONTACTEZ-NOUS
                </span>
                        <h2
                            class="max-w-[260px] text-[35px] font-semibold leading-[1.14] text-dark dark:text-white"
                        >
                            Parlons de votre problème.
                        </h2>
                    </div>
                    <div class="mb-12 flex flex-wrap justify-between lg:mb-0">
                        <div class="mb-8 flex w-[330px] max-w-full">
                            <div class="mr-6 text-[32px] text-primary">
                                <svg
                                    width="29"
                                    height="35"
                                    viewBox="0 0 29 35"
                                    class="fill-current text-dark dark:text-white"
                                >
                                    <path
                                        d="M14.5 0.710938C6.89844 0.710938 0.664062 6.72656 0.664062 14.0547C0.664062 19.9062 9.03125 29.5859 12.6406 33.5234C13.1328 34.0703 13.7891 34.3437 14.5 34.3437C15.2109 34.3437 15.8672 34.0703 16.3594 33.5234C19.9688 29.6406 28.3359 19.9062 28.3359 14.0547C28.3359 6.67188 22.1016 0.710938 14.5 0.710938ZM14.9375 32.2109C14.6641 32.4844 14.2812 32.4844 14.0625 32.2109C11.3828 29.3125 2.57812 19.3594 2.57812 14.0547C2.57812 7.71094 7.9375 2.625 14.5 2.625C21.0625 2.625 26.4219 7.76562 26.4219 14.0547C26.4219 19.3594 17.6172 29.2578 14.9375 32.2109Z"
                                    />
                                    <path
                                        d="M14.5 8.58594C11.2734 8.58594 8.59375 11.2109 8.59375 14.4922C8.59375 17.7188 11.2187 20.3984 14.5 20.3984C17.7812 20.3984 20.4062 17.7734 20.4062 14.4922C20.4062 11.2109 17.7266 8.58594 14.5 8.58594ZM14.5 18.4297C12.3125 18.4297 10.5078 16.625 10.5078 14.4375C10.5078 12.25 12.3125 10.4453 14.5 10.4453C16.6875 10.4453 18.4922 12.25 18.4922 14.4375C18.4922 16.625 16.6875 18.4297 14.5 18.4297Z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <h5
                                    class="mb-[18px] text-lg font-semibold text-dark dark:text-white"
                                >
                                    Notre localisantion
                                </h5>
                                <p class="text-base text-body-color dark:text-dark-6">
                                    Mentalits agence créative, Bonamoussadi, Douala, Cameroun
                                </p>
                            </div>
                        </div>
                        <div class="mb-8 flex w-[330px] max-w-full">
                            <div class="mr-6 text-[32px] text-primary">
                                <svg
                                    width="34"
                                    height="25"
                                    viewBox="0 0 34 25"
                                    class="fill-current text-dark dark:text-white"
                                >
                                    <path
                                        d="M30.5156 0.960938H3.17188C1.42188 0.960938 0 2.38281 0 4.13281V20.9219C0 22.6719 1.42188 24.0938 3.17188 24.0938H30.5156C32.2656 24.0938 33.6875 22.6719 33.6875 20.9219V4.13281C33.6875 2.38281 32.2656 0.960938 30.5156 0.960938ZM30.5156 2.875C30.7891 2.875 31.0078 2.92969 31.2266 3.09375L17.6094 11.3516C17.1172 11.625 16.5703 11.625 16.0781 11.3516L2.46094 3.09375C2.67969 2.98438 2.89844 2.875 3.17188 2.875H30.5156ZM30.5156 22.125H3.17188C2.51562 22.125 1.91406 21.5781 1.91406 20.8672V5.00781L15.0391 12.9922C15.5859 13.3203 16.1875 13.4844 16.7891 13.4844C17.3906 13.4844 17.9922 13.3203 18.5391 12.9922L31.6641 5.00781V20.8672C31.7734 21.5781 31.1719 22.125 30.5156 22.125Z"
                                    />
                                </svg>
                            </div>
                            <div>
                                <h5
                                    class="mb-[18px] text-lg font-semibold text-dark dark:text-white"
                                >
                                    Comment pouvons-nous vous aider ?
                                </h5>
                                <p class="text-base text-body-color dark:text-dark-6">
                                    info@mtkits.evenafro.ca
                                </p>
                                <p class="mt-1 text-base text-body-color dark:text-dark-6">
                                    contact@mtkits.evenafro.ca
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-4 lg:w-5/12 xl:w-4/12">

                <iframe class="w-full lg:h-[400px]"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d994.9118061534036!2d9.743522888242978!3d4.0920152648863555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x10610d0018a14141%3A0x6bd4b06afb045373!2sMentalist!5e0!3m2!1sen!2see!4v1711646103573!5m2!1sen!2see"  style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>

            </div>
        </div>
    </div>
</section>
<!-- ====== Contact End ====== -->

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
<!-- ====== Back To Top Start -->
<a
    href="javascript:void(0)"
    class="back-to-top fixed bottom-8 left-auto right-8 z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark"
>
      <span
          class="mt-[6px] h-3 w-3 rotate-45 border-l border-t border-white"
      ></span>
</a>
<!-- ====== Back To Top End -->
<!-- ====== Made With Button Start -->
<a
    target="_blank"
    rel="nofollow noopener"
    class="fixed bottom-8 left-4 z-[999] inline-flex items-center gap-[10px] rounded-lg bg-white px-[14px] py-2 shadow-2 dark:bg-dark-2 sm:left-9"
    href="mailto:brainforcode@gmail.com"
>
      <span class="text-base font-medium text-dark-3 dark:text-dark-6">
        Made by
      </span>
    <span class="block h-4 w-px bg-stroke dark:bg-dark-3"></span>
    <span class="block w-full max-w-[88px]">
        <img
            src="{{asset('images/b4c.png')}}"
            alt="tailgrids"
            class="dark:hidden"
        />
        <img
            src="{{asset('images/b4c.png')}}"
            alt="tailgrids"
            class="hidden dark:block"
        />
      </span>
</a>
<!-- ====== Made With Button End -->

<!-- Load library from the CDN -->
<script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
<script src="{{asset('js/main.js')}}"></script>
<!-- Setup and start animation! -->
<script>

    var typed = new Typed('.auto-type1', {
        strings: ['Mentalists Kits'],
        typeSpeed: 500,
        backSpeed: 400,
        loop: true
    }, new Typed('.auto-type', {
        strings: ['de vente de kits de connexion', ' et ', 'de reabonnements de vos kits'],
        typeSpeed: 200,
        backSpeed: 100,
        loop: true
    }));
</script>
</body>
</html>
