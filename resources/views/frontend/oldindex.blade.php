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
                            <!--end::Menu wrapper-->

                            <!--begin::Toolbar-->
                            <div class="flex-equal text-end ms-1">
                                <a href="/login" class="btn btn-success btn-sm">Sign In</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->


                <!--begin::Landing hero-->
                <div style='background-image: url(assets/media/logos/fastpay_bg_3.jpg);background-size:cover;background-color:#fff'
                    class="d-flex flex-column flex-left w-100 min-h-350px min-h-lg-500px px-9">
                    <!--begin::Heading-->
                    <div class="text-left mb-5 mb-lg-10 py-10 py-lg-20">
                        <!--begin::Title-->
                        <h1 class="text-dark lh-base fw-bold fs-2x fs-lg-3x mb-15">
                            Save Big on Food, Data, <br />
                            Airtime and Bills Payment.

                            {{-- <span
                                style="background: linear-gradient(to right, #640f11 0%, #ebab21 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
                                <span id="kt_landing_hero_text"> & Cable Subscription.</span>
                            </span> --}}
                        </h1>
                        <!--end::Title-->

                        <!--begin::Action-->
                        <a href="/login" class="btn btn-secondary"><i class='fa fa-plus'></i>Login</a>
                        <a href="/register" class="btn btn-warning"><i class='fa fa-user'></i>Register</a>
                        <!--end::Action-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Clients-->
                    <div style='background:#fff;' class="d-flex flex-center flex-wrap position-relative px-5">

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
                            <img src="assets/media/logos/hand_of_God.png" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Vodafone">
                            <img src="assets/media/logos/tudeetop.jpeg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="KPMG International">
                            <img src="assets/media/logos/mhunis.jpeg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Nasa">
                            <img src="assets/media/logos/beespicy.jpeg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Aspnetzero">
                            <img src="assets/media/logos/mayortoast.jpeg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip"
                            title="AON - Empower Results">
                            <img src="assets/media/logos/dalish2.jpeg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Hewlett-Packard">
                            <img src="assets/media/logos/boripe.jpeg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->

                        <!--begin::Client-->
                        <div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Truman">
                            <img src="assets/media/logos/sans.jpeg" class="mh-30px mh-lg-40px" alt="" />
                        </div>
                        <!--end::Client-->
                    </div>
                    <!--end::Clients-->
                </div>
                <!--end::Landing hero-->






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
                        Say 👋 to Fastpay</h3>
                    <!--end::Title-->

                    <!--begin::Text-->
                    <div style='color:#640f11' class="fs-5 fw-bold">
                        Convenient, Affordable and Reliable!
                    </div>
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
                                    Pay for food orders.</div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                                Avoid payment confirmation delay, make payment and get your payment confirmed instantly.
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
                                    Pay for hostel </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-6 fs-lg-4 text-muted">
                                Don't get scammed, making payment for desired hostel helps protect you from scam and
                                money can be refunded at any given time.
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
                                    Pay for utilities </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Description-->
                            <div class="fw-semibold fs-6 fs-lg-4 text-muted">

                                Get your data, airtime, tv subscription and light bills at the cheapest amount possible.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Story-->



                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->


                <!--begin::Product slider-->
                <div class="tns tns-default">
                    <!--begin::Slider-->
                    <div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000"
                        data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true"
                        data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false"
                        data-tns-prev-button="#kt_team_slider_prev1" data-tns-next-button="#kt_team_slider_next1">

                        <!--begin::Item-->
                        <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                            <img src="assets/media/logos/slider_4.png" class="card-rounded shadow mh-lg-650px mw-100"
                                alt="" />
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                            <img src="assets/media/logos/slider_3.png" class="card-rounded shadow mh-lg-650px mw-100"
                                alt="" />
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                            <img src="assets/media/logos/slider_5.png" class="card-rounded shadow mh-lg-650px mw-100"
                                alt="" />
                        </div>
                        <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                            <img src="assets/media/logos/slider_6.png" class="card-rounded shadow mh-lg-650px mw-100"
                                alt="" />
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="text-center px-5 pt-5 pt-lg-10 px-lg-10">
                            <img src="assets/media/logos/slider_7.png" class="card-rounded shadow mh-lg-650px mw-100"
                                alt="" />
                        </div>
                        <!--end::Item-->

                    </div>
                    <!--end::Slider-->

                    <!--begin::Slider button-->
                    <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                        <span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                    <!--end::Slider button-->

                    <!--begin::Slider button-->
                    <button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                        <span class="svg-icon svg-icon-3x"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                    <!--end::Slider button-->
                </div>
                <!--end::Product slider-->








            </div>
            <!--end::Container-->
        </div>
        <!--end::How It Works Section-->


        <!--begin::Statistics Section-->
        <div class="mt-sm-n10">
            <!--begin::Curve top-->
            <div class="landing-curve landing-light-color ">
                <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
                        fill="currentColor"></path>
                </svg>
            </div>
            <!--end::Curve top-->

            <!--begin::Wrapper-->
            <div class="pb-15 pt-18 landing-light-bg" style='background:#f5f5f5'>
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Heading-->
                    <div class="text-center mt-15 mb-18" id="achievements"
                        data-kt-scroll-offset="{default: 100, lg: 150}">
                        <!--begin::Title-->
                        <h3 class="fs-2hx text-dark fw-bold mb-5">We Make Things Better</h3>
                        <!--end::Title-->

                        <!--begin::Description-->
                        <div class="fs-5 text-gray-700 fw-bold">

                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Statistics-->
                    <div class="d-flex flex-center">
                        <!--begin::Items-->
                        <div class="d-flex flex-wrap flex-center justify-content-lg-between mb-15 mx-auto w-xl-900px">

                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                style="background-image: url('assets/media/svg/misc/octagon.svg')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3"><svg width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->

                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="4500"
                                            data-kt-countup-suffix="+">0</div>
                                    </div>
                                    <!--end::Value-->

                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">
                                        Users </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                style="background-image: url('assets/media/svg/misc/octagon.svg')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/graphs/gra008.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3"><svg width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13 10.9128V3.01281C13 2.41281 13.5 1.91281 14.1 2.01281C16.1 2.21281 17.9 3.11284 19.3 4.61284C20.7 6.01284 21.6 7.91285 21.9 9.81285C22 10.4129 21.5 10.9128 20.9 10.9128H13Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M13 12.9128V20.8129C13 21.4129 13.5 21.9129 14.1 21.8129C16.1 21.6129 17.9 20.7128 19.3 19.2128C20.7 17.8128 21.6 15.9128 21.9 14.0128C22 13.4128 21.5 12.9128 20.9 12.9128H13Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M11 19.8129C11 20.4129 10.5 20.9129 9.89999 20.8129C5.49999 20.2129 2 16.5128 2 11.9128C2 7.31283 5.39999 3.51281 9.89999 3.01281C10.5 2.91281 11 3.41281 11 4.01281V19.8129Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->

                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="80"
                                            data-kt-countup-suffix="K+">0</div>
                                    </div>
                                    <!--end::Value-->

                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">
                                        Food Orders </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Item-->
                            <div class="d-flex flex-column flex-center h-200px w-200px h-lg-250px w-lg-250px m-3 bgi-no-repeat bgi-position-center bgi-size-contain"
                                style="background-image: url('assets/media/svg/misc/octagon.svg')">
                                <!--begin::Symbol-->
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                <span class="svg-icon svg-icon-2tx svg-icon-white mb-3"><svg width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <!--end::Symbol-->

                                <!--begin::Info-->
                                <div class="mb-0">
                                    <!--begin::Value-->
                                    <div class="fs-lg-2hx fs-2x fw-bold text-white d-flex flex-center">
                                        <div class="min-w-70px" data-kt-countup="true" data-kt-countup-value="650"
                                            data-kt-countup-suffix="+">0</div>
                                    </div>
                                    <!--end::Value-->

                                    <!--begin::Label-->
                                    <span class="text-gray-600 fw-semibold fs-5 lh-0">
                                        Hostels </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Item-->

                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Statistics-->

                    <!--begin::Testimonial-->
                    <div style='color:#640f11' class="fs-2 fw-semibold  text-center mb-3">
                        <span class="fs-1 lh-1 -700">“</span>

                        We care about tech solutions that brings value to students <br /><span
                            class="text-gray-700 me-1">and making school life more</span>easier

                        <span class="fs-1 lh-1 text-gray-700">“</span>
                    </div>
                    <!--end::Testimonial-->

                    <!--begin::Author-->
                    {{-- <div class="fs-2 fw-semibold text-muted text-center">
                        <a href="account/security.html" class="link-primary fs-4 fw-bold"></a>

                        <span class="fs-4 fw-bold text-gray-600">cttaste CEO</span>
                    </div> --}}
                    <!--end::Author-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Curve bottom-->
            <div class="landing-curve landing-light-color ">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                        fill="currentColor"></path>
                </svg>
            </div>
            <!--end::Curve bottom-->
        </div>
        <!--end::Statistics Section-->








        <!--begin::Pricing Section-->
        <div class="mt-sm-n20 ">
            <!--begin::Curve top-->
            {{-- <div style="background:#fff" class="landing-curve landing-light-color ">
                <svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
                        fill="#fff"></path>
                </svg>
            </div> --}}
            <!--end::Curve top-->

            <!--begin::Wrapper-->
            {{-- <div class="py-20 landing-light-bg ">
                <!--begin::Container-->
                <div class="container">
                    <!--begin::Plans-->
                    <div class="d-flex flex-column container pt-lg-20">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <h1 class="fs-2hx fw-bold text-white mb-5" id="pricing"
                                data-kt-scroll-offset="{default: 100, lg: 150}">Clear Pricing Makes it Easy</h1>

                            <div class="text-gray-600 fw-semibold fs-5">
                                Save thousands to millions of bucks by using single tool for different <br />
                                amazing and outstanding cool and great useful admin
                            </div>
                        </div>
                        <!--end::Heading-->

                        <!--begin::Pricing-->
                        <div class="text-center" id="kt_pricing">
                            <!--begin::Nav group-->
                            <div class="nav-group landing-light-bg d-inline-flex mb-15" data-kt-buttons="true"
                                style="border: 1px dashed #2B4666;">
                                <a href="#"
                                    class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3 me-2 active"
                                    data-kt-plan="month">
                                    Monthly
                                </a>

                                <a href="#" class="btn btn-color-gray-600 btn-active btn-active-success px-6 py-3"
                                    data-kt-plan="annual">
                                    Annual
                                </a>
                            </div>
                            <!--end::Nav group-->

                            <!--begin::Row-->
                            <div class="row g-10">
                                <!--begin::Col-->
                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <!--begin::Option-->
                                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
                                            <!--begin::Heading-->
                                            <div class="mb-7 text-center">
                                                <!--begin::Title-->
                                                <h1 class="text-light mb-5 fw-boldest">Startup</h1>
                                                <!--end::Title-->

                                                <!--begin::Description-->
                                                <div class="text-gray-400 fw-semibold mb-5">
                                                    Best Settings for Startups
                                                </div>
                                                <!--end::Description-->

                                                <!--begin::Price-->
                                                <div class="text-center">
                                                    <span class="mb-2 text-primary">$</span>

                                                    <span class="fs-3x fw-bold text-primary"
                                                        data-kt-plan-price-month="99" data-kt-plan-price-annual="999">
                                                        99 </span>

                                                    <span class="fs-7 fw-semibold opacity-50"
                                                        data-kt-plan-price-month="/ Mon"
                                                        data-kt-plan-price-annual="/ Ann">
                                                        / Mon </span>
                                                </div>
                                                <!--end::Price-->
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Features-->
                                            <div class="w-100 mb-10">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 text-start pe-3">
                                                        Up to 10 Active Users </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 text-start pe-3">
                                                        Up to 30 Project Integrations </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800">
                                                        Keen Analytics Platform </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                    <span class="svg-icon svg-icon-1"><svg width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="currentColor" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800">
                                                        Targets Timelines & Files </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                    <span class="svg-icon svg-icon-1"><svg width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="currentColor" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack ">
                                                    <span class="fw-semibold fs-6 text-gray-800">
                                                        Unlimited Projects </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                    <span class="svg-icon svg-icon-1"><svg width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="currentColor" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->

                                            </div>
                                            <!--end::Features-->

                                            <!--begin::Select-->
                                            <a href="#" class="btn btn-primary">Select</a>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <!--begin::Option-->
                                        <div
                                            class="w-100 d-flex flex-column flex-center rounded-3 bg-primary py-20 px-10">
                                            <!--begin::Heading-->
                                            <div class="mb-7 text-center">
                                                <!--begin::Title-->
                                                <h1 class="text-white mb-5 fw-boldest">Business</h1>
                                                <!--end::Title-->

                                                <!--begin::Description-->
                                                <div class="text-white opacity-75 fw-semibold mb-5">
                                                    Best Settings for Business
                                                </div>
                                                <!--end::Description-->

                                                <!--begin::Price-->
                                                <div class="text-center">
                                                    <span class="mb-2 text-white">$</span>

                                                    <span class="fs-3x fw-bold text-white"
                                                        data-kt-plan-price-month="199" data-kt-plan-price-annual="1999">
                                                        199 </span>

                                                    <span class="fs-7 fw-semibold text-white opacity-75"
                                                        data-kt-plan-price-month="/ Mon"
                                                        data-kt-plan-price-annual="/ Ann">
                                                        / Mon </span>
                                                </div>
                                                <!--end::Price-->
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Features-->
                                            <div class="w-100 mb-10">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span
                                                        class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">
                                                        Up to 10 Active Users </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-white"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span
                                                        class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">
                                                        Up to 30 Project Integrations </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-white"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span
                                                        class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">
                                                        Keen Analytics Platform </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-white"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span
                                                        class="fw-semibold fs-6 text-white opacity-75 text-start pe-3">
                                                        Targets Timelines & Files </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-white"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack ">
                                                    <span class="fw-semibold fs-6 text-white opacity-75">
                                                        Unlimited Projects </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen040.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-white"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <rect x="7" y="15.3137" width="12" height="2" rx="1"
                                                                transform="rotate(-45 7 15.3137)" fill="currentColor" />
                                                            <rect x="8.41422" y="7" width="12" height="2" rx="1"
                                                                transform="rotate(45 8.41422 7)" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->

                                            </div>
                                            <!--end::Features-->

                                            <!--begin::Select-->
                                            <a href="#"
                                                class="btn btn-color-primary btn-active-light-primary btn-light">Select</a>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-4">
                                    <div class="d-flex h-100 align-items-center">
                                        <!--begin::Option-->
                                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-body py-15 px-10">
                                            <!--begin::Heading-->
                                            <div class="mb-7 text-center">
                                                <!--begin::Title-->
                                                <h1 class="text-light mb-5 fw-boldest">Enterprise</h1>
                                                <!--end::Title-->

                                                <!--begin::Description-->
                                                <div class="text-gray-400 fw-semibold mb-5">
                                                    Best Settings for Enterprise
                                                </div>
                                                <!--end::Description-->

                                                <!--begin::Price-->
                                                <div class="text-center">
                                                    <span class="mb-2 text-primary">$</span>

                                                    <span class="fs-3x fw-bold text-primary"
                                                        data-kt-plan-price-month="999" data-kt-plan-price-annual="9999">
                                                        999 </span>

                                                    <span class="fs-7 fw-semibold opacity-50"
                                                        data-kt-plan-price-month="/ Mon"
                                                        data-kt-plan-price-annual="/ Ann">
                                                        / Mon </span>
                                                </div>
                                                <!--end::Price-->
                                            </div>
                                            <!--end::Heading-->

                                            <!--begin::Features-->
                                            <div class="w-100 mb-10">
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 text-start pe-3">
                                                        Up to 10 Active Users </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 text-start pe-3">
                                                        Up to 30 Project Integrations </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 text-start pe-3">
                                                        Keen Analytics Platform </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack mb-5">
                                                    <span class="fw-semibold fs-6 text-gray-800 text-start pe-3">
                                                        Targets Timelines & Files </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="d-flex flex-stack ">
                                                    <span class="fw-semibold fs-6 text-gray-800 text-start pe-3">
                                                        Unlimited Projects </span>
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                                    <span class="svg-icon svg-icon-1 svg-icon-success"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                                                rx="10" fill="currentColor" />
                                                            <path
                                                                d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                                <!--end::Item-->

                                            </div>
                                            <!--end::Features-->

                                            <!--begin::Select-->
                                            <a href="#" class="btn btn-primary">Select</a>
                                            <!--end::Select-->
                                        </div>
                                        <!--end::Option-->
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Pricing-->
                    </div>
                    <!--end::Plans-->
                </div>
                <!--end::Container-->
            </div> --}}
            <!--end::Wrapper-->

            <!--begin::Curve bottom-->
            {{-- <div class="landing-curve landing-light-color ">
                <svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
                        fill="currentColor"></path>
                </svg>
            </div> --}}
            <!--end::Curve bottom-->
        </div>
        <!--end::Pricing Section-->

        <a href="https://wa.me/2349058744473"><img src="{{asset('assets/media/logos/whatsapp.png')}}" alt='whatsapp'
                id="fixedbutton"></a>


        <!--begin::Testimonials Section-->
        <div class="mt-20 mb-n20 position-relative z-index-2">
            <!--begin::Container-->
            <div class="container">
                {{--
                <!--begin::Heading-->
                <div class="text-center mb-17">
                    <!--begin::Title-->
                    <h3 class="fs-2hx text-light mb-5" id="clients" data-kt-scroll-offset="{default: 125, lg: 150}">What
                        Our Clients Say</h3>
                    <!--end::Title-->

                    <!--begin::Description-->
                    <div class="fs-5 text-muted fw-bold">
                        Save thousands to millions of bucks by using single tool <br />
                        for different amazing and great useful admin
                    </div>
                    <!--end::Description-->
                </div>
                <!--end::Heading-->

                <!--begin::Row-->
                <div class="row g-lg-10 mb-10 mb-lg-20">
                    <!--begin::Col-->
                    <div class="col-lg-4">
                        <!--begin::Testimonial-->
                        <div
                            class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                            <!--begin::Wrapper-->
                            <div class="mb-7">
                                <!--begin::Rating-->
                                <div class="rating mb-6">
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                </div>
                                <!--end::Rating-->

                                <!--begin::Title-->
                                <div class="fs-2 fw-bold text-light mb-3">

                                    This is by far the cleanest template <br />
                                    and the most well structured
                                </div>
                                <!--end::Title-->

                                <!--begin::Feedback-->
                                <div class="text-gray-500 fw-semibold fs-4">

                                    The most well thought out design theme I have ever used. The codes are up to
                                    tandard. The css styles are very clean.
                                    In fact the cleanest and the most up to standard I have ever seen.
                                </div>
                                <!--end::Feedback-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Author-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-50px me-5">
                                    <img src="assets/media/avatars/300-1.jpg" class="" alt="" />
                                </div>
                                <!--end::Avatar-->

                                <!--begin::Name-->
                                <div class="flex-grow-1">
                                    <a href="#" class="text-light fw-bold text-hover-primary fs-6">Paul Miles</a>

                                    <span class="text-muted d-block fw-bold">Development Lead</span>
                                </div>
                                <!--end::Name-->
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Testimonial-->



                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4">
                        <!--begin::Testimonial-->
                        <div
                            class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                            <!--begin::Wrapper-->
                            <div class="mb-7">
                                <!--begin::Rating-->
                                <div class="rating mb-6">
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                </div>
                                <!--end::Rating-->

                                <!--begin::Title-->
                                <div class="fs-2 fw-bold text-light mb-3">

                                    This is by far the cleanest template <br />
                                    and the most well structured
                                </div>
                                <!--end::Title-->

                                <!--begin::Feedback-->
                                <div class="text-gray-500 fw-semibold fs-4">

                                    The most well thought out design theme I have ever used. The codes are up to
                                    tandard. The css styles are very clean.
                                    In fact the cleanest and the most up to standard I have ever seen.
                                </div>
                                <!--end::Feedback-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Author-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-50px me-5">
                                    <img src="assets/media/avatars/300-2.jpg" class="" alt="" />
                                </div>
                                <!--end::Avatar-->

                                <!--begin::Name-->
                                <div class="flex-grow-1">
                                    <a href="#" class="text-light fw-bold text-hover-primary fs-6">Janya Clebert</a>

                                    <span class="text-muted d-block fw-bold">Development Lead</span>
                                </div>
                                <!--end::Name-->
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Testimonial-->



                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-lg-4">
                        <!--begin::Testimonial-->
                        <div
                            class="d-flex flex-column justify-content-between h-lg-100 px-10 px-lg-0 pe-lg-10 mb-15 mb-lg-0">
                            <!--begin::Wrapper-->
                            <div class="mb-7">
                                <!--begin::Rating-->
                                <div class="rating mb-6">
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                    <div class="rating-label me-2 checked">
                                        <i class="bi bi-star-fill fs-5"></i>
                                    </div>
                                </div>
                                <!--end::Rating-->

                                <!--begin::Title-->
                                <div class="fs-2 fw-bold text-light mb-3">

                                    This is by far the cleanest template <br />
                                    and the most well structured
                                </div>
                                <!--end::Title-->

                                <!--begin::Feedback-->
                                <div class="text-gray-500 fw-semibold fs-4">

                                    The most well thought out design theme I have ever used. The codes are up to
                                    tandard. The css styles are very clean.
                                    In fact the cleanest and the most up to standard I have ever seen.
                                </div>
                                <!--end::Feedback-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Author-->
                            <div class="d-flex align-items-center">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-circle symbol-50px me-5">
                                    <img src="assets/media/avatars/300-16.jpg" class="" alt="" />
                                </div>
                                <!--end::Avatar-->

                                <!--begin::Name-->
                                <div class="flex-grow-1">
                                    <a href="#" class="text-light fw-bold text-hover-primary fs-6">Steave Brown</a>

                                    <span class="text-muted d-block fw-bold">Development Lead</span>
                                </div>
                                <!--end::Name-->
                            </div>
                            <!--end::Author-->
                        </div>
                        <!--end::Testimonial-->



                    </div>
                    <!--end::Col-->
                </div> --}}
                <!--end::Row-->

                <!--begin::Highlight-->
                <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-n5 mb-lg-n13"
                    style="background: linear-gradient(90deg, #ebab21 0%, #03A588 100%);">
                    <!--begin::Content-->
                    <div class="my-2 me-5">
                        <!--begin::Title-->
                        <div class="fs-1 fs-lg-2qx fw-bold text-white mb-2">
                            Start Saving Big

                            <span class="fw-normal">on Data, Airtime, Light bills and Cable Subscription!</span>
                        </div>
                        <!--end::Title-->

                        <!--begin::Description-->
                        <div class="fs-6 fs-lg-5 text-white fw-semibold opacity-75">
                            Join over 4,500+ Happy Users Today to Stay Ahead.
                        </div>
                        <!--end::Description-->
                    </div>
                    <!--end::Content-->

                    <!--begin::Link-->
                    <a href="/login" class="btn btn-lg btn-outline border-2 btn-outline-white flex-shrink-0 my-2">Get
                        Started</a>
                    <!--end::Link-->
                </div>
                <!--end::Highlight-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Testimonials Section-->


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
                                </span>
                                <!--end::Text-->
                            </div>
                            <!--end::Block-->

                            <!--begin::Block-->
                            <div class="rounded landing-light-border p-9">
                                <!--begin::Title-->
                                <h2 style='color:#640f11'>How About Creating Your Own Web Application?</h2>
                                <!--end::Title-->

                                <!--begin::Text-->
                                <span class="fw-normal fs-4 text-gray-900">
                                    We have team of developers and designers that can bring your idea/business to
                                    reality!

                                    <a href="https://wa.me/2349058744473" class="text-hover-secondary text-white">Click
                                        to reach out.</a>
                                </span>
                                <!--end::Text-->
                            </div>
                            <!--end::Block-->
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

                                    <!--begin::Link-->
                                    <a href="https://cttaste.com"
                                        class="text-hover-secondary text-white fs-5 mb-6">CT_Taste</a>
                                    <!--end::Link-->

                                    <!--begin::Link-->
                                    <a href="https://cthostel.com"
                                        class="text-hover-secondary text-white fs-5 mb-6">CT_Hostel</a>
                                    <!--end::Link-->

                                    <!--begin::Link-->
                                    <a href="https://ctstake.com"
                                        class="text-hover-secondary text-white fs-5 mb-6">CT_Stake</a>
                                    <!--end::Link-->

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


                                    <a href="https://www.facebook.com/107641935325820/posts/pfbid02HNSTgXffyTr5iEeSqs1aiXhNmN9RDaLcfCZTJC63EsVRXz36y7aw8RfSNHqRRhncl/?sfnsn=scwspmo"
                                        class="mb-6">
                                        <img src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-2"
                                            alt="" />

                                        <span class="text-white text-hover-primary fs-5 mb-6">Facebook</span>
                                    </a>
                                    <!--end::Link-->



                                    <!--begin::Link-->
                                    <a href="https://twitter.com/ct_taste?s=20&t=izEI3zXAe5nU69qdNJINTA" class="mb-6">
                                        <img src="assets/media/svg/brand-logos/twitter.svg" class="h-20px me-2"
                                            alt="" />

                                        <span class="text-white text-hover-primary fs-5 mb-6">Twitter</span>
                                    </a>
                                    <!--end::Link-->


                                    <!--begin::Link-->
                                    <a href="https://www.instagram.com/ct_taste/?igshid=YmMyMTA2M2Y%3D" class="mb-6">
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