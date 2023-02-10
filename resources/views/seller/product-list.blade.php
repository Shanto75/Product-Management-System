@extends('seller.header-footer')
@section('seller_content')
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <div class="row">
        <div class="col-sm-12">
            <h2 class="text-center"> <u>Product List</u></h2>
            <a class="btn btn-primary mx-4 mb-4 float-end p-2" href="{{ url('seller/add-product') }}"> <i
                    class="fa fa-plus"></i> Add New Product</a>
        </div>
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="bg-success alert alert-dismissible fade show" role="alert">
                            <h6 class="text-center text-white"><strong>{{ session()->get('success') }}</strong>
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="bg-danger alert alert-dismissible fade show" role="alert">
                            <h6 class="text-center text-white"><strong>{{ session()->get('error') }}</strong>
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="table" class="table table-center table-hover table-bordered table-sm">
                            <thead class="table-light text-center">
                                <tr>
                                    <th class="text-center">S.No.</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Product ID</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center ">
                                                <img class="avatar-sm me-2"
                                                    src="{{ !empty($product->image) ? asset('images/product/' . $product->image) : '' }}"
                                                    alt="">
                                                <div class=" d-flex flex-column">
                                                    <span>Name: {{ $product->product_name }}</span>
                                                    <span>ID: {{ $product->product_id }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $product->product_id }}</td>
                                        <td class="text-{{ $product->status ? 'success' : 'danger' }}">
                                            <b>{{ $product->status ? 'Active' : 'Inactive' }}</b>
                                        </td>
                                        <td class="">
                                            <a href="{{ url('/seller/view-product/' . $product->id) }}"
                                                class="btn btn-warning far fa-eye"></a>
                                            <a href="{{ url('/seller/edit-product/' . $product->id) }}"
                                                class="btn btn-info far fa-edit text-white"></a>
                                            <button onclick="deleteproduct(this.id, this.name)"
                                                name="{{ $product->product_name }}" id="{{ $product->id }}"
                                                class="btn btn-danger far fa-trash-alt delete"></button>
                                            <button onclick="bid(this.id, this.name)" name="{{ $product->product_name }}"
                                                id="{{ $product->id }}" class="btn btn-success fa fa-gavel bid"></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- bid product --}}
    <div class="modal fade" id="bid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form" method="post">
                    @csrf
                    <div class="modal-body mx-auto overflow-auto">
                        <h4 class="modal-title text-center mb-4" id="exampleModalLabel">Set Bidding for <span id="bidProductName"></span></h4>
                        <input type="hidden" name="bidId" id="bidId">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-info text-white"> Start Date </span>
                            <input type="datetime-local" name="bid_start" id="bid_start" class="form-control" required>
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-info text-white"> End Date </span>
                            <input type="datetime-local" name="bid_end" id="bid_end" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary float-end">Submit</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // $(document).ready(function() {
        //     deletes = document.getElementsByClassName('delete');
        //     Array.from(deletes).forEach((element) => {
        //         element.addEventListener("click", (e) => {
        //             id = e.target.id;
        //             Swal.fire({
        //                 title: 'Are you sure? You want to delete - ' + e.target.getAttribute('data-name'),
        //                 text: "You won't be able to revert this!",
        //                 icon: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 confirmButtonText: 'Yes, delete it!'
        //             }).then((result) => {
        //                 if (result.isConfirmed) {
        //                     window.location = `/seller/delete-product/${id}`
        //                 }
        //             })
        //         })
        //     })
        // });

        function deleteproduct(id, name) {
            Swal.fire({
                title: 'Are you sure? You want to delete - ' + name,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = `/seller/delete-product/${id}`
                }
            })
        }

        function bid(id, name) {
            document.getElementById('bidProductName').innerText = name;
            bidId.value = id;
            $('#bid').modal('toggle');
        }

        $('#form').on('submit', function(e) {
            $('#bid').modal('toggle');
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: "POST",
                method: "POST",
                url: '/seller/bid',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    if (result.msg) {
                        console.log(result);
                        toastr.success(result.msg, 'Success!!', {
                            timeOut: 5000
                        });
                    }
                },
                error: function(result) {
                    toastr.error('Failed to set the bidding.', 'Failed!!', {
                        timeOut: 5000
                    });
                }

            });
        });

        // function bid(id, name) {
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You want to Set " + name +" for bidding!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             $.ajax({
        //                 type: "PUT",
        //                 method: "PUT",
        //                 headers: {
        //                     'X-CSRF-TOKEN': "{{ csrf_token() }}",
        //                 },
        //                 url: "/seller/bid/" + id,
        //                 dataType: "json",
        //                 contentType: false,
        //                 processData: false,
        //                 success: function(response) {
        //                     console.log(response);
        //                     toastr.success(name + ' is set for bidding Successfully.', 'Success!!', {
        //                         timeOut: 5000
        //                     });
        //                 },
        //                 error: function(response) {
        //                     toastr.error('Failed', 'Failed!!', {
        //                         timeOut: 5000
        //                     });
        //                 }
        //             });
        //         }
        //     })
        // }
    </script>
@endsection
