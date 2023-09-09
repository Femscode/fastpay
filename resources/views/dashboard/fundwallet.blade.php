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


                        <div class="text-center my-8">
                            <span class=" text-gray-500 fw-bold fs-4">-- FUND WALLET --</span>
                        </div>
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
@endsection