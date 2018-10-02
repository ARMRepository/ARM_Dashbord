@extends('coinadmin.layout.base')

@section('title', 'Documents ')

@section('content')

    <div class="content-area py-1">
        <div class="container-fluid">
            
            <div class="box box-block bg-white">
           
                <h5 class="mb-1">Document</h5>
                <a href="{{ route('coinadmin.document.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add Document</a>
                <table class="table table-striped table-bordered dataTable" id="table-2">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Document Name</th>
                            <th>USA Accredited</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $index => $document)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$document->name}}</td>
                            <td>{{($document->usa_accredited == 1) ? 'Yes' : 'No'}}</td>
                            <td>{{$document->type}}</td>
                            <td>
                                <form action="{{ route('coinadmin.document.destroy', $document->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="DELETE">
                                    @if( Setting::get('demo_mode') == 0)
                                    <a href="{{ route('coinadmin.document.edit', $document->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                    <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>
                                    @endif
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Document Name</th>
                            <th>USA Accredited</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
        </div>
    </div>
@endsection