@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-sm-12">

            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <a class="btn btn-sm btn-primary mx-4 mt-4 float-end" href="addseller">Add New Seller</a>
                        <table id="table" class="table table-center table-hover ">
                            <thead class=" table-light ">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Seller</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Address</th>
                                    <th>Joined</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach ($buyers as $buyer)
                                    <tr>
                                        <td>{{ $i }}</td>@php $i=$i+1 @endphp
                                        <td>
                                            <h2 class="table-avatar">
                                                <div class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle"
                                                        src="" alt=""></div>
                                                <p>{{ $buyer->first_name . ' ' . $buyer->last_name }}</p>
                                            </h2>
                                        </td>
                                        <td>{{ $buyer->email }}</td>
                                        <td>{{ $buyer->phone }}</td>
                                        <td>{{ $buyer->gender }}</td>
                                        <td class="text-wrap">
                                            {{ 'Division: ' . $buyer->division . ', District: ' . $buyer->district . ', Sub-District/City-Corporation: ' . $buyer->sdcc . ', Union/Police-Sation: ' . $buyer->ups . ', Ward: ' . $buyer->ward . ', Village/Para/Mahalla: ' . $buyer->village . ', Postal-Code: ' . $buyer->pc }}
                                        </td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime( $buyer->created_at)) }}</td>
                                        <td class="text-right">
                                            <a href="" class="btn btn-info"><i class="far fa-edit"></i></a>
                                            <button href="" class="btn btn-danger"><i
                                                    class="far fa-trash-alt"></i></button>
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
