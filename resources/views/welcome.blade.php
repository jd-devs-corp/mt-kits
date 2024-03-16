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
</div>
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
                        class="mb-6 text-3xl hover:text-body-color font-bold leading-snug sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-[1.2]"
                    >
                        Bienvenue sur MtKits
                    </h1>
                    <p
                        class="mx-auto mb-9 max-w-[600px] text-base font-medium text-gray-600 sm:text-lg sm:leading-[1.44]"
                    >
                        Votre plateforme de gestion de stock, de vente de kits de connexion starlink .
                    </p>
                    <ul
                        class="mb-10 flex flex-wrap items-center justify-center gap-5"
                    >
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
                    </ul>
                </div>
            </div>


        </div>
    </div>
</div>

<script src="{{asset('js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
<script>
    // ==== for menu scroll
    const pageLink = document.querySelectorAll(".ud-menu-scroll");

    pageLink.forEach((elem) => {
        elem.addEventListener("click", (e) => {
            e.preventDefault();
            document.querySelector(elem.getAttribute("href")).scrollIntoView({
                behavior: "smooth",
                offsetTop: 1 - 60,
            });
        });
    });

    // section menu active
    function onScroll(event) {
        const sections = document.querySelectorAll(".ud-menu-scroll");
        const scrollPos =
            window.pageYOffset ||
            document.documentElement.scrollTop ||
            document.body.scrollTop;

        for (let i = 0; i < sections.length; i++) {
            const currLink = sections[i];
            const val = currLink.getAttribute("href");
            const refElement = document.querySelector(val);
            const scrollTopMinus = scrollPos + 73;
            if (
                refElement.offsetTop <= scrollTopMinus &&
                refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
            ) {
                document
                    .querySelector(".ud-menu-scroll")
                    .classList.remove("active");
                currLink.classList.add("active");
            } else {
                currLink.classList.remove("active");
            }
        }
    }

    window.document.addEventListener("scroll", onScroll);

    // Testimonial
    const testimonialSwiper = new Swiper(".testimonial-carousel", {
        slidesPerView: 1,
        spaceBetween: 30,

        // Navigation arrows
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
</script>
</body>
</html>
