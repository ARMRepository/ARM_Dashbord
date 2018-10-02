@extends('coinadmin.layout.base')

@section('title', 'List Users ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
         
            <!-- <a href="{{ route('coinadmin.cointype.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New User</a> -->
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>{{ico()}} Balance</th>
                        <th>Kyc Document</th>
                        <th>View</th>
                        <th>Add Coin</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($User as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->ico_balance + $user->ico_bonus }}</td>
                             <td>
                                <a href="{{ route('coinadmin.user.kycdoc', $user->id ) }}">View Document</a>
                            </td>
                            <td>
                                <a href="{{ route('coinadmin.user.history', $user->id ) }}">View History</a>
                            </td>
                            <td>
                                <a href="{{ route('coinadmin.user.add', $user->id ) }}">Add Coin</a>
                            </td>
                            <td>
                                @if($user->status == 0)
                                    <p style="color: #999900"> Waiting for approval</p>
                                @else
                                     <p  style="color: green"> Approved</p>
                                @endif

                            </td>
                            <td>
                                @if($user->status == 1)
                                <a class="btn btn-danger btn-block" href="{{ route('coinadmin.user.disapprove', $user->id ) }}">Hold</a>
                                @else
                                <a class="btn btn-success btn-block" href="{{ route('coinadmin.user.approve', $user->id ) }}">Approve</a>
                                @endif
                            </td>

                     
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>{{ico()}} Balance</th>
                        <th>Kyc Document</th>
                        <th>View</th>
                        <th>Add Coin</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection