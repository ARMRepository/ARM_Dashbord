@extends('coinadmin.layout.base')

@section('title', 'Add Bonus ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('coinadmin.bonus.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a>

            <h5 style="margin-bottom: 2em;">Add Bonus</h5>

            <form class="form-horizontal" action="{{route('coinadmin.bonus.store')}}" method="POST" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label for="percentage" class="col-xs-12 col-form-label">Bonus Percentage (%)</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ old('percentage') }}" name="percentage" required id="percentage" placeholder="Bonus Percentage (%)">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="from" class="col-xs-12 col-form-label">From Date</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="date" value="{{ old('from') }}" name="from" required id="from" placeholder="Address">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="to" class="col-xs-12 col-form-label">To Date</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="date" value="{{ old('to') }}" name="to" required id="to" placeholder="Address">
                    </div>
                </div>
               
                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="{{ route('coinadmin.bonus.index') }}" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Add Bonus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
