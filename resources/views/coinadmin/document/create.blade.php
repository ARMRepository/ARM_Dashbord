@extends('coinadmin.layout.base')

@section('title', 'Add Document ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('coinadmin.document.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back </a>

            <h5 style="margin-bottom: 2em;">Add Document</h5>

            <form class="form-horizontal" action="{{route('coinadmin.document.store')}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="name" class="col-xs-12 col-form-label">Document Name</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ old('name') }}" name="name" required id="name" placeholder="Document Name">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="order" class="col-xs-12 col-form-label">Document Order</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ old('order') }}" order="order" required id="order" placeholder="Document Order" name="order">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="order" class="col-xs-12 col-form-label">For USA Accredited</label>
                    <div class="col-xs-10">
                        <label class="checkbox-inline"><input type="radio" name="usa_accredited" value="1">Yes</label>
                        <label class="checkbox-inline"><input type="radio" name="usa_accredited" value="0">No</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="order" class="col-xs-12 col-form-label">In Download</label>
                    <div class="col-xs-10">
                        <label class="checkbox-inline"><input type="radio" name="download" value="1">Yes</label>
                        <label class="checkbox-inline"><input type="radio" name="download" value="0">No</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-xs-12 col-form-label">Document Display Image </label>
                    <div class="col-xs-10">
                        
                        <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="doc" class="col-xs-12 col-form-label">Download Document </label>
                    <div class="col-xs-10">
                        
                        <input type="file" name="doc" class="dropify form-control-file" id="doc" aria-describedby="fileHelp">
                    </div>
                </div>

              

                <div class="form-group row">
                    <label for="zipcode" class="col-xs-12 col-form-label"></label>
                    <div class="col-xs-10">
                        <button type="submit" class="btn btn-primary">Add Document</button>
                        <a href="{{route('coinadmin.document.index')}}" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
