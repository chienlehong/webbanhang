@extends('layouts.app')

@section('content')
    @php
        $order = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();
    @endphp
    <div class="contact-form">
        <div class="container">
            <div class="row">
                <div class="col-8 card">
                    <table class="table table-response">
                        <thead>
                            <tr>
                                <th scope="col">Payment Type </th>
                                <th scope="col">Return </th>
                                <th scope="col">Amount </th>
                                <th scope="col">Date </th>
                                <th scope="col">Status </th>
                                <th scope="col">Status Code </th>
                                <th scope="col">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $row)
                                <tr>
                                    <td scope="col">{{ $row->payment_type }} </td>
                                    <td scope="col">
                                        @if ($row->return_order == 0)
                                            <span class="badge badge-warning">No Request</span>
                                        @elseif($row->return_order == 1)
                                            <span class="badge badge-info">Pending</span>
                                        @elseif($row->return_order == 2)
                                            <span class="badge badge-warning">Success</span>
                                        @endif
                                    </td>
                                    <td scope="col">{{ $row->total }}$ </td>
                                    <td scope="col">{{ $row->date }} </td>
                                    <td scope="col">
                                        @if ($row->status == 0)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($row->status == 1)
                                            <span class="badge badge-info">Payment Accept</span>
                                        @elseif($row->status == 2)
                                            <span class="badge badge-warning">Progress</span>
                                        @elseif($row->status == 3)
                                            <span class="badge badge-success">Delevered</span>
                                        @else
                                            <span class="badge badge-danger">Cancle</span>
                                        @endif

                                    </td>


                                    <td scope="col">{{ $row->status_code }} </td>
                                    <td scope="col">
                                        @if ($row->return_order == 0)
                                            <a href="{{ url('request/return/' . $row->id) }}" class="btn btn-sm btn-danger"
                                                id="return">Return</a>
                                        @elseif($row->return_order == 1)
                                            <span class="badge badge-info">Pending</span>
                                        @elseif($row->return_order == 2)
                                            <span class="badge badge-warning">Success</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                <div class="col-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/man2.jpg') }}"
                            style="height: 100px;width:100px;margin-left:34%;margin-top:20px" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                {{ Auth::user()->name }}
                            </h5>
                        </div>
                        <div class="list-group list-group-flush">
                            <ul>
                                <li class="list-group-item"><a href="{{ route('password.change') }}">Change Password</a>
                                </li>
                                <li class="list-group-item">Edit Profile</li>
                                <li class="list-group-item"><a href="{{ route('success.orderlist') }}">Return Order</a></li>
                            </ul>
                            <div class="card-body">
                                <a href="{{ route('user.logout') }}" onclick="return confirm('Bạn có muốn đăng xuất ?')"
                                    class="btn btn-danger btn-sm btn-block">Logout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
