<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Paycirclex | Home</title>
    <meta charset="utf-8" />
    <meta name="description" content="Send Money In Bulk" />
    <meta name="keywords" content="Pay Your Circle" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Pay your circle" />
    <meta property="og:url" content="https://paycirclex.com" />
    <meta property="og:site_name" content="Paycirclex" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->



    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->


</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="app-blank">
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
			themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
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
    <div class="d-flex flex-column flex-root" id="kt_app_root">


        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-column-fluid">

            <!--end::Header-->

            <!--begin::Body-->
            <div class="scroll-y flex-column-fluid px-10 py-10" data-kt-scroll="true" data-kt-scroll-activate="true"
                data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header_nav"
                data-kt-scroll-offset="5px" data-kt-scroll-save-state="true"
                style="background-color:#D5D9E2; --kt-scrollbar-color: #d9d0cc; --kt-scrollbar-hover-color: #d9d0cc">

                <!--begin::Email template-->
                <style>
                    html,
                    body {
                        padding: 0;
                        margin: 0;
                        font-family: Inter, Helvetica, "sans-serif";
                    }

                    a:hover {
                        color: #009ef7;
                    }
                </style>

                <div id="#kt_app_body_content"
                    style="background-color:#D5D9E2; font-family:Arial,Helvetica,sans-serif; line-height: 1.5; min-height: 100%; font-weight: normal; font-size: 15px; color: #2F3044; margin:0; padding:0; width:100%;">
                    <div
                        style="background-color:#ffffff; padding: 45px 0 34px 0; border-radius: 24px; margin:0px auto; max-width: 600px;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" height="auto"
                            style="border-collapse:collapse">
                            <tbody>
                                <tr>
                                    <td align="center" valign="center" style="text-align:center; padding-bottom: 10px">

                                        <!--begin:Email content-->
                                        <div style="text-align:center; margin:0 15px 34px 15px">
                                            <!--begin:Logo-->
                                            <div style="margin-bottom: 10px">
                                                <a rel="noopener" target="_blank">
                                                    <img alt="Logo" src="../../assets/media/email/logo-1.svg"
                                                        style="height: 35px" />
                                                </a>
                                            </div>
                                            <!--end:Logo-->
                                         
                                            <!--begin:Media-->
                                            @if(Session::has('live_add'.$payroll->title))
                                            <div style="margin-bottom: 15px">
                                                <img alt="Logo"
                                                    src="../../assets/media/email/icon-positive-vote-1.svg" />
                                            </div>
                                            <h4>Well Done!</h4>
                                            <p style="margin-bottom:2px; color:#7E8299">Your account details have been submitted
                                                 to the <b>{{ $payroll->title }}
                                                    Payroll</b>.</p><br><br>
                                            
                                            @else
                                            <!--end:Media-->

                                            <!--begin:Text-->
                                            <div
                                                style="font-size: 14px; font-weight: 500; margin-bottom: 27px; font-family:Arial,Helvetica,sans-serif;">
                                                <p
                                                    style="margin-bottom:9px; color:#181C32; font-size: 22px; font-weight:700">
                                                    Hi Champs!</p>
                                                <p style="margin-bottom:2px; color:#7E8299">You have been invited to add
                                                    your account details to the <b>{{ $payroll->title }}
                                                        Payroll</b>.</p><br><br>
                                                <div class='d-flex justify-content-center'>

                                                    <form method='post' action="{{ route('live_add') }}">@csrf

                                                        <div class="col-md-12">
                                                            <label style='text-align:left !important'>Account Name:</label>
                                                            <input type='hidden' name='payroll_id'
                                                                value='{{ $payroll->uuid }}' />
                                                            <input name="account_name" type="text" class="form-control"
                                                                placeholder="Enter full name" required />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Account Number:</label>
                                                            <input name="account_no" type="number" class="form-control"
                                                                placeholder="Enter account number" required />
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="bank-select">Select Bank:</label>
                                                            <select class="form-control" required name="bank_code">
                                                                <option>--Select Bank--</option>
                                                                @foreach($banks as $bank) 
                                                                    <option value='{{ $bank->code }}'>{{ $bank->name }}</option>
                                                                @endforeach
                                                               </select>
                                                        </div>

                                                        <div class="d-flex justify-content-center mt-2">
                                                            <button type="submit" class="btn btn-primary btn-block p-3">
                                                                Add To {{ $payroll->title }}
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <!--end:Text-->

                                            </div>
                                            @endif
                                            <!--end:Email content-->
                                    </td>
                                </tr>



                                <tr>
                                    <td align="center" valign="center" style="text-align:center; padding-bottom: 20px;">
                                        <a href="#" style="margin-right:10px"><img alt="Logo"
                                                src="../../assets/media/email/icon-linkedin.svg" /></a>
                                        <a href="#" style="margin-right:10px"><img alt="Logo"
                                                src="../../assets/media/email/icon-dribbble.svg" /></a>
                                        <a href="#" style="margin-right:10px"><img alt="Logo"
                                                src="../../assets/media/email/icon-facebook.svg" /></a>
                                        <a href="#"><img alt="Logo"
                                                src="../../assets/media/email/icon-twitter.svg" /></a>
                                    </td>
                                </tr>

                                <tr>
                                    <td align="center" valign="center"
                                        style="font-size: 13px; padding:0 15px; text-align:center; font-weight: 500; color: #A1A5B7;font-family:Arial,Helvetica,sans-serif">
                                        <p> &copy Copyright KeenThemes.
                                            <a href="https://keenthemes.com/" rel="noopener" target="_blank"
                                                style="font-weight: 600;font-family:Arial,Helvetica,sans-serif">Unsubscribe</a>&nbsp;
                                            from newsletter.
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--end::Email template-->

            </div>
            <!--end::Body-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Root-->

    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/new-target.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    <script src='{{ asset('assets/cdn/dataTables.min.js')}}'></script>
    <script src='{{ asset('assets/cdn/dataTables.min.css')}}'></script>
    {{--
    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css' /> --}}
    <script>
       
       @if (session('message'))
            Swal.fire('Success!',"{{ session('message') }}",'success');
        @endif
       @if (session('error'))
            Swal.fire('{{ session('message') }}',"The account details you provided is not correct",'error');
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <!--end::Javascript-->

</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo34/authentication/email/welcome-message.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Feb 2023 08:12:06 GMT -->

</html>