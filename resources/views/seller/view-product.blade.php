@extends('seller.header-footer')
@section('seller_content')
    <div class=" row ">

        <div class="col-sm-12 card">
            <div class="card-header">
                <h2 class="card-title text-center"><u>Product Details</u></h2>
                <div class=" d-flex justify-content-between pt-4 ">
                    <a class="btn btn-primary" href="{{ URL::previous() }}"> <i class="fa fa-chevron-left"></i> Back</a>
                    <a class="btn btn-primary" href="{{ url('/seller/edit-product/' . $product->id) }}"> <i class="fa fa-edit"></i> Edit</a>
                </div>
            </div>

            <div class="card-body">
                <div class="row row-cols-auto gap-5">
                    <div class="col">
                        <img style="max-width: 15rem; " src="{{ File::exists('images/product/' . $product->image) ? asset('images/product/' .  $product->image) : '' }}"
                        alt="">
                    </div>
                    <div class="col">
                        <div class=" ">
                            <h3>{{$product->product_name}}</h3>
                            <div>🞛 <b>ID: </b> {{$product->product_id}}</div>
                            <div>🞛 <b>Status: </b> <b class="text-{{$product->status ? 'success' : 'danger' }}">{{$product->status ? 'Active' : 'Inactive' }} </b></div>
                            <div>🞛 <b>Details: </b> {{$product->details}}</div>
                            <div>🞛 <b>Quantity: </b> {{$product->quantity}}</div>
                            <div>🞛 <b>Price Range: </b> {{$product->price_start.' - '.$product->price_end}}</div>
                            <div>🞛 <b>Sold Price: </b> {{$product->sold_price}}</div>
                            <div>🞛 <b>Production Duration: </b> {{$product->production_start.' - '.$product->production_end}}</div>
                            <div>🞛 <b>Sold Date: </b> {{$product->sold_date}}</div>
                            <div>🞛 <b>Total Product Produced: </b> {{$product->total_produced}}</div>
                            <div>🞛 <b>Production Cost: </b> {{$product->production_cost}}</div>
                            <div>🞛 <b>Created: </b> {{$product->created_at}}</div>
                            <div>🞛 <b>Last Updated: </b> {{$product->updated_at}}</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
