@extends('coinadmin.layout.base')

@section('title', 'User details ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h4>User details</h4>
            <a href="{{ route('coinadmin.user.index') }}" class="btn btn-default pull-right">
                <i class="fa fa-angle-left"></i> Back
            </a>
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">User Name :</dt>
                        <dd class="col-sm-8">{{ $User->name }}</dd>


                        <dt class="col-sm-4">Email :</dt>
                        <dd class="col-sm-8">{{ $User->email }}</dd>

                        <dt class="col-sm-4">ETH Address :</dt>
                        <dd class="col-sm-8">{{ $User->coin_address }}</dd>


                        <dt class="col-sm-4">{{ico()}} Balance :</dt>
                        <dd class="col-sm-8">{{ $User->ico_balance + $User->ico_bonus }}</dd>


                        <dt class="col-sm-4">Divident + Payout (BTC Address) :</dt>
                        <dd class="col-sm-8">{{ $User->btc_address }}</dd>

                    </dl>
                </div>
                <div class="col-md-12">
		            <h3> Transaction History</h3>
		            <table class="table table-striped table-bordered dataTable" id="table-2">
		                <thead>
		                    <tr>
		                       <th>ID</th>
		                        <th>User</th>
		                        <th>TXN</th>
		                        <th>Payment Method</th>
		                        <th>{{ ico() }} Quantity</th>
		                        <th>{{ ico() }} Price</th>
		                        <th>Price</th>
		                        <th>Status</th>
                        		<th>Date/Time</th>
		                        <th>Action</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    @foreach($User->transaction as $index => $history)
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
		                        <td>{{ currency($history->ico_price) }}</td>
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
                            		@if(($history->payment_mode == "BTC" || $history->payment_mode == "ETH") &&  $history->status != "success")
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
		                <tfoot>
		                    <tr>
		                       <th>ID</th>
		                        <th>User</th>
		                        <th>TXN</th>
		                        <th>Payment Method</th>
		                        <th>{{ ico() }} Quantity</th>
		                        <th>{{ ico() }} Price</th>
		                        <th>Price</th>
		                        <th>Status</th>
                        		<th>Date/Time</th>
		                        <th>Action</th>
		                    </tr>
		                </tfoot>
		            </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
