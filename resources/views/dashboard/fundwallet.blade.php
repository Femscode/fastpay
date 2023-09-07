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

                                        <input required type="number" min='150' id='u_amount' class="form-control"
                                            placeholder="Amount" aria-label="Amount">


                                        <input type="hidden" id='amount' name="amount">

                                        <input type="hidden" name="metadata"
                                            value="{{ json_encode($array = ['phone' => $user->phone,]) }}">
                                        <div>


                                            <input required type='radio' name='type' value='transfer' />
                                            <label class="form-check-label" for="Pay with bank transfer">
                                                Automatic Bank Transfer
                                            </label>
                                            <input required type='radio' name='type' value='card' />
                                            <label class="form-check-label" for="Pay with card">
                                                Pay With Credit Card
                                            </label>
                                        </div>
                                        <div class='alert alert-success mt-2'>
                                            <div class='text-danger' id='charges'>
                                                Charges : ₦0.00
                                            </div>
                                            <div id='total_payment'>
                                                Total Payment : ₦0.00
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
        $("#u_amount").on('input',function() {
        var amount = parseInt($("#u_amount").val()) * 100;
        // var charges = 0.02 * amount
        var charges = 0
      
       
        if(parseInt($("#u_amount").val()) < 2500) {
            $("#amount").val(amount + charges);
        }
        else {
            $("#amount").val(amount + (0.05 * amount) +10000);    
            // var charges =   0.02 * amount + 10000
            var charges =   0
            
        }
        $("#charges").text('Charges : '+ (charges/100).toLocaleString('en-US', { style: 'currency', currency: 'NGN' }))          
        $("#total_payment").text('Total payment : '+ (amount/100 + charges/100).toLocaleString('en-US', { style: 'currency', currency: 'NGN' }))          
        
        // alert($("#u_amount").val() * 100)
    })
    })

</script>
@endsection