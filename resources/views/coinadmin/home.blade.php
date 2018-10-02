@extends('coinadmin.layout.base')

@section('title', 'Dashboard ')

@section('styles')
    <link rel="stylesheet" href="{{asset('main/vendor/jvectormap/jquery-jvectormap-2.0.3.css')}}">
@endsection

@section('content')
<div class="content-area py-1">
<div class="container-fluid">
    <div class="row row-md">
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg_card_1"></span><i class="ti-rocket"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">BTC</h6>
					<h1 class="mb-1">1 BTC = {{currency($bitstampdetails)}}</h1>
					
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg_card_2"></span><i class="ti-bar-chart"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">ETH</h6>
					<h1 class="mb-1">1 ETH = {{currency($etherscandetails)}}</h1>
					
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-6 col-xs-12">
			<div class="box box-block bg-white tile tile-1 mb-2">
				<div class="t-icon right"><span class="bg_card_1"></span><i class="ti-bar-chart"></i></div>
				<div class="t-content">
					<h6 class="text-uppercase mb-1">XRP</h6>
					<h1 class="mb-1">1 XRP = {{currency($xrpusddetails)}}</h1>
					
				</div>
			</div>
		</div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
                <div class="t-icon right"><span class="bg_card_2"></span><i class="ti-bar-chart"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase mb-1">{{ico()}}</h6>
                    <h1 class="mb-1">1 {{ico()}} = {{ currency(Setting::get('coin_price')) }}</h1>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
                <div class="t-icon right"><span class="bg_card_2"></span><i class="ti-bar-chart"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase mb-1">Sold {{ico()}}</h6>
                    <h1 class="mb-1">{{ $Card['total_ico'] }}</h1>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
                <div class="t-icon right"><span class="bg_card_2"></span><i class="ti-bar-chart"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase mb-1">Total BTC</h6>
                    <h1 class="mb-1">{{ round($Card['total_btc'], 8) }}</h1>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
                <div class="t-icon right"><span class="bg_card_2"></span><i class="ti-bar-chart"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase mb-1">Total ETH</h6>
                    <h1 class="mb-1">{{ round($Card['total_eth'], 8) }}</h1>
                    
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-xs-12">
            <div class="box box-block bg-white tile tile-1 mb-2">
                <div class="t-icon right"><span class="bg_card_2"></span><i class="ti-bar-chart"></i></div>
                <div class="t-content">
                    <h6 class="text-uppercase mb-1">Total XRP</h6>
                    <h1 class="mb-1">{{ round($Card['total_xrp'], 8) }}</h1>
                    
                </div>
            </div>
        </div>
		
    </div>

<div class="row row-md mb-2">
		<div class="col-md-12">
				<div class="box bg-white">
					<div class="box-block clearfix">
						<h5 class="float-xs-left"> Recent Transactions</h5>
						<div class="float-xs-right">
							<button class="btn btn-link btn-sm text-muted" type="button"><i class="ti-close"></i></button>
						</div>
					</div>
					<table class="table mb-md-0">
						<th>ID</th>
						 <th>User</th>
                        <th>TXN</th>
                        <th>Payment Method</th>
                        <th>{{ ico() }}</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Date/Time</th>
                        <th>Action</th>
						<tbody>
                    @foreach($History as $index => $history)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $history->user->name }}</td>
                        <td>
                            @if($history->payment_mode == 'BTC')
                                <a target="_blank" href="https://blockchain.info/tx/{{ $history->payment_id }}">
                            @elseif($history->payment_mode == 'ETH')
                                <a target="_blank" href="https://etherscan.io/tx/{{ $history->payment_id }}">
                            @elseif($history->payment_mode == 'XRP')
                                <a target="_blank" href="https://xrpcharts.ripple.com/#/transactions/{{ $history->payment_id }}">
                            @endif
                                {{substr($history->payment_id, 0, 8).'****'}}
                            </a>
                        </td>
                        <td>{{ $history->payment_mode }}</td>
                        <td>{{ $history->ico }}</td>
                        <td>{{ $history->price }}</td>
                        @if($history->status == "pending")
                        <td style="color: #fc8019;">{{ $history->status }}</td>
                        @elseif($history->status == "processing")
                        <td style="color: #CCCC00;">{{ $history->status }}</td>
                        @elseif($history->status == "success")
                        <td style="color: #008000;">{{ $history->status }}</td>
                        @elseif($history->status == "failed")
                        <td style="color: #FF0000;">{{ $history->status }}</td>
                        @endif
                        <td>{{ date('d M Y H:i:s', strtotime($history->created_at)) }}</td>
                        <td>
                            @if(($history->payment_mode == "BTC" || $history->payment_mode == "ETH" || $history->payment_mode == "USD") &&  $history->status != "success")
                            <div class="input-group-btn">
                               
                                <button type="button" 
                                    class="btn btn-info btn-block dropdown-toggle"
                                    data-toggle="dropdown">Action
                                    <span class="caret"></span>
                                </button>

                                <ul class="dropdown-menu">

                                    <li>
                                        <a href="{{ route('coinadmin.history.success', $history->id ) }}" class="btn btn-default" style="color: #008000;"> Success </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('coinadmin.history.failed', $history->id ) }}" class="btn btn-default" style="color: #FF0000;"> Failed </a>
                                    </li>
                                     
                                </ul>

                            </div> 
                            @else
                            <span class="btn btn-default" style="color: #008000;">RECEIVED</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
					</table>
				</div>
			</div>

		</div>
	</div>
@endsection
