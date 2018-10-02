@extends('coinadmin.layout.base')

@section('title', 'Update Document ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
    	    <a href="{{ route('coinadmin.document.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a>

			<h5 style="margin-bottom: 2em;">Update Document</h5>

            <form class="form-horizontal" action="{{route('coinadmin.document.update', $document->id )}}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}
            	<input type="hidden" name="_method" value="PATCH">
				<div class="form-group row">
					<label for="name" class="col-xs-2 col-form-label">Document Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ $document->name }}" name="name" required id="name" placeholder="Document Name">
					</div>
				</div>

				<div class="form-group row">
                    <label for="order" class="col-xs-2 col-form-label">Document Order</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="number" value="{{ $document->order }}" order="order" required id="order" placeholder="Document order" name="order">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="order" class="col-xs-12 col-form-label">For USA Accredited</label>
                    <div class="col-xs-10">
                        <label class="checkbox-inline"><input type="radio" name="usa_accredited" value="1" @if($document->usa_accredited == 1) checked @endif>Yes</label>
                        <label class="checkbox-inline"><input type="radio" name="usa_accredited" value="0" @if($document->usa_accredited == 0) checked @endif>No</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="order" class="col-xs-12 col-form-label">In Download</label>
                    <div class="col-xs-10">
                        <label class="checkbox-inline"><input type="radio" name="download" value="1" @if($document->download == 1) checked @endif>Yes</label>
                        <label class="checkbox-inline"><input type="radio" name="download" value="0" @if($document->download == 1) checked @endif>No</label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-xs-2 col-form-label">Document Image</label>
                    <div class="col-xs-10">

                    	@if($document->image !='')
	                    <img style="height: 90px; margin-bottom: 15px;" src="{{ img($document->image) }}">
	                    @endif
                        
                        <input type="file" accept="image/*" name="image" class="dropify form-control-file" id="image" aria-describedby="fileHelp" value="{{ $document->image }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="doc" class="col-xs-2 col-form-label">Download Document</label>
                    <div class="col-xs-10">
                        
                        <input type="file" accept="doc/*" name="doc" class="dropify form-control-file" id="doc" aria-describedby="fileHelp" value="{{ $document->doc }}">
                    </div>
                </div>

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Document</button>
						<a href="{{route('coinadmin.document.index')}}" class="btn btn-default">Cancel</a>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>

@endsection
