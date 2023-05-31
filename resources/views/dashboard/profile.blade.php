@extends('dashboard.master1')
@section('content')
<div class="d-flex flex-column flex-column-fluid">


    <div class="flex-row-fluid ml-lg-8">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <form class="form" method='post' action='{{ route("updateprofile") }}' enctype="multipart/form-data">@csrf
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">Profile Overview</h3>
                </div>
                <div class="card-toolbar">
                    <button type="submit" class="btn btn-success mr-2">Save Changes</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Form-->
          
                <div class="card-body">
                    <!--begin::Heading-->
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Account:</h5>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label">Name</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="">
                                <input name='name' class="form-control form-control-lg form-control-solid" type="text" value="{{ $user->name }}" />
                            </div>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label">Email Address</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="la la-at"></i>
                                    </span>
                                </div>
                                <input readonly disabled type="text" class="form-control form-control-lg form-control-solid" value="{{ $user->email }}" placeholder="Email" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label">Phone</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" name='phone' class="form-control form-control-lg form-control-solid" value="{{ $user->phone ?? "" }}" placeholder="Phone Number" />
                            </div>
                           
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label">Profile Picture</label>
                        <div class="col-lg-9 col-xl-6">
                          <input type='file' class='form-control' name='image'/>
                        </div>
                    </div>
    
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label">BVN</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="input-group input-group-lg input-group-solid">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-bank"></i>
                                    </span>
                                </div>
                                <input disabled type="number" name='bvn' readonly class="form-control form-control-lg form-control-solid" value="{{ $user->bvn ?? "" }}" placeholder="Bank Verification Number" />
                            </div>   
                        </div>
                    </div>
                    <!--begin::Form Group-->
                  
                    <!--begin::Form Group-->
                    {{-- <div class="form-group row mb-4 align-items-center">
                        <label class="col-xl-3 col-lg-3 col-form-label">Communication</label>
                        <div class="col-lg-9 col-xl-6">
                            <div class="checkbox-inline">
                                <label class="checkbox">
                                <input type="checkbox" checked="checked" />
                                <span></span>Email</label>
                                <label class="checkbox">
                                <input type="checkbox" checked="checked" />
                                <span></span>SMS</label>
                                <label class="checkbox">
                                <input type="checkbox" />
                                <span></span>Phone</label>
                            </div>
                        </div>
                    </div> --}}
                    <!--begin::Form Group-->
                    <div class="separator separator-dashed my-5"></div>
                    <!--begin::Form Group-->
                    <div class="row">
                        <label class="col-xl-3"></label>
                        <div class="col-lg-9 col-xl-6">
                            <h5 class="font-weight-bold mb-6">Advanced:</h5>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label">Available Balance</label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="button" class="btn btn-light-success font-weight-bold btn-sm">NGN {{ number_format($user->balance) }}</button>
                            <p class="form-text text-muted pt-2">Recent Transactions. 
                            <a href="/transactions" class="font-weight-bold">View transactions</a>.</p>
                        </div>
                    </div>
                    <!--begin::Form Group-->
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label">Total Money Spent</label>
                        <div class="col-lg-9 col-xl-6">
                            <button type="button" class="btn btn-light-primary font-weight-bold btn-sm">NGN {{ number_format($user->total_spent) }}</button>
                           
                         </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-xl-3 col-lg-3 col-form-label"></label>
                        <div class="col-lg-9 col-xl-6">
                             <button type="button" class="btn btn-light-danger font-weight-bold btn-sm">Deactivate account</button>
                             <button type="button" class="btn btn-danger font-weight-bold btn-sm">Delete account</button>
                        </div>
                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card-->
    </div>
</div>
@endsection  
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
   @if (session('error'))
        Swal.fire('Incorrect Pin!',"{{ session('error') }}",'error');
    @endif
    $("#reset_pin").click(function() {
        Swal.fire({
title: 'You are about to reset your pin?',
text: 'A token will be sent to your email, copy the token to reset your pin!',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Yes, reset',
cancelButtonText: 'Cancel'
}).then((result) => {
if (result.isConfirmed) {
   Swal.fire('Sending your token, please wait...')
        $.ajax({
       type: 'POST',
       url: "{{route('forgot-pin')}}",
      
       cache: false,
       contentType: false,
       processData: false,
       success: function(data) {
          console.log(data)
          location.href = 'http://127.0.0.1:8000/reset-pin-with-token';
       },
       error: function(data) {
           console.log(data)
           Swal.close()
          
           Swal.fire('Opps!', 'Something went wrong, please try again later', 'error')
       }
   })
}
})
    })
    })
  
</script>
@endsection
