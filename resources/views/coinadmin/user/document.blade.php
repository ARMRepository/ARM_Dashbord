@extends('coinadmin.layout.base')

@section('title', 'User Documents ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
        

        <div class="box box-block bg-white">
            <h5 class="mb-1">User Document</h5>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Document Type</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Doc as $Index => $Document)
                    <tr>
                        <td>{{ $Index + 1 }}</td>
                        <td>{{ $Document->document->name }}</td>
                        <td><a href="{{ img($Document->url) }}" target="_blank">View</a></td>
                        <td>@if($Document->status == "DISAPPROVED")
                                UNAPPROVED
                            @else
                            {{ $Document->status}}
                            @endif
                        </td>
                        <td>
                            <div class="col-xs-6">
                            <form action="{{ route('coinadmin.userdocument.approve')}}" method="POST">
                                {{ csrf_field() }}
                                
                                <input type="hidden" name="status" value="APPROVED">
                                <input type="hidden" name="user_id" value="{{$Document->user->id}}">
                                <input type="hidden" name="doc_id" value="{{$Document->document_id}}">
                                <button class="btn btn-block btn-success" type="submit">Approve</button>
                            </form>
                            </div>

                            <div class="col-xs-6">
                                <form action="{{ route('coinadmin.userdocument.approve')}}" method="POST">
                                {{ csrf_field() }}
                                
                                <input type="hidden" name="status" value="DISAPPROVED">
                                <input type="hidden" name="user_id" value="{{$Document->user->id}}">
                                <input type="hidden" name="doc_id" value="{{$Document->document_id}}">
                                <button class="btn btn-block btn-danger" type="submit">Reject</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Document Type</th>
                        <th>Document</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection