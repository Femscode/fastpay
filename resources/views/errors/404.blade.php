<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Fastpay | CT_Taste</title>
    <meta charset="utf-8" />
    <meta name="description" content="Payment Portal For CT_Taste" />
    <meta name="keywords" content="Quick pay with CT_Taste" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="CT_Taste" />
    <meta property="og:url" content="https://cttaste.com" />
    <meta property="og:site_name" content="CT_Taste" />
    <link rel="shortcut icon" href="assets/media/logos/fav_01.png" />


    <link rel="stylesheet" href="assets/googlefonts/inter.css" />
    <!--end::Fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet"> --}}
    <link href="assets/googlefonts/ubuntu.css" rel="stylesheet">

    @laravelPWA

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <style>
        #fixedbutton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            height: 50px;
            width: 50px;
        }
    </style>


</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" class="bg-white position-relative app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
	var themeMode;

	if ( document.documentElement ) {
		if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
			themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
		} else {
			if ( localStorage.getItem("data-bs-theme") !== null ) {
				themeMode = localStorage.getItem("data-bs-theme");
			} else {
				themeMode = defaultThemeMode;
			}			
		}

		if (themeMode === "system") {
			themeMode = window.matchMedia("(prefers-color-scheme: light)").matches ? "light" : "light";
		}

		document.documentElement.setAttribute("data-bs-theme", themeMode);
	}            
    </script>
    <!--end::Theme mode setup on page load-->
    <!--Begin::Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!--End::Google Tag Manager (noscript) -->

    <!--begin::Root-->
    <div style='background:#ebebeb' class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Header Section-->
        <div class="mb-0" id="home">
            <!--begin::Wrapper-->
            <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-light-bg"
                style="background-image: url(assets/media/logos/fastpay_bg.jpg);background-size:cover;">
                <!--begin::Header-->
                <div style='padding:10px' class="landing-header" data-kt-sticky="true"
                    data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">

                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center justify-content-between">
                            <!--begin::Logo-->
                            <div class="d-flex align-items-center flex-equal">
                                <!--begin::Mobile menu toggle-->
                                <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
                                    id="kt_landing_menu_toggle">
                                    <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                    <span class="svg-icon svg-icon-2hx"><svg width="24" height="24" viewBox="0 0 24 24"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                                fill="currentColor" />
                                            <path opacity="0.3"
                                                d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Mobile menu toggle-->

                                <!--begin::Logo image-->
                                <a href="landing.html">
                                    <img alt="Logo" src="assets/media/logos/logo-br.png"
                                        class="logo-default h-25px h-lg-30px" />

                                </a>
                                <!--end::Logo image-->
                            </div>
                            <!--end::Logo-->

                            <!--begin::Menu wrapper-->
                            <div class="d-lg-block" id="kt_header_nav_wrapper">
                                <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true"
                                    data-kt-drawer-name="landing-menu"
                                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                                    data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                                    data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                                    data-kt-swapper-mode="prepend"
                                    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">

                                    <!--begin::Menu-->
                                    <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-semibold"
                                        id="kt_landing_menu">
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a style='color:#640f11'
                                                class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#kt_body"
                                                data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                                Home </a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link  py-3 px-4 px-xxl-6"
                                                href="https://cttaste.com/landing" data-kt-scroll-toggle="true"
                                                data-kt-drawer-dismiss="true">
                                                About CT_Taste </a>
                                            <!--end::Menu link-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item">
                                            <!--begin::Menu link-->
                                            <a class="menu-link nav-link  py-3 px-4 px-xxl-6"
                                                href="https://cthostel.com" data-kt-scroll-toggle="true"
                                                data-kt-drawer-dismiss="true">
                                                About CT-Hostel </a>
                                            <!--end::Menu link-->
                                        </div>


                                    </div>
                                    <!--end::Menu-->
                                </div>
                            </div>
                          
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->





            </div>
            <!--end::Wrapper-->

            <!--begin::Curve bottom-->
            <div style='background:#fff' class="landing-curve landing-light-color ">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                        fill="#ebab21"></path>
                </svg>
            </div>
            <!--end::Curve bottom-->
        </div>
        <!--end::Header Section-->

        <!--begin::How It Works Section-->
        <div class="mb-n10 mb-lg-n20 z-index-2" style='background:#fff'>
            <!--begin::Container-->
            <div class="container">
                <!--begin::Heading-->
                <div class="text-center mb-17">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-dark mb-5 mt-4" id="how-it-works"
                        data-kt-scroll-offset="{default: 100, lg: 150}">
                        We have Rebranded!
                        {{-- Say 👋 to <a style='color:#ebab21' href='https://vtubiz.com'>VTUBIZ.com</a></h3> --}}
                    <!--end::Title-->
                    
                    
                    <!--begin::Text-->
                    <div style='color:#640f11' class="fs-5 fw-bold">
                        Better Xperience, Cheaper Products and Reliable Service!
                    </div>
                    <a class='btn btn-success' href='https://vtubiz.com'>Take Me To The New Website ➜</a>
                    <!--end::Text-->
                </div>
                <!--end::Heading-->

                <!--begin::Row-->
                <div class="row w-100 gy-10 mb-md-20">
                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="assets/media/logos/delivery_metronics.png" class="mh-125px mb-9" alt="" />
                            <!--end::Illustration-->

                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">1</span>
                                <!--end::Badge-->

                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bold text-dark">
                                    Visit Our New Site.</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                                Click <a href='https://vtubiz.com'>here</a> to visit our new website to keep enjoying
                                our services!
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->



                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="assets/media/logos/hostel_metronics.png" class="mh-125px mb-9" alt="" />
                            <!--end::Illustration-->

                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">2</span>
                                <!--end::Badge-->

                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bold text-dark">
                                    Login With Same Credentials </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                                Login with the same email address and password you were using here on fastpay.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->



                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-4 px-5">
                        <!--begin::Story-->
                        <div class="text-center mb-10 mb-md-0">
                            <!--begin::Illustration-->
                            <img src="assets/media/logos/social_metronics.png" class="mh-125px mb-9" alt="" />
                            <!--end::Illustration-->

                            <!--begin::Heading-->
                            <div class="d-flex flex-center mb-5">
                                <!--begin::Badge-->
                                <span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">3</span>
                                <!--end::Badge-->

                                <!--begin::Title-->
                                <div class="fs-5 fs-lg-3 fw-bold text-dark">
                                    Continue Using Our Services </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                                Sit back, relax, and continue using our upgraded service at a more cheaper rate!
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->



                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->





            </div>
            <!--end::Container-->
        </div>
        <!--end::How It Works Section-->



        <!--begin::Footer Section-->
        <div class="mb-0">
            <!--begin::Curve top-->
            <div style='background:#fff' class="landing-curve landing-light-color ">
                <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
                        fill="#ebab21"></path>
                </svg>
            </div>
            <!--end::Curve top-->

            <!--begin::Wrapper-->
            <div class="landing-light-bg pt-20" style='background:#ebab21'>
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Row-->
                    <div class="row py-10 py-lg-20">
                        <!--begin::Col-->
                        <div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
                            <!--begin::Block-->
                            <div class="rounded landing-light-border p-9 mb-10">
                                <!--begin::Title-->
                                <h2 style='color:#640f11'>Would you like to reach out to us?</h2>
                                <!--end::Title-->

                                <!--begin::Text-->
                                <span class="fw-normal fs-4 text-gray-900">
                                    Email us to

                                    <a href="mailto:support@cttaste.com"
                                        class="opacity-80 text-white text-hover-secondary">support@cttaste.com</a>
                                    or message us via <a href="https://wa.me/2349058744473"
                                        class="opacity-80 text-white text-hover-secondary">whatsapp</a>
                                </span>
                                <!--end::Text-->
                            </div>

                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-6 ps-lg-16">
                            <!--begin::Navs-->
                            <div class="d-flex justify-content-center">
                                <!--begin::Links-->
                                <div class="d-flex fw-semibold flex-column me-20">
                                    <!--begin::Subtitle-->
                                    <h4 style='color:#640f11' class="fw-bold mb-6">Quick Links</h4>
                                    <!--end::Subtitle-->
                                    <a href="https://vtubiz.com"
                                        class="text-hover-secondary text-white fs-5 mb-6">VTUBIZ</a>
                                    <!--end::Link-->


                                    <!--begin::Link-->
                                    <a href="https://cttaste.com"
                                        class="text-hover-secondary text-white fs-5 mb-6">CT_Taste</a>
                                    <!--end::Link-->

                                    <!--begin::Link-->
                                    <a href="https://cthostel.com"
                                        class="text-hover-secondary text-white fs-5 mb-6">CT_Hostel</a>
                                    <!--end::Link-->

                                    <!--begin::Link-->

                                    <!--begin::Link-->
                                    <a href="https://egbami.tech"
                                        class="text-hover-secondary text-white fs-5 mb-6">Egbami Of CTHostel</a>
                                    <!--end::Link-->

                                    <!--end::Link-->
                                </div>
                                <!--end::Links-->

                                <!--begin::Links-->
                                <div class="d-flex fw-semibold flex-column ms-lg-20">
                                    <!--begin::Subtitle-->
                                    <h4 style='color:#640f11' class="fw-bold mb-6">Stay Connected</h4>
                                    <!--end::Subtitle-->


                                    <!--begin::Link-->
                                    <a href="https://www.instagram.com/vtubiz/" class="mb-6">
                                        <img src="assets/media/svg/brand-logos/instagram-2-1.svg" class="h-20px me-2"
                                            alt="" />

                                        <span class="text-white text-hover-primary fs-5 mb-6">Instagram</span>
                                    </a>
                                    <!--end::Link-->
                                </div>
                                <!--end::Links-->
                            </div>
                            <!--end::Navs-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->

                <!--begin::Separator-->
                <div class="landing-light-separator"></div>
                <!--end::Separator-->

                <!--begin::Container-->
                <div class="container">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
                        <!--begin::Copyright-->
                        <div class="d-flex align-items-center order-2 order-md-1">
                            <!--begin::Logo-->
                            <a href="landing.html">
                                <img alt="Logo" src="assets/media/logos/ct_white.png" class="h-15px h-md-20px" />
                            </a>
                            <!--end::Logo image-->

                            <!--begin::Logo image-->
                            <span class="mx-5 fs-6 fw-semibold text-dark pt-1" href="https://cttaste.com/">
                                &copy; 2023 cttaste Inc.
                            </span>
                            <!--end::Logo image-->
                        </div>
                        <!--end::Copyright-->

                        <!--begin::Menu-->
                        <ul class="menu menu-dark menu-hover-secondary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
                            <li class="menu-item">
                                <a href="https://cttaste.com/about" target="_blank" class="menu-link px-2">About</a>
                            </li>

                            <li class="menu-item mx-5">
                                <a href="mailto:support@cttaste.com" target="_blank" class="menu-link px-2">Support</a>
                            </li>

                            <li class="menu-item">
                                <a href="https://wa.me/2349058744473" target="_blank" class="menu-link px-2">Invest</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Footer Section-->

        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
            <span class="svg-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                        fill="currentColor" />
                    <path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Scrolltop-->
    </div>



    <!--end::Modal - Sitemap-->
    <!--end::Engage modals-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="currentColor" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->


    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/index.html";        
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/fslightbox/fslightbox.bundle.js"></script>
    <script src="assets/plugins/custom/typedjs/typedjs.bundle.js"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="assets/js/custom/landing.js"></script>
    <script src="assets/js/custom/pages/pricing/general.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

</body>
<!--end::Body-->

<!-- Mirrored from preview.cttaste.com/metronic8/demo34/landing.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Feb 2023 08:08:11 GMT -->

</html>