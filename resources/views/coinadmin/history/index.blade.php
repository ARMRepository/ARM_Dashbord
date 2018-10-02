@extends('coinadmin.layout.base')

@section('title', 'History')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
         
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
@endsection