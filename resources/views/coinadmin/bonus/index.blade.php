@extends('coinadmin.layout.base')

@section('title', 'Bonus Lists ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
         
            <a href="{{ route('coinadmin.bonus.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Bonus</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bonus Percentage (%)</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Bonus as $index => $bonus)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $bonus->percentage }}</td>
                        <td>{{ $bonus->from }}</td>
                        <td>{{ $bonus->to }}</td>
                        <td>
                            <form action="{{ route('coinadmin.bonus.destroy', $bonus->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                               
                                <a href="{{ route('coinadmin.bonus.edit', $bonus->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i>Edit</a>
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>
                                
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Bonus Percentage (%)</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection