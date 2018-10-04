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
                            <th>Email</th>
                            <th>Is Active?</th>
                            <th>Make Active/Inactive</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($newsletters as $index => $newsletter)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$newsletter->email}}</td>
                            <td>{{$newsletter->status == 0 ? 'Active' : 'Inactive'}}</td>
                            <td><a href="{{ url('/coinadmin/subscription_status/'.$newsletter->id, $newsletter->status ) }}" class="btn btn-default" style="color: #008000;"> {{$newsletter->status == 0 ? 'Deactivate' : 'Activate'}} </a></td>
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
