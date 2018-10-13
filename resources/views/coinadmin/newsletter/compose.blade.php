@extends('coinadmin.layout.base')

@section('title', 'Compose Newsletter')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

			<h5 style="margin-bottom: 2em;">Compose Newsletter</h5>

            <form class="form-horizontal" action="{{url('/coinadmin/send/newsletter')}}" method="POST" role="form">
            	{{csrf_field()}}
                <div class="form-group row">
					<label for="message" class="col-xs-12 col-form-label">Reply</label>
					<div class="col-xs-10">
                        <textarea class="form-control" name="message" id="summary-ckeditor"></textarea>
                        <script>
                            CKEDITOR.replace( 'summary-ckeditor' );
                        </script>
					</div>
				</div>
                @foreach($newsletters as $index => $newsletter)
                    <tr>
                        <td><input type="checkbox" name="subscription_email_id[]" value="{{$newsletter->email}}"></td>
                        <td>{{$newsletter->email}}</td>
                    </tr>
                @endforeach
                </tbody>



				<div class="form-group row">
					<label for="zipcode" class="col-xs-12 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Send Newsletter</button>
					</div>
				</div>

			</form>
		</div>
    </div>
</div>

@endsection

<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'textarea' );
</script>
