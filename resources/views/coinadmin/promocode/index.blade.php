@extends('coinadmin.layout.base')

@section('title', 'Promocode Lists ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
         
            <a href="{{ route('coinadmin.promocode.create') }}" style="margin-left: 1em;" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Add New Promocode</a>
            <table class="table table-striped table-bordered dataTable" id="table-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Promocode</th>
                        <th>Percentage (%)</th>
                        <th>Expiration</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Promocode as $index => $promocode)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $promocode->promo_code }}</td>
                        <td>{{ $promocode->percentage }}</td>
                        <td>{{ $promocode->expiration }}</td>
                        <td>
                            <form action="{{ route('coinadmin.promocode.destroy', $promocode->id) }}" method="POST">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                               
                                <a href="{{ route('coinadmin.promocode.edit', $promocode->id) }}" class="btn btn-info"><i class="fa fa-pencil"></i>Edit</a>
                                <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i>Delete</button>
                                
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Promocode</th>
                        <th>Percentage (%)</th>
                        <th>Expiration</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection