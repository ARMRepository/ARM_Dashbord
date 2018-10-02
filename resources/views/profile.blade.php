@extends('layouts.app')

@section('content')

            <div class="user_details">
                <div class="container">

                    <div class="transaction_balance">
                        <div class="section-title">
                            <h1>Payouts / dividends from mining will be paid in Bitcoin</h1>
                        </div>
                        <form action="{{url('/btcaddress')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="btc_address" value="{{Auth::user()->btc_address}}" placeholder="Enter your BTC Address"><br><br>
                                <input type="text" name="btc_address_confirmation" value="{{Auth::user()->btc_address}}" placeholder="Confirm your BTC Address"><br><br>
                            </div>
                            <div class="text-center common-button">
                                <button type="submit" class="btn btn-primary btn-info-full next-step">Submit</button>
                            </div>
                        </form>
                    </div>

                    <div class="transaction_balance">
                        <div class="section-title">
                            <h1>Your ETH wallet</h1>
                            <h4>To receive {{ico()}} you'll need an ERC20-compliant ETH wallet.</h4>
                        </div>
                        <form action="{{url('/address')}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <input type="text" name="wallet_address" value="{{Auth::user()->coin_address}}">
                                <p>Don't use your exchange wallets for buying {{ico()}}.Use personal wallet only! Your ETH address must start with "0x", eg.: "0x1316f35873d5df1661719b9d1598d9ea29b7af4c".</p>
                            </div>
                            <div class="text-center common-button">
                                <button type="submit" class="btn btn-primary btn-info-full next-step">Save changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="transaction_balance">
                        <div class="section-title">
                            <h1>Personal information</h1>
                            <h4>All your personal data provided here will be handled and maintained confidentially</h4>
                        </div>
                        <form class="personal-details" action="{{url('/profile')}}" accept-charset="UTF-8" method="post">
                            {{csrf_field()}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Full name</label>
                                <input type="text" name="name" value="{{Auth::user()->name}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Email</label>
                                <input type="email" name="email" value="{{Auth::user()->email}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Phone Number</label>
                                <input type="number" name="mobile" value="{{Auth::user()->mobile}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Country</label>
                                <input type="text" name="country" value="{{Auth::user()->country}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>State</label>
                                <input type="text" name="state" value="{{Auth::user()->state}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>City</label>
                                <input type="text" name="city" value="{{Auth::user()->city}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Address</label>
                                <input type="text" name="address" value="{{Auth::user()->address}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Zip Code</label>
                                <input type="text" name="zip" value="{{Auth::user()->zip}}">
                            </div>
                            {{--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="disabled">BTC Wallet</label>
                                <input type="text" disabled value="{{balance(Auth::user()->BTC)}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="disabled">ETH Wallet</label>
                                <input type="text" disabled value="{{balance(Auth::user()->ETH)}}">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="disabled">XRP Wallet</label>
                                <input type="text" disabled value="{{balance(Auth::user()->XRP)}}">
                            </div>--}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center common-button">
                                <button type="submit" class="btn btn-primary btn-info-full next-step">Save changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="transaction_balance">
                        <div class="section-title">
                            <h1>Update Password</h1>
                            <h4>All your personal data provided here will be handled and maintained confidentially</h4>
                        </div>
                        <form class="personal-details" action="{{url('change/password')}}" method="post">
                            {{csrf_field()}}
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Current Password</label>
                                <input type="password" name="old_password" autocomplete="off">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>New Password</label>
                                <input type="password" name="password">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation">
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center common-button">
                                <button type="submit" class="btn btn-primary btn-info-full next-step">Save changes</button>
                            </div>
                        </form>
                    </div>

                    <div class="transaction_balance">
                        <form id="kyc">
                            <h4>Account status: 
                                @if(Auth::user()->status)
                                    <span class="success">Confirmed</span>
                                @else
                                    <span>Unconfirmed</span>
                                @endif
                            </h4>
                            <p>To confirm your account you will need to go though KYC proccess</p>
                            <div class="text-center common-button">
                                <a href="{{ url('/kyc') }}">
                                    <button type="button" class="btn btn-primary btn-info-full next-step">Start KYC Process</button>
                                </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

@endsection