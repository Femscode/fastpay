@extends('super.master')

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
                            <h3 class="card-label">All Users (NGN{{ number_format(($users->sum('balance')),2) }})
                            </h3>
                        </div>
                     
                    </div>
                    <div class="card-body">
                        <div class='col-md-6'>
                            <input type="text" class="form-control" placeholder="Search..." id="searchTable">
                            </div>
                        <table class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Balance</th>
                                    <th scope="col">Spent</th>
                                    <th scope="col">Account No</th>
                                    
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)

                                <tr>

                                    <td><a href='tel:{{ $user->phone }}'>{{ $user->name }}</a></td>
                                    <td>{{ $user->phone }}</td>
                                    <td>₦{{ number_format($user->balance) }}</td>
                                    <td>₦{{ number_format($user->total_spent) }}</td>
                                    <td>{{$user->account_vfd ?? "No acct" }}</td>
                                  
                                   
                                  
                                    <td>@if($user->email_verified_at !== null)
                                        <span class='badge badge-light-success'>Verified</span>
                                        @else
                                        <span class='badge badge-light-danger'>Not verified</span>
                                        @endif
                                    
                                    </td>
                                    <td>{{ Date('d-m-Y',strtotime($user->created_at))}}</td>
                                    <td class='d-flex'>
                                        <a href='tel:{{ $user->phone }}' class='btn btn-secondary btn-sm m-2'>Save</a>
                                        <a href='https://wa.me/234{{ substr($user->phone,1) }}' class='btn btn-success btn-sm m-2'>Message</a>
                                        <a href='/user_transaction/{{ $user->uuid }}' class='btn btn-info btn-sm m-2'>Transactions</a>
                                        <a href='/user_purchase/{{ $user->uuid }}' class='btn btn-warning btn-sm m-2'>Payment History</a>
                                        @if($user->block == 1)
                                        <a onclick='return confirm("Are you sure you want to unblock this user?")' href='/block_user/{{ $user->uuid }}' class='btn btn-secondary btn-sm m-2'>Unblock User</a>
                                        @else 
                                        <a onclick='return confirm("Are you sure you want to block this user?")' href='/block_user/{{ $user->uuid }}' class='btn btn-light-danger btn-sm m-2'>Block User</a>
                                        @endif

                                        <a href='/delete_user/{{ $user->uuid }}' class='btn btn-danger btn-sm m-2'>Delete User</a>
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
            $('#searchTable').on('keyup', function() {
              oTable.search(this.value).draw();
            });

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
        
    })

</script>
@endsection