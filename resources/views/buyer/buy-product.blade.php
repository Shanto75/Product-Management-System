@extends('buyer.header-footer')
@section('buyer_content')
    <!-- Modal -->
    <div class="modal fade" id="view-product-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mx-auto overflow-auto">
                    <h2 class="modal-title text-center mb-4" id="exampleModalLabel"> <u>Product Details</u></h2>
                    <div class="d-flex flex-wrap gap-4">
                        <div class="mx-auto">
                            <img id="product_image" style="width: 15rem; height:15rem" class="rounded-3" src=""
                                alt="">
                        </div>
                        <div class="mx-auto">
                            <table class="table table-sm text-sm table-bordered overflow-auto text-wrap">
                                <tbody>
                                    <tr>
                                        <th>Product Id</th>
                                        <td>
                                            <div id="product_id"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product Name</th>
                                        <td>
                                            <div id="product_name"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Seller Details</th>
                                        <td>
                                            <div id="seller_details" class="text-wrap"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product Details</th>
                                        <td>
                                            <div id="product_details" class="text-wrap"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Product Quantity</th>
                                        <td>
                                            <div id="product_quantity"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>product Price</th>
                                        <td>
                                            <div id="product_price" class="text-wrap"> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                        <h2 class="modal-title text-center mb-4" id="exampleModalLabel"> <u> Bid for <span
                                    id="bidProductName"></span> </u></h2>
                        <input type="hidden" name="bidId" id="bidId">
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-info text-white"> Enter Amount </span>
                            <input type="number" name="bid_amount" id="bid-amount" class="form-control" required>
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

    <div class="row">
        <div class="col-sm-12 mb-4 ">
            <h2 class="text-center"> <u>Product List</u></h2>
        </div>

        <div class=" bg-white rounded row p-4 mb-4">
            <div class="col-md-6">

                {{-- <label for="customRange2" class="form-label"><i class="fa fa-search"></i> Search with price
                    range(0-40000)</label>
                <input type="range" name="price-range" class="form-range price-range" min="0" max="40000" id="customRange2">
                <span id="current-range" class="badge badge-primary rounded-pill" ></span> --}}
                {{-- <label for="customRange2" class="form-label"><i class="fa fa-search"></i> Search with price
                    range(0-40000)</label> --}}
                <div type="button" class=" position-relative">
                    <input type="range" name="price-range" class="form-range price-range mt-2" min="0"
                        max="40000" id="customRange2">
                    <span
                        class="position-absolute top-0 start-100 translate-middle  bg-primary rounded-3 text-sm text-white">
                        <span id="current-range" class="badge">0</span>
                    </span>
                    <span class="position-absolute top-0 start-0 translate-middle  bg-primary rounded-3 text-sm text-white">
                        <span class="badge">0</span>
                    </span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-info text-white"> <i class="fa fa-search"></i> </span>
                    <input type="text" class="form-control search-product" placeholder="Search Product">
                </div>
            </div>
        </div>

        <div class="range-slider">
            <div data-min="0" data-max="150000" data-unit="Sq ft" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider" aria-disabled="false"></div>
            <div class="clearfix"></div>
        </div>

        <div style="margin: 0 auto;" class="product col-sm-12 d-flex flex-wrap align-items-center justify-content-center">

            @foreach ($products as $product)
                <div class="product-item">
                    <div style="width: 16rem;" class="card d-flex m-2 flex-column justify-content-center ">
                        <div class="card-header">
                            <img style="width: 12rem; height:12rem" class="rounded-3"
                                src="{{ !empty($product->product->image) ? asset('images/product/' . $product->product->image) : '' }}"
                                alt="">
                        </div>
                        <div class="card-body d-flex flex-column product-item-details ">
                            Name: {{ $product->product_name }} ({{ $product->quantity }}) <br>
                            <p> Price: <span class="product-price-start">{{ $product->price_start . ' - ' }}</span> <span
                                    class="product-price-end">{{ $product->price_end }}</span> TK </p>
                        </div>
                        <div class="card-footer text-center">
                            <button id="{{ $product->product_id }}" onclick="view(this.id)" type="button"
                                class="btn btn-info fa fa-eye text-white"></button>
                            {{-- <a href="#" class="btn btn-danger fa fa-heart "></a> --}}
                            {{-- <a href="#" class="btn btn-success fa fa-money-bill-wave "></a> --}}
                            <button id="{{ $product->id }}" name="{{ $product->product_name }}"
                                onclick="bid(this.id, this.name)" type="button"
                                class="btn btn-success fa fa-money-bill-wave text-white"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
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
                url: '/buyer/bidProduct',
                data: formData,
                contentType: false,
                processData: false,
                success: function(result) {
                    toastr.success(result.msg, 'Success!!', {
                        timeOut: 5000
                    });

                },
                error: function(result) {
                    toastr.error(result.msg, 'Failed!!', {
                        timeOut: 5000
                    });
                }

            });
        });

        function view(id) {
            $.ajax({
                type: "GET",
                method: "GET",
                url: '/buyer/get_product_details/' + id,
                contentType: false,
                processData: false,
                success: function(result) {
                    var product = result.product;
                    document.getElementById('product_image').src = "/images/product/" + product.image;
                    document.getElementById('product_id').innerText = product.product_id;
                    document.getElementById('product_name').innerText = product.product_name;
                    document.getElementById('seller_details').innerText = 'Seller: ' + product.user.first_name +
                        ' ' + product.user.last_name + '. ID: ' + product.user.user_id;
                    document.getElementById('product_details').innerText = product.details;
                    document.getElementById('product_quantity').innerText = product.quantity;
                    document.getElementById('product_price').innerText = product.price_start + ' - ' + product
                        .price_end + ' TK';
                    $('#view-product-modal').modal('toggle');
                    // console.log(product.product_name);
                },
                error: function(result) {
                    toastr.error('Failed', 'Failed to show the product!!', {
                        timeOut: 2000
                    });
                }
            });
        }

        var qsRegex;
        var $product = $('.product').isotope({
            itemSelector: '.product-item',
            // layoutMode: 'fitRows',
            masonry: {
                columnWidth: 0,
                isFitWidth: true
            }
        });

        var $quicksearch = $('.search-product').keyup(function() {
            qsRegex = new RegExp($quicksearch.val(), 'gi');
            $product.isotope({
                filter: function() {
                    return qsRegex ? $(this).text().match(qsRegex) : true;
                }
            });
        });

        $rangeinput = $('.price-range');
        $rangeinput.change(function() {
            // console.log($rangeinput.val());
            document.getElementById('current-range').innerText = $rangeinput.val();
            $product.isotope({
                filter: function() {
                    var s = $(this).find('.product-price-start').text();
                    var e = $(this).find('.product-price-end').text();
                    // console.log(parseInt( e ) );
                    return parseInt(e, 10) >= $('.price-range').val(), parseInt(s, 10) <= $(
                        '.price-range').val();
                }
            });
        });
    </script>
@endsection
