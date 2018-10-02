@extends('layouts.app')

@section('content')

    <div class="referral-section">
        <div class="container">
            <div class="transaction_balance">
                <!-- <h1 class="text-center">Give 4% Discount. Get 4% Bonus.</h1> -->
                <h4>Join our referral program. Share your unique link, refer friends and gain 4% {{ico()}} tokens your friends have bought. Your friends will also get 4% bonus for using your link. Win-win for both.</h4>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 referral-grid">
                    <h4>1</h4>
                    <p>Share your unique link and refer friends.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 referral-grid">
                    <h4>2</h4>
                    <p>Gain 4% {{ico()}} tokens your friends have bought.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 referral-grid">
                    <h4>3</h4>
                    <p>Your friends will also get 4% bonus for using your link.</p>
                </div>
                <div class="info-referral">
                    <p> If you are paying by Smart Contract, your referral bonus must be applied manually. To get the bonus, Referrer and Referee should both do the following: go to the Miner One Wallet and under Profile Settings enter your ether wallet addresses. We will then be able to match referrer and referee. This can be done after your transaction is completed. We will send you your bonus before the end of the ICO</p>
                </div>
                <form>
                    <div class="form-group">
                        <input type="text" id="refer-link" value="{{ url('register?referral='.Auth::user()->name) }}">
                        <button  type=button onclick="myFunction()">copy to clipboard</button>
                    </div>
                </form>
                <script>
                    function myFunction() {
                        var copyText = document.getElementById("refer-link");
                        copyText.select();
                        document.execCommand("Copy");
                    }
                </script>
                <ul>
                    <li class="fb"><a href="https://www.facebook.com/dialog/feed?app_id=156593865038075&display=popup&amp;caption=AARNAV&link={{ url('register?referral='.Auth::user()->name) }}&redirect_uri={{ url('referral') }}"><i class="fa fa-facebook"></i> Share via Facebook</a></li>
                    <li class="tw"><a href="http://twitter.com/share?text=AARNAV+Referral+Program&url={{ url('register?referral='.Auth::user()->name) }}"><i class="fa fa-twitter-square"></i> Share via Twitter</a></li>
                    <li class="em"><a href="mailto:?subject=AARNAV Referral Program&body=Hi, I found this website and thought you might like it {{ url('register?referral='.Auth::user()->name) }}"><i class="fa fa-envelope"></i> Share via Email</a></li>
                </ul>
            </div>
            <div class="transaction_balance">
                <div class="section-title">
                    <h4>Referrals</h4>
                </div>
                @if(count($User))

                    <div class="table-responsive">
                    <table class="table" id="myTable">
                      <thead>
                        <tr>           
                          <th scope="col"><span>S.No </span></th>
                          <th scope="col"><span>Name</span></th>
                          <th scope="col"><span>Date</span></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($User as $key => $user)
                            <tr>
                              <td>{{ $key + 1 }}</td>
                              <td>{{$user->name}}</td>
                              <td>{{$user->created_at}}</td>
                            </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
                @else
                    <div class="referral_got_count">
                        <p>You have no referrals. Invite your friends to get bonuses.</p>
                    </div>
                @endif
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
    #myTable td:nth-of-type(1):before { content: "S.No" ; }
    #myTable td:nth-of-type(2):before { content: "Name"; }
    #myTable td:nth-of-type(3):before { content: "Date"; }

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