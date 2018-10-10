@extends('coinadmin.layout.base')

@section('title', 'Newsletter Subscription')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            <div class="box box-block bg-white">
                <h5 class="mb-1">Newsletter Subscription</h5>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($queries as $index => $query)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$query->name}}</td>
                            <td>{{$query->email}}</td>
                            <td>{{$query->country}}</td>
                            <td>{{$query->phone}}</td>
                            <td><a href="{{ url('/coinadmin/query_view/'.$query->id) }}" class="btn btn-default" style="color: #008000;"> View </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Country</th>
                            <th>Message</th>
                        </tr>
                    </tfoot> -->
                </table>
            </div>

        </div>
    </div>
@endsection
