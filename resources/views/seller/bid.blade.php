@extends('seller.header-footer')
@section('seller_content')
    <div class=" d-flex flex-row justify-content-center align-item-center gap-2">
        <div class="p-4 card table-responsive">
            <h4 class="text-center"> <u>Product List</u></h4>
            <table id="table" class="table table-hover table-bordered table-sm">
                <thead class="table-light text-center">
                    <tr>
                        <th class="text-center">S.No.</th>
                        <th class="text-center">Product Details</th>
                        {{-- <th class="text-center">Status</th> --}}
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($bids as $bid)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex">
                                    <img class="avatar-xl me-3"
                                        src="{{ !empty($bid->product->image) ? asset('images/product/' . $bid->product->image) : '' }}"
                                        alt="">
                                    <div class="d-flex flex-column align-items-start">
                                        <span>Name: {{ $bid->product_name }} ({{ $bid->quantity }})</span>
                                        {{-- <span>Details: {{ $bid->details }}</span> --}}
                                        <span>Price Range: {{ $bid->price_start .' - '. $bid->price_end }} TK</span>
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="text-{{ $bid->status ? 'success' : 'danger' }}">
                                <b>{{ $bid->status ? 'Active' : 'Inactive' }}</b>
                            </td> --}}
                            <td>
                                <button onclick="view(this.id)" id="{{ $bid->id }}" class="btn btn-info far fa-eye"></button>
                                <button onclick="deleteproduct(this.id, this.name)" name="{{ $bid->product_name }}"
                                    id="{{ $bid->id }}" class="btn btn-danger far fa-trash-alt delete"></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="">
            <div class="p-4 card table-responsive">
                <h4 class="text-center"> <u>Bid List</u></h4>
                <table id="bidinfotable" class="card-table table table-hover table-bordered table-sm">
                    <thead class="table-light text-center">
                        <tr>
                            <th class="text-center">S.No.</th>
                            <th class="text-center">User Details </th>
                            <th class="text-center">Bid Amount</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                </table>
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
                        <h4 class="modal-title text-center mb-4" id="exampleModalLabel">Set Bidding for <span
                                id="bidProductName"></span></h4>
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
        function view(id){
            $.ajax({
                type: "GET",
                method: "GET",
                url: '/seller/view_bids/' + id,
                contentType: false,
                processData: false,
                success: function(result) {
                    // console.log(result.bid_list[0].bid_amount);
                    const bidlist = result.bid_list;
                    // console.log(bidlist.length);
                    $("#bidinfotable tr>td").remove();
                    var table = document.getElementById("bidinfotable");
                    if(bidlist.length > 0){
                        bidlist.forEach((element, i) => {
                            // console.log(i, element);
                            // No data available in table
                            var row = table.insertRow(i+1);
    
                            row.insertCell(0).innerHTML = i+1;
                            row.insertCell(1).innerHTML = 'User Id: '+element.user_id;
                            row.insertCell(2).innerHTML = element.bid_amount+' TK';
                            row.insertCell(3).innerHTML = '<button class="btn btn-danger btn-sm far fa-trash-alt"></button>';
                        });
                    }
                    else{
                        var row = table.insertRow(1);
                        // row.insertCell(0).innerHTML = '<p class="text-center">No data available</p>';
                        row.innerHTML = '<td valign="top" colspan="4" class="dataTables_empty">No data available in table</td>';
                        
                    }
                },
                error: function(result) {
                    toastr.error('Failed', 'Failed to show the Bids!!', {
                        timeOut: 5000
                    });
                }
            });
        }

        // function deleteproduct(id, name) {
        //     Swal.fire({
        //         title: 'Are you sure? You want to delete - ' + name,
        //         text: "You won't be able to revert this!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, delete it!'
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             window.location = `/seller/delete-product/${id}`
        //         }
        //     })
        // }
    </script>
@endsection
