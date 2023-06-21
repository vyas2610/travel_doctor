@extends('layouts.afterlogin')

@section('title', 'Slider')

@section('admin_content')
<!-- Content -->
<script>
    $(document).on('click', '.button', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
                title: "Are you sure!",
                type: "error",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes!",
                showCancelButton: true,
            },
            function() {
                $.ajax({
                    type: "POST",
                    url: "{{url('/destroy')}}",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        //
                    }
                });
            });
    });

    function showMsg() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                swalWithBootstrapButtons.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success',
                    form.submit()


                )
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    }
</script>
<div class="container-xxl flex-grow-1 container-p-y">
    <x-alert />
    <div class="row">
        <div class="col-sm-4">
            <div class="card">
                <h5 class="card-header">
                    Add Slider
                </h5>
                <div class="card-body">
                    {{ Form::open(['url' => route('admin.slider.store')]) }}
                    @include('modules.slider._form')
                    <div class="d-grid">
                        <button class="btn btn-primary">Save</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <div class="col-sm-8">
            <div class="card">
                <h5 class="card-header">View Sliders</h5>
                <div class="card-body">
                    {{ $dataTable->table() }}
                    <a href="" class="button" data-id=1>Delete</a>

                    <button onclick="showMsg()">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Content -->
@endsection

@push('extra_styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/1.6.1/css/colReorder.bootstrap5.min.css">
@endpush

@push('extra_scripts')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/colreorder/1.6.1/js/dataTables.colReorder.min.js"></script>

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush