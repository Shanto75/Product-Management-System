@extends('admin.header-footer')
@section('admin_content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table">
                <div class="card-body">
                    <div class="table-responsive">
                        <a class="btn btn-sm btn-primary mx-4 mt-4 float-end" href="addrider">Add New Rider</a>
                        <table id="table" class="table table-center table-hover ">
                            <thead class=" table-light ">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Rider</th>
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
                                @foreach ($riders as $rider)
                                    <tr>
                                        <td>{{ $i }}</td>@php $i=$i+1 @endphp
                                        <td>
                                            <h2 class="table-avatar">
                                                <div class="avatar avatar-sm me-2"><img class="avatar-img rounded-circle"
                                                        src="" alt=""></div>
                                                <p>{{ $rider->first_name . ' ' . $rider->last_name }}</p>
                                            </h2>
                                        </td>
                                        <td>{{ $rider->email }}</td>
                                        <td>{{ $rider->phone }}</td>
                                        <td>{{ $rider->gender }}</td>
                                        <td class="text-wrap">
                                            {{ 'Division: ' . $rider->division . ', District: ' . $rider->district . ', Sub-District/City-Corporation: ' . $rider->sdcc . ', Union/Police-Sation: ' . $rider->ups . ', Ward: ' . $rider->ward . ', Village/Para/Mahalla: ' . $rider->village . ', Postal-Code: ' . $rider->pc }}
                                        </td>
                                        <td>{{ date('d/m/Y H:i:s', strtotime( $rider->created_at)) }}</td>
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
