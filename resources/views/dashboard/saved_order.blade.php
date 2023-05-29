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
                            <h3 class="card-label">Saved Orders
                                <span class="text-muted pt-2 font-size-sm d-block">{{ $user->email }}</span>
                            </h3>
                        </div>
                     
                    </div>
                    <div class="card-body">

                        <table class="datatable table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                  
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sessions as $key => $tranx)

                                <tr>

                                    <td>{{ $tranx->name }}</td>
                                    <td>NGN{{ number_format($tranx->amount,2) }}</td>
                                  
                                   
                                    <td>
                                        <a data-id='{{ $tranx->id }}' class='delete_order btn btn-danger btn-sm'>Delete</a>
                                        <form method='post' action='{{ env('SECOND_APP') }}/api/load_order'>@csrf
                                            <input type='hidden' name='mysession' value='{{ $tranx->session }}'>
                                        <button type='submit' class='btn btn-success btn-sm'>Load</button>
                                        </form>
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
    $(".delete_order").click(function() {
    var id = $(this).data('id');
    var el = this;

    // Display confirmation dialog using SweetAlert
    Swal.fire({
        title: "Are you sure you want to delete?",
        text: "This saved order will be permanently deleted.",
        icon: "warning",
        buttons: {
            Cancel: "Cancel",
            confirm: {
                text: "Delete",
                value: true,
                visible: true,
                className: "btn-danger",
                closeModal: false
            }
        }
    })
    .then(function(willDelete) {
        if (willDelete) {
            // User confirmed, proceed with deletion
            $.get('{{ route("delete_order")}}?id=' + id, function(data) {
                console.log(data, 'the deleted data')
                Swal.fire('Order Removed', 'Saved orders has been removed successfully!', 'success')
                    .then(function() {
                        // Update UI and remove the deleted row
                        $(el).closest("tr").remove();
                    });
            })
            .catch(function(error) {
                console.log(error);
                Swal.fire("Error", "An error occurred while deleting the order.", "error");
            });
        } else {
            // User canceled, do nothing
            swal.close();
        }
    });
});


        
    })

</script>
@endsection