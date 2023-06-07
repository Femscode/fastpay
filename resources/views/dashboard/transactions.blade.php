@extends('dashboard.master1')

@section('header')
@endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Profile Account Information-->
        <div class="row">
           
            <!--begin::Content-->
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <div class="card-title">
                            <h3 class="card-label">My Transactions
                                <span class="text-muted pt-2 font-size-sm d-block">{{ $user->email }}</span>
                            </h3>
                        </div>
                     
                    </div>
                    <div class="card-body">

                        <table class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Previous Balance</th>
                                    <th scope="col">Later Balance</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $key => $tranx)

                                <tr>

                                    <td>{{ $tranx->title }}</td>
                                    <td>{{ $tranx->description }}</td>
                                    <td>₦{{ number_format($tranx->amount,2) }}</td>
                                    <td>₦{{ number_format($tranx->before,2) }}</td>
                                    <td>₦{{ number_format($tranx->after,2) }}</td>
                                    <td>{{ $tranx->type }}</td>
                                    <td>@if($tranx->status == 1)
                                        <span class='badge badge-light-success'>Success</span>
                                        @else
                                        <span class='badge badge-light-danger'>Failed</span>
                                        @endif
                                    
                                    </td>
                                    <td>
                                        <a href='/print_transaction_receipt/{{ $tranx->id }}' class='btn btn-success btn-sm'>Print</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <!--end: Datatable-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Profile Account Information-->
    </div>
    <!--end::Container-->
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true
            });   

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
        
    })

</script>
@endsection