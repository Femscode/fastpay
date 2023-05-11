@extends('dashboard.master1')

@section('header')
@endsection 

@section('content')

    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <div  id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Container-->
        <div class="row">
            <!--begin::Profile Account Information-->
            <div class="row">
                <!--begin::Aside-->
                <div class="col-md-4" id="kt_profile_aside">
                    <!--begin::Profile Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Body-->
                        <div class="card-body pt-4">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end">
                                <div class="dropdown dropdown-inline">
                                    <a href="#"
                                        class="btn btn-clean btn-hover-light-primary btn-sm btn-icon"
                                        data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="ki ki-bold-more-hor"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                        <!--begin::Navigation-->
                                        <ul class="navi navi-hover py-5">
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-drop"></i>
                                                    </span>
                                                    <span class="navi-text">New Group</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-list-3"></i>
                                                    </span>
                                                    <span class="navi-text">Contacts</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-rocket-1"></i>
                                                    </span>
                                                    <span class="navi-text">Groups</span>
                                                    <span class="navi-link-badge">
                                                        <span
                                                            class="label label-light-primary label-inline font-weight-bold">new</span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-bell-2"></i>
                                                    </span>
                                                    <span class="navi-text">Calls</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-gear"></i>
                                                    </span>
                                                    <span class="navi-text">Settings</span>
                                                </a>
                                            </li>
                                            <li class="navi-separator my-3"></li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-magnifier-tool"></i>
                                                    </span>
                                                    <span class="navi-text">Help</span>
                                                </a>
                                            </li>
                                            <li class="navi-item">
                                                <a href="#" class="navi-link">
                                                    <span class="navi-icon">
                                                        <i class="flaticon2-bell-2"></i>
                                                    </span>
                                                    <span class="navi-text">Privacy</span>
                                                    <span class="navi-link-badge">
                                                        <span
                                                            class="label label-light-danger label-rounded font-weight-bold">5</span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!--end::Navigation-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::User-->
                            <div class="d-flex align-items-center">
                                <div
                                    class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                    <div class="symbol-label"
                                        style="background-image:url('../../../../../theme/html/demo2/dist/assets/media/users/300_21.jpg')">
                                    </div>
                                    <i class="symbol-badge bg-success"></i>
                                </div>
                                <div>
                                    <a href="#"
                                        class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">Fund
                                        Wallet</a>

                                    <div class="mt-2">
                                        {{ $user->email }}
                                    </div>
                                </div>
                            </div>
                            <!--end::User-->
                            <!--begin::Contact-->
                            <div class="py-9">
                                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8"
                                    class="form-horizontal" role="form">@csrf
                                    <div class="row" style="margin-bottom:40px;">
                                        <div class="col-md-12 col-md-offset-2">

                                            <input required type="number" min='150' id='u_amount'
                                                class="form-control" placeholder="Amount"
                                                aria-label="Amount">
                                            <input type="hidden" name="email"
                                                value="{{ $user->email }}"> {{-- required
                                            --}}

                                            <input type="hidden" id='amount' name="amount">
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="currency" value="NGN">
                                            <input type="hidden" name="metadata"
                                                value="{{ json_encode($array = ['phone' => $user->phone,]) }}">
                                            <input type="hidden" name="reference"
                                                value="{{ Paystack::genTranxRef() }}">

                                            <p class='mt-2 justify-content-center'
                                                style='display:flex;justify-content:center'>
                                                <button class="btn btn-success btn-lg btn-block"
                                                    type="submit" value="Pay Now!">
                                                    <i class="fa fa-plus-circle fa-lg"></i>
                                                    Fund Wallet!
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                           
                              
                            
                            <!--end::Nav-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Profile Card-->
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="col-md-8">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Account Transfer
                                </h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">Automatic
                                    Funding</span>
                            </div>
                          
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form class="form">
                            <div class="card-body">
                                <!--begin::Heading-->
                                <div class="alert bg-light-info alert-custom alert-light-info fade show mb-10"
                                    role="alert">
                                    {{-- <div class="alert-icon">
                                        <span class="svg-icon svg-icon-3x svg-icon-info">
                                            <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Code/Info-circle.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none"
                                                    fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                                        r="10"></circle>
                                                    <rect fill="#000000" x="11" y="10" width="2"
                                                        height="7" rx="1"></rect>
                                                    <rect fill="#000000" x="11" y="7" width="2"
                                                        height="2" rx="1"></rect>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div> --}}
                                    <div class="alert-text font-weight-bold">Transfer to your virtual
                                        account below with a charge of NGN50 and get
                                        credited immediately!</div>

                                  
                                </div>
                                <div
                                class="card card-dashed bg-light-secondary flex-row flex-stack flex-wrap p-6">
                                <!--begin::Info-->
                                <div class="d-flex flex-column py-2">
                                    <!--begin::Owner-->
                                    <div class="d-flex align-items-center fs-4 fw-bold mb-5">
                                        {{ $user->account_name ?? "No account generated yet" }}
                                    </div>
                                    <!--end::Owner-->

                                    <!--begin::Wrapper-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Icon-->
                                        <img src="assets/media/logos/access.png" style='width:50px;height:50px'
                                            alt="" class="me-4">
                                        <!--end::Icon-->

                                        <!--begin::Details-->
                                        <div>
                                            <div class="fs-4 fw-bold">{{ $user->account_no ?? "No account generated yet!" }}</div>
                                            <div class="fs-6 fw-semibold text-gray-400">{{ $user->bank_name ?? "No account generated yet!" }}</div>
                                        </div>
                                        <!--end::Details-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Info-->

                            </div>

                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Profile Account Information-->
        </div>
        <!--end::Container-->
    </div>
    </div>
   
@endsection 

@section('script')
<script>
    $(document).ready(function() {

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
        $("#u_amount").on('input',function() {
        var amount = parseInt($("#u_amount").val()) * 100;
      
       
        if(parseInt($("#u_amount").val()) < 2500) {
            $("#amount").val((amount) + (0.05 * amount));
          
        }
        else {
            $("#amount").val((amount) + (0.05 * amount) +10000);
          
          
        }
        
        // alert($("#u_amount").val() * 100)
    })
    })

</script>
@endsection