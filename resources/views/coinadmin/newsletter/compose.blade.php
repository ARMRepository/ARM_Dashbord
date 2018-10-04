@extends('coinadmin.layout.base')

@section('title', 'Compose Newsletter')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">

			<h5 style="margin-bottom: 2em;">Compose Newsletter</h5>

            <form class="form-horizontal" action="{{url('/send/newsletter')}}" method="POST" role="form">
            	{{csrf_field()}}

            	<div class="form-group row">
					<label for="old_password" class="col-xs-12 col-form-label">Message</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" name="message" id="message" placeholder="Message">
					</div>
				</div>
                <tbody>
                @foreach($newsletters as $index => $newsletter)
                    <tr>
                        <td><input type="checkbox" name="subscription_email_id[]"></td>
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
