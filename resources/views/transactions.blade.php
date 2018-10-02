@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="transaction_balance">
            <ul>
                <li><h1>Your {{ico()}} Balance:<span>{{ balance(Auth::user()->ico_balance + Auth::user()->ico_bonus) }} ARM Security Tokens</span></h1></li>
                {{--<li><h1>Referal Tokens: <a href="{{url('/referral')}}">Get Your Code</a><span>{{$referral_balance}} {{ico()}}</span></h1></li>--}}
            </ul>
        </div>

        <div class="transaction_balance">
            <div class="section-title">
                <h4>Transactions</h4>
            </div>
            <div class="table-responsive">
            <table class="table" id="myTable">
              <thead>
                <tr>           
                  <th scope="col"><span>ID</span></th>
                  <th scope="col"><span>Transaction</span></th>
                  <th scope="col"><span>Payment</span></th>
                  <th scope="col"><span>{{ico()}} Quantity</span></th>
                  <th scope="col"><span>{{ico()}} Price</span></th>
                  <th scope="col"><span>Price</span></th>
                  <th scope="col"><span>Status</span></th>
                  <th scope="col"><span>Date</span></th>
                </tr>
              </thead>
              <tbody>
                @forelse($Transactions as $index => $history)
                  <tr>
                      <td>{{ $index + 1 }}</td>
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

                  </tr>
                  @empty
                    <p>No record Found!</p>
                  @endforelse
              </tbody>
            </table>
            </div>
            <div class="text-center common-button">
                <button type="button" class="btn btn-primary btn-info-full next-step">PROCEED</button>
            </div>
        </div>
    </div>
@endsection

@section('styles')
<style type="text/css">
@media (max-width: 991px) {
    #myTable thead {
      display: none;
    }
    #myTable td {
      word-break: none;
    }
    #myTable td:nth-of-type(1):before { content: "ID" ; }
    #myTable td:nth-of-type(2):before { content: "Transaction"; }
    #myTable td:nth-of-type(3):before { content: "Payment"; }
    #myTable td:nth-of-type(4):before { content: "CTC Quantity"; }
    #myTable td:nth-of-type(5):before { content: "CTC Price"; }
    #myTable td:nth-of-type(6):before { content: "Price"; }
    #myTable td:nth-of-type(7):before { content: "Status"; }
    #myTable td:nth-of-type(8):before { content: "Date"; }

    #myTable td:first-child.dataTables_empty {
      text-align:  center;
      width:  100%;
    }

    #myTable td:first-child.dataTables_empty:before {
      display:  none;
    }

    #myTable td::before {
      width: 25%;
      display: inline-block;
    }
    #myTable td {
      padding: 10px !important;
      width: 100%;
      display: inline-block;
      text-align: left;
    }
    .transaction_balance table tbody tr th, .transaction_balance table tbody tr td {
      border: 1px solid #cacaca;
    }
    #myTable td:last-child {
      border-bottom: 0 !important;
    }
    #myTable tbody tr {
      margin: 20px 0;
      display: inline-block;
      width: 100%;
      border: 1px solid #cacaca;
  }
  .transaction_balance table tbody tr th, .transaction_balance table tbody tr td {
      border-bottom: 1px solid #cecece !important;
  }
}
</style>
@endsection