@extends('coinadmin.layout.base')

@section('title', 'Contact Us')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
			<h5 style="margin-bottom: 2em;">Contact Us</h5>
            <form class="form-horizontal" action="{{url('/coinadmin/send/reply/'.$query->id)}}" method="POST" role="form">
            	{{csrf_field()}}
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">From : </label>
					<div class="col-xs-10">
						{{$query->name}} < {{$query->email}} >
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Phone : </label>
					<div class="col-xs-10">
						{{$query->phone}}
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Country : </label>
					<div class="col-xs-10">
						{{$query->country}}
					</div>
				</div>
                <div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Query : </label>
					<div class="col-xs-10">
						{{$query->message}}
					</div>
				</div>
                @if($query->is_replied == 1)
                    <div class="form-group row">
    					<label for="old_password" class="col-xs-12 col-form-label"> Reply : </label>
    					<div class="col-xs-10">
    					<?php echo 	html_entity_decode($query->reply);?>
    					</div>
    				</div>
                @else
            	<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Reply</label>
					<div class="col-xs-10">
                        <textarea class="form-control" name="reply" id="summary-ckeditor"></textarea>
                        <script>
                            CKEDITOR.replace( 'summary-ckeditor' );
                        </script>
					</div>
				</div>
				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Send Reply</button>
					</div>
				</div>
                @endif
			</form>
		</div>
    </div>
</div>

@endsection

<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'textarea' );
</script>
