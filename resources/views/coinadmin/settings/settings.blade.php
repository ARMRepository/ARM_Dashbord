@extends('coinadmin.layout.base')

@section('title', 'Site Settings ')

@section('content')

<div class="content-area py-1">
    <div class="container-fluid">
    	<div class="box box-block bg-white">
			<h5>Site Settings</h5>

            <form class="form-horizontal" action="{{ route('coinadmin.settings.store') }}" method="POST" enctype="multipart/form-data" role="form">
            	{{csrf_field()}}

				<div class="form-group row">
					<label for="site_title" class="col-xs-2 col-form-label"> Site Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('site_title', 'Ico Investors')  }}" name="site_title" required id="site_title" placeholder="Site Name">
					</div>
				</div>

				

				<div class="form-group row">
					<label for="site_logo" class="col-xs-2 col-form-label">Site Logo</label>
					<div class="col-xs-10">
						@if(Setting::get('site_logo')!='')
	                    <img style="height: 90px; margin-bottom: 15px;" src="{{ img(Setting::get('site_logo', asset('logo-black.png'))) }}">
	                    @endif
						<input type="file" accept="image/*" name="site_logo" class="dropify form-control-file" id="site_logo" aria-describedby="fileHelp">
					</div>
				</div>


				<div class="form-group row">
					<label for="site_icon" class="col-xs-2 col-form-label">Site Icon</label>
					<div class="col-xs-10">
						@if(Setting::get('site_icon')!='')
	                    <img style="height: 90px; margin-bottom: 15px;" src="{{ img(Setting::get('site_icon')) }}">
	                    @endif
						<input type="file" accept="image/*" name="site_icon" class="dropify form-control-file" id="site_icon" aria-describedby="fileHelp">
					</div>
				</div>

                <div class="form-group row">
                    <label for="tax_percentage" class="col-xs-2 col-form-label">Copyright Content</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ Setting::get('site_copyright', '&copy; '.date('Y').' Appoets') }}" name="site_copyright" id="site_copyright" placeholder="Site Copyright">
                    </div>
                </div>

				<!-- <div class="form-group row">
					<label for="store_link_android" class="col-xs-2 col-form-label">Playstore link</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('store_link_android', '')  }}" name="store_link_android"  id="store_link_android" placeholder="Playstore link">
					</div>
				</div>

				<div class="form-group row">
					<label for="store_link_ios" class="col-xs-2 col-form-label">Appstore Link</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('store_link_ios', '')  }}" name="store_link_ios"  id="store_link_ios" placeholder="Appstore link">
					</div>
				</div> -->

				<div class="form-group row">
					<label for="" class="col-xs-2 col-form-label">Coin Name</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('coin_name')  }}" name="coin_name" required id="coin_name" placeholder="Coin Name">
					</div>
				</div>
				<div class="form-group row">
					<label for="" class="col-xs-2 col-form-label">Coin Symbol</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('coin_symbol')  }}" name="coin_symbol" required id="coin_symbol" placeholder="Coin Symbol">
					</div>
				</div>

				<div class="form-group row">
					<label for="" class="col-xs-2 col-form-label">Contract Address ({{ ico() }})</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('coin_address')  }}" name="coin_address" required id="coin_address" placeholder="Contract Address">
					</div>
				</div>

				<div class="form-group row">
					<label for="" class="col-xs-2 col-form-label">{{ ico() }} Amount (Per {{ ico() }})</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('coin_price')  }}" name="coin_price" required id="coin_price" placeholder="Coin Price">
					</div>
				</div>

				<div class="form-group row">
					<label for="" class="col-xs-2 col-form-label">Referral Bonus {{ ico() }} (%)</label>
					<div class="col-xs-10">
						<input class="form-control" type="text" value="{{ Setting::get('referral_bonus')  }}" name="referral_bonus" required id="referral_bonus" placeholder="Referral Bonus">
					</div>
				</div>

				<div class="form-group row">
	                <label for="base_price" class="col-xs-2 col-form-label">Currency
	                    ( <strong>{{ Setting::get('currency', '$')  }} </strong>)
	                </label>
	                <div class="col-xs-10">
	                    <select name="currency" class="form-control" required>
	                        <option @if(Setting::get('currency') == "$") selected @endif value="$">US Dollar (USD)</option>
	                    </select>
	                </div>
	            </div>

	            <div class="form-group row">
					<label for="stripe_secret_key" class="col-xs-2 col-form-label"> Kyc Document Approval Required </label>
					<div class="col-xs-10">
						<div class="float-xs-left mr-1"><input @if(Setting::get('kyc_approval') == 1) checked  @endif  name="kyc_approval" type="checkbox" class="js-switch" data-color="#FF9800"></div>
					</div>
				</div>

				

				<div class="form-group row">
					<label for="zipcode" class="col-xs-2 col-form-label"></label>
					<div class="col-xs-10">
						<button type="submit" class="btn btn-primary">Update Site Settings</button>
					</div>
				</div>
			</form>
		</div>
    </div>
</div>
@endsection
