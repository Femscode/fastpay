@extends('dashboard.master1')

@section('header')
@endsection

@section('content')

<!--end::Subheader-->
<!--begin::Entry-->
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Container-->
        <div class="row">
            <!--begin::Profile Account Information-->

            <!--begin::Content-->
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom">
                    <!--begin::Header-->

                    <!--end::Header-->
                    <!--begin::Form-->

                    <div class="card-body">
                        <!--begin::Heading-->
                        <style>
                            .credit-card {
                                background: #333;
                                border-radius: 10px;
                                padding: 20px;
                                color: #fff;
                            }

                            .credit-card-header {
                                background: linear-gradient(to right, #007BFF, #0056b3);
                                border-top-left-radius: 10px;
                                border-top-right-radius: 10px;
                                padding: 10px;
                            }

                            .credit-card-title {
                                text-align: center;
                                font-size: 24px;
                            }

                            .credit-card-list {
                                list-style-type: none;
                                padding: 0;
                            }

                            .credit-card-list-item {
                                margin-bottom: 10px;
                            }

                            .credit-card-list-item strong {
                                font-size: 18px;
                            }
                        </style>

                        <div class="text-center my-8">
                            <span class=" text-gray-500 fw-bold fs-4">-- FUND WALLET --</span>
                        </div>

                        {{-- <ul class="nav nav-tabs" id="accountTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="account1-tab" data-toggle="tab" href="#account1" role="tab" aria-controls="account1" aria-selected="true">Moniepoint MFB</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account2-tab" data-toggle="tab" href="#account2" role="tab" aria-controls="account2" aria-selected="false">GTBank</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account3-tab" data-toggle="tab" href="#account3" role="tab" aria-controls="account3" aria-selected="false">VFD MFB</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="accountContent">
                            <div class="tab-pane fade show active" id="account1" role="tabpanel" aria-labelledby="account1-tab">
                                <div class='col-md-4 mt-2'>
                                    <div class="card bg-light-primary p-4 rounded" style='border:2px dotted #004085'>
                                        <div class="card-header ">
                                            <div class="credit-card-title text-center" style='color:#004085'>Moniepoint MFB</div>
                                        </div>
                                        <ul class="credit-card-list">
                                            <li class="credit-card-list-item" style='color:#004085'>
                                               Acct. No:<strong> 8383742983</strong>
                                            </li>
                                            <li class="credit-card-list-item" style='color:#004085'>
                                               Acct. Name:<strong> John</strong> 
                                            </li>
                                            <li class="credit-card-list-item" style='color:#004085'>
                                               Bank Name:<strong> MFB</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account2" role="tabpanel" aria-labelledby="account2-tab">
                                <div class='col-md-4 mt-2'>
                                    <div class="card bg-light-danger p-4 rounded" style='border:2px dotted #721c24'>
                                        <div class="card-header ">
                                            <div class="credit-card-title text-center" style='color:#721c24'>GTBank</div>
                                        </div>
                                        <ul class="credit-card-list">
                                            <li class="credit-card-list-item" style='color:#721c24'>
                                               Acct. No:<strong> 8383742983</strong>
                                            </li>
                                            <li class="credit-card-list-item" style='color:#721c24'>
                                               Acct. Name:<strong> John</strong> 
                                            </li>
                                            <li class="credit-card-list-item" style='color:#721c24'>
                                               Bank Name:<strong> MFB</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account3" role="tabpanel" aria-labelledby="account3-tab">
                               
                            <div class='col-md-4 mt-2'>
                                <div class="card bg-light-success p-4 rounded" style='border:2px dotted #155724'>
                                    <div class="card-header ">
                                        <div class="credit-card-title text-center" style='color:#155724'>VFD MFB</div>
                                    </div>
                                    <ul class="credit-card-list">
                                        <li class="credit-card-list-item" style='color:#155724'>
                                           Acct. No:<strong> 8383742983</strong>
                                        </li>
                                        <li class="credit-card-list-item" style='color:#155724'>
                                           Acct. Name:<strong> John</strong> 
                                        </li>
                                        <li class="credit-card-list-item" style='color:#155724'>
                                           Bank Name:<strong> MFB</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            </div>
                        </div> --}}


                        <div class="py-2">
                            <form method="POST" action="{{ route('checkout') }}" accept-charset="UTF-8"
                                class="form-horizontal" role="form">@csrf
                                <div class="row" style="margin-bottom:40px;">
                                    <div class="col-md-12 col-md-offset-2">

                                        <input required name='amount' type="number" min='100' id='u_amount'
                                            class="form-control" placeholder="Amount" aria-label="Amount">




                                        <input type="hidden" name="metadata"
                                            value="{{ json_encode($array = ['phone' => $user->phone,]) }}">
                                        <div>
                                            <div class="form-check m-4">
                                                <input class="form-check-input" checked type="radio" name="type"
                                                    value="transfer">
                                                <label class="form-check-label" for="Bank Transfer">
                                                    Automatic Bank Transfer
                                                </label>
                                            </div>
                                            <div class="form-check m-4">
                                                <input class="form-check-input" type="radio" name="type" value="card">
                                                <label class="form-check-label" for="Pay With Card">
                                                    Pay With Credit Card
                                                </label>
                                            </div>


                                        </div>

                                        <p class='mt-2 justify-content-center'
                                            style='display:flex;justify-content:center'>
                                            <button class="btn btn-success btn-lg btn-block" type="submit"
                                                value="Pay Now!">
                                                <i class="fa fa-plus-circle fa-lg"></i>
                                                Fund Wallet
                                            </button>
                                        </p>

                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>



                    <!--end::Form-->
                </div>

                <!--end::Card-->
            </div>
            <!--end::Content-->

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
      
    })

</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection