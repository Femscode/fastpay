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
                            <span class=" text-gray-500 fw-bold fs-4">-- BANK TRANSFER --</span>
                        </div>
                        <div class="alert bg-light-success alert-custom alert-light-success fade show mb-2" role="alert">
                            {{-- <div class="alert-icon">
                                <span class="svg-icon svg-icon-3x svg-icon-info">
                                    <!--begin::Svg Icon | path:/metronic/theme/html/demo2/dist/assets/media/svg/icons/Code/Info-circle.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"></circle>
                                            <rect fill="#000000" x="11" y="10" width="2" height="7" rx="1"></rect>
                                            <rect fill="#000000" x="11" y="7" width="2" height="2" rx="1"></rect>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div> --}}
                            <div class="alert-text fw-semibold fs-6">
                                <h4>Make an instant transfer to the account details below.</h4>
                                Please note that this is a virtual temporary account, and will expire in <span class='text-danger'><b>30Mins</b></span> time.</div>


                        </div>
                        <div class="card card-dashed bg-light-secondary flex-row flex-stack flex-wrap p-6">
                            <!--begin::Info-->
                            <div class="d-flex flex-column py-2">
                                <!--begin::Owner-->
                               
                                <!--end::Owner-->

                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Icon-->
                                   
                                    <img src="assets/media/logos/social_metronics.png" style='width:100px;height:100px' alt=""
                                        class="me-4">
                                   

                                    <!--end::Icon-->

                                    <!--begin::Details-->
                                    <div>
                                        <div class="fs-6 fw-semibold text-gray-600">
                                        Acct. No :</div>
                                        <div class="fs-4 fw-bold">{{ $account_no ?? "No account generated
                                            yet!" }}</div>
                                            <div class="fs-6 fw-semibold text-gray-600">Bank Name :</div>
                                        <div class="fs-6 fw-bold">{{ $bank_name ?? "No
                                            account generated yet!" }}</div>
                                            <div class="fs-6 fw-semibold text-gray-600">
                                              Amount :</div>
                                              <div class="fs-4 fw-bold">NGN{{ number_format($amount) ?? "No account generated
                                                  yet!" }}</div>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Info-->



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