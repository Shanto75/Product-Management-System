@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <h4 class="text-center pt-4">Currently Active Bids Information</h4>
                        <table id="table" class="table table-bordered table-center table-hover ">
                            <thead class=" table-light ">
                                <tr>
                                    <th>#</th>
                                    <th>Product Details</th>
                                    <th>Dates</th>
                                    <th>User</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bids as $bid)
                                    <tr>
                                        <td>{{ $loop->iteration.'.' }}</td>
                                        <td>
                                            <div class="d-flex  ">
                                                <img class="avatar-xl me-2"
                                                    src="{{ !empty($bid->product->image) ? asset('images/product/' . $bid->product->image) : '' }}"
                                                    alt="">
                                                <div class=" d-flex flex-column">
                                                    <span>{{ $bid->product_name }} ({{ $bid->quantity }})</span>
                                                    <span>{{ $bid->details }}</span>
                                                    <span> Range: {{ $bid->price_start.' - '.$bid->price_end }} TK </span>
                                                    <span>
                                                        @php $highest_bid = 0; @endphp
                                                        @foreach ($bid->bid_list as $bidinfo)
                                                            @if ($bidinfo->bid_amount > $highest_bid)
                                                                @php $highest_bid = $bidinfo->bid_amount; @endphp
                                                            @endif
                                                        @endforeach
                                                        Current Highest Bid: {{$highest_bid}} TK
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            Started: {{ $bid->bid_start }}<br> Ends: {{ $bid->bid_end }}<br>
                                            Created: {{ $bid->created_at }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <img class="avatar-xl me-2"
                                                    src="{{ !empty($bid->user->user_details->img) ? asset('images/user/' . $bid->user->user_details->img) : '' }}"
                                                    alt="">
                                                <div class=" d-flex flex-column">
                                                    <span>{{ $bid->user->first_name.' '.$bid->user->last_name }}</span>
                                                    <span>ID: {{$bid->user->user_id}}</span>
                                                    <span>Phone: {{$bid->user->phone}} </span>
                                                    <span>Email: {{$bid->user->email}} </span>
                                                </div>
                                            </div>
                                        </td>
                                        {{-- <td><span class="badge badge-pill bg-success-light">Active</span></td> --}}
                                        <td>
                                            <a href="#" class="btn btn-warning far fa-eye"></a>
                                            <a href="#" class="btn btn-info far fa-edit text-white"></a>
                                            <button class="btn btn-danger far fa-trash-alt delete"></button>
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
@endsection
