@extends('layouts.app')

@section('content')
    <div class="step_wizard">
        <div class="container">
            <div class="wizard">
                <div class="wizard-inner">
                    <div class="connecting-line"></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab">
                                <span class="step_count">1</span> <span>Payment Methods</span>
                            </a>
                        </li> 
                        <li role="presentation" class="disabled">
                            <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab">
                                <span class="step_count">2</span> <span>Payment Setup</span>
                            </a>
                        </li>
                        <!-- <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab">
                                <span class="step_count">3</span> <span>Payment Setup</span>
                            </a>
                        </li> -->
                        <li role="presentation" class="disabled">
                            <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab">
                                <span class="step_count">3</span> <span>Transaction Details</span>
                            </a>
                        </li>
                        <!-- <li role="presentation" class="disabled">
                            <a href="#step5" data-toggle="tab" aria-controls="step5" role="tab">
                                <span class="step_count">5</span> <span>Confirm Details</span>
                            </a>
                        </li> -->
                    </ul>
                    @if($accredited == 1)
                    <div class="text-center margin-top-1">
                        <input type="checkbox" id="accredited"><span class="accredited-span">click to agree you are a accredited investors</span>
                    </div>
                    @endif
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                        <div class="row">
                            @foreach($cointype as $cointypes)
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center pay-method">
                                    <input type="radio" name="coin-type" id="sell-{{$cointypes->id}}" value="{{$cointypes->symbol}}" style="display: none;">
                                    <label for="sell-{{$cointypes->id}}">
                                        @if($cointypes->symbol == 'ETH')
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="256px" height="417px" viewBox="0 0 256 417" version="1.1" preserveAspectRatio="xMidYMid">
                                                <g>
                                                    <polygon points="127.9611 0 125.1661 9.5 125.1661 285.168 127.9611 287.958 255.9231 212.32" />
                                                    <polygon points="127.962 0 0 212.32 127.962 287.959 127.962 154.158" />
                                                    <polygon points="127.9611 312.1866 126.3861 314.1066 126.3861 412.3056 127.9611 416.9066 255.9991 236.5866" />
                                                    <polygon points="127.962 416.9052 127.962 312.1852 0 236.5852" />
                                                    <polygon points="127.9611 287.9577 255.9211 212.3207 127.9611 154.1587" />
                                                    <polygon points="0.0009 212.3208 127.9609 287.9578 127.9609 154.1588" />
                                                </g>
                                            </svg>
                                        @elseif($cointypes->symbol == 'XRP')
                                            <svg id="xrp" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 196.22 212.82">
                                                <path class="cls-1" d="M431,153.4c-7.52-4.34-16-5.6-24.39-5.9-7-.25-17.55-4.76-17.55-17.57,0-9.54,7.74-17.23,17.55-17.57,8.39-.29,16.86-1.55,24.39-5.9A44.45,44.45,0,1,0,364.31,68c0,8.61,3.06,16.54,7,23.89,3.29,6.18,4.95,17.66-6.32,24.16-8.39,4.84-18.85,1.78-24.08-6.59-4.42-7.07-9.75-13.69-17.21-18a44.45,44.45,0,1,0,0,77c7.46-4.31,12.79-10.92,17.21-18,3.62-5.8,12.67-13.19,24.08-6.6,8.37,4.84,11,15.44,6.32,24.17-3.91,7.35-7,15.27-7,23.88A44.45,44.45,0,1,0,431,153.4Z" transform="translate(-256.99 -23.53)"/>
                                            </svg>
                                        @elseif($cointypes->symbol == 'BTC')
                                            <svg id="bitcoin" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 475.074 475.074" style="enable-background:new 0 0 475.074 475.074;" xml:space="preserve">
                                                <path d="M395.655,249.236c-11.037-14.272-27.692-24.075-49.964-29.403c28.362-14.467,40.826-39.021,37.404-73.666   c-1.144-12.563-4.616-23.451-10.424-32.68c-5.812-9.231-13.655-16.652-23.559-22.266c-9.896-5.621-20.659-9.9-32.264-12.85   c-11.608-2.95-24.935-5.092-39.972-6.423V0h-43.964v69.949c-7.613,0-19.223,0.19-34.829,0.571V0h-43.97v71.948   c-6.283,0.191-15.513,0.288-27.694,0.288l-60.526-0.288v46.824h31.689c14.466,0,22.936,6.473,25.41,19.414v81.942   c1.906,0,3.427,0.098,4.57,0.288h-4.57v114.769c-1.521,9.705-7.04,14.562-16.558,14.562H74.747l-8.852,52.249h57.102   c3.617,0,8.848,0.048,15.703,0.134c6.851,0.096,11.988,0.144,15.415,0.144v72.803h43.977v-71.947   c7.992,0.195,19.602,0.288,34.829,0.288v71.659h43.965v-72.803c15.611-0.76,29.457-2.18,41.538-4.281   c12.087-2.101,23.653-5.379,34.69-9.855c11.036-4.47,20.266-10.041,27.688-16.703c7.426-6.656,13.559-15.13,18.421-25.41   c4.846-10.28,7.943-22.176,9.271-35.693C410.979,283.882,406.694,263.514,395.655,249.236z M198.938,121.904   c1.333,0,5.092-0.048,11.278-0.144c6.189-0.098,11.326-0.192,15.418-0.288c4.093-0.094,9.613,0.144,16.563,0.715   c6.947,0.571,12.799,1.334,17.556,2.284s9.996,2.521,15.701,4.71c5.715,2.187,10.28,4.853,13.702,7.993   c3.429,3.14,6.331,7.139,8.706,11.993c2.382,4.853,3.572,10.42,3.572,16.7c0,5.33-0.855,10.185-2.566,14.565   c-1.708,4.377-4.284,8.042-7.706,10.992c-3.423,2.951-6.951,5.523-10.568,7.71c-3.613,2.187-8.233,3.949-13.846,5.28   c-5.612,1.333-10.513,2.38-14.698,3.14c-4.188,0.762-9.421,1.287-15.703,1.571c-6.283,0.284-11.043,0.478-14.277,0.572   c-3.237,0.094-7.661,0.094-13.278,0c-5.618-0.094-8.897-0.144-9.851-0.144v-87.65H198.938z M318.998,316.331   c-1.813,4.38-4.141,8.189-6.994,11.427c-2.858,3.23-6.619,6.088-11.28,8.559c-4.66,2.478-9.185,4.473-13.559,5.996   c-4.38,1.529-9.664,2.854-15.844,4c-6.194,1.143-11.615,1.947-16.283,2.426c-4.661,0.477-10.226,0.856-16.7,1.144   c-6.469,0.28-11.516,0.425-15.131,0.425c-3.617,0-8.186-0.052-13.706-0.145c-5.523-0.089-9.041-0.137-10.565-0.137v-96.505   c1.521,0,6.042-0.093,13.562-0.287c7.521-0.192,13.656-0.281,18.415-0.281c4.758,0,11.327,0.281,19.705,0.856   c8.37,0.567,15.413,1.42,21.128,2.562c5.708,1.144,11.937,2.902,18.699,5.284c6.755,2.378,12.23,5.28,16.419,8.706   c4.188,3.432,7.707,7.803,10.561,13.134c2.861,5.328,4.288,11.42,4.288,18.274C321.712,307.104,320.809,311.95,318.998,316.331z" fill="#FFFFFF" />
                                            </svg>
                                        @elseif($cointypes->symbol == 'USD')
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="256px" height="417px" viewBox="0 0 14.994 14.994" style="enable-background:new 0 0 14.994 14.994;" xml:space="preserve">
                                                <g>
                                                    <path d="M12.774,11.67c-0.47,0.246-1.519,0.58-2.543,0.58c-1.116,0-2.166-0.334-2.879-1.139c-0.336-0.377-0.581-0.893-0.737-1.562
                                                    h5.602V7.965H6.304c0-0.111,0-0.222,0-0.357c0-0.246,0-0.467,0.021-0.692h5.893V5.332H6.661c0.158-0.58,0.378-1.093,0.715-1.45
                                                    c0.69-0.827,1.674-1.206,2.723-1.206c0.979,0,1.918,0.291,2.498,0.536l0.623-2.543C12.416,0.313,11.213,0,9.873,0
                                                    C7.754,0,5.968,0.847,4.72,2.299c-0.713,0.803-1.271,1.83-1.54,3.034H1.684v1.583h1.251c0,0.225-0.023,0.447-0.023,0.67
                                                    c0,0.133,0,0.27,0,0.379H1.684V9.55h1.452c0.201,1.185,0.646,2.142,1.249,2.9c1.251,1.651,3.235,2.544,5.443,2.544
                                                    c1.429,0,2.724-0.424,3.482-0.846L12.774,11.67z"/>
                                                </g>
                                            </svg>
                                        @endif
                                        <h4>{{$cointypes->symbol}} @if($cointypes->symbol == 'BTC') ({{currency($bitstampdetails)}}) @elseif($cointypes->symbol == 'ETH') ({{currency($etherscandetails)}}) @endif</h4>
                                        <p><span>Pay by {{$cointypes->name}}</span></p>
                                    </label>
                                </div>
                            @endforeach
                            <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center pay-method">
                                <input type="radio" name="coin-type" id="sell-4" checked="checked" style="display: none;">
                                <label for="sell-4">
                                    <svg id="litecoin" xmlns="http://www.w3.org/2000/svg" width="2500" height="2500" viewBox="0.847 0.876 329.254 329.256">
                                        <path d="M155.854 209.482l10.693-40.264 25.316-9.249 6.297-23.663-.215-.587-24.92 9.104 17.955-67.608h-50.921l-23.481 88.23-19.605 7.162-6.478 24.395 19.59-7.156-13.839 51.998h135.521l8.688-32.362h-84.601" fill="#fff" />
                                    </svg>
                                    <h4>LTC</h4>
                                    <p><span>Get {{ico()}} Tokens Every Day</span></p>
                                </label>
                            </div> -->
                        </div>
                        <ul class="list-inline">
                            <li class="pull-right">
                                <button type="button" disabled="disabled" class="btn btn-primary step-1 next-step">continue</button>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                        <div class="step2_contents">
                            <h4>
                                <svg id="bitcoin" class="BTC symbol" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 475.074 475.074" style="enable-background:new 0 0 475.074 475.074;" xml:space="preserve">
                                    <path d="M395.655,249.236c-11.037-14.272-27.692-24.075-49.964-29.403c28.362-14.467,40.826-39.021,37.404-73.666   c-1.144-12.563-4.616-23.451-10.424-32.68c-5.812-9.231-13.655-16.652-23.559-22.266c-9.896-5.621-20.659-9.9-32.264-12.85   c-11.608-2.95-24.935-5.092-39.972-6.423V0h-43.964v69.949c-7.613,0-19.223,0.19-34.829,0.571V0h-43.97v71.948   c-6.283,0.191-15.513,0.288-27.694,0.288l-60.526-0.288v46.824h31.689c14.466,0,22.936,6.473,25.41,19.414v81.942   c1.906,0,3.427,0.098,4.57,0.288h-4.57v114.769c-1.521,9.705-7.04,14.562-16.558,14.562H74.747l-8.852,52.249h57.102   c3.617,0,8.848,0.048,15.703,0.134c6.851,0.096,11.988,0.144,15.415,0.144v72.803h43.977v-71.947   c7.992,0.195,19.602,0.288,34.829,0.288v71.659h43.965v-72.803c15.611-0.76,29.457-2.18,41.538-4.281   c12.087-2.101,23.653-5.379,34.69-9.855c11.036-4.47,20.266-10.041,27.688-16.703c7.426-6.656,13.559-15.13,18.421-25.41   c4.846-10.28,7.943-22.176,9.271-35.693C410.979,283.882,406.694,263.514,395.655,249.236z M198.938,121.904   c1.333,0,5.092-0.048,11.278-0.144c6.189-0.098,11.326-0.192,15.418-0.288c4.093-0.094,9.613,0.144,16.563,0.715   c6.947,0.571,12.799,1.334,17.556,2.284s9.996,2.521,15.701,4.71c5.715,2.187,10.28,4.853,13.702,7.993   c3.429,3.14,6.331,7.139,8.706,11.993c2.382,4.853,3.572,10.42,3.572,16.7c0,5.33-0.855,10.185-2.566,14.565   c-1.708,4.377-4.284,8.042-7.706,10.992c-3.423,2.951-6.951,5.523-10.568,7.71c-3.613,2.187-8.233,3.949-13.846,5.28   c-5.612,1.333-10.513,2.38-14.698,3.14c-4.188,0.762-9.421,1.287-15.703,1.571c-6.283,0.284-11.043,0.478-14.277,0.572   c-3.237,0.094-7.661,0.094-13.278,0c-5.618-0.094-8.897-0.144-9.851-0.144v-87.65H198.938z M318.998,316.331   c-1.813,4.38-4.141,8.189-6.994,11.427c-2.858,3.23-6.619,6.088-11.28,8.559c-4.66,2.478-9.185,4.473-13.559,5.996   c-4.38,1.529-9.664,2.854-15.844,4c-6.194,1.143-11.615,1.947-16.283,2.426c-4.661,0.477-10.226,0.856-16.7,1.144   c-6.469,0.28-11.516,0.425-15.131,0.425c-3.617,0-8.186-0.052-13.706-0.145c-5.523-0.089-9.041-0.137-10.565-0.137v-96.505   c1.521,0,6.042-0.093,13.562-0.287c7.521-0.192,13.656-0.281,18.415-0.281c4.758,0,11.327,0.281,19.705,0.856   c8.37,0.567,15.413,1.42,21.128,2.562c5.708,1.144,11.937,2.902,18.699,5.284c6.755,2.378,12.23,5.28,16.419,8.706   c4.188,3.432,7.707,7.803,10.561,13.134c2.861,5.328,4.288,11.42,4.288,18.274C321.712,307.104,320.809,311.95,318.998,316.331z" fill="#FFFFFF"/>
                                </svg>
                                <svg id="litecoin" class="ETH symbol" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="256px" height="417px" viewBox="0 0 256 417" version="1.1" preserveAspectRatio="xMidYMid">
                                    <g>
                                        <polygon points="127.9611 0 125.1661 9.5 125.1661 285.168 127.9611 287.958 255.9231 212.32" />
                                        <polygon points="127.962 0 0 212.32 127.962 287.959 127.962 154.158" />
                                        <polygon points="127.9611 312.1866 126.3861 314.1066 126.3861 412.3056 127.9611 416.9066 255.9991 236.5866" />
                                        <polygon points="127.962 416.9052 127.962 312.1852 0 236.5852" />
                                        <polygon points="127.9611 287.9577 255.9211 212.3207 127.9611 154.1587" />
                                        <polygon points="0.0009 212.3208 127.9609 287.9578 127.9609 154.1588" />
                                    </g>
                                </svg>
                                <svg id="xrp" class="XRP symbol" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 196.22 212.82">
                                    <path class="cls-1" d="M431,153.4c-7.52-4.34-16-5.6-24.39-5.9-7-.25-17.55-4.76-17.55-17.57,0-9.54,7.74-17.23,17.55-17.57,8.39-.29,16.86-1.55,24.39-5.9A44.45,44.45,0,1,0,364.31,68c0,8.61,3.06,16.54,7,23.89,3.29,6.18,4.95,17.66-6.32,24.16-8.39,4.84-18.85,1.78-24.08-6.59-4.42-7.07-9.75-13.69-17.21-18a44.45,44.45,0,1,0,0,77c7.46-4.31,12.79-10.92,17.21-18,3.62-5.8,12.67-13.19,24.08-6.6,8.37,4.84,11,15.44,6.32,24.17-3.91,7.35-7,15.27-7,23.88A44.45,44.45,0,1,0,431,153.4Z" transform="translate(-256.99 -23.53)"/>
                                </svg>

                                <svg version="1.1" id="USD" class="USD symbol" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 14.994 14.994" style="enable-background:new 0 0 14.994 14.994;" xml:space="preserve">
                                    <g>
                                        <path d="M12.774,11.67c-0.47,0.246-1.519,0.58-2.543,0.58c-1.116,0-2.166-0.334-2.879-1.139c-0.336-0.377-0.581-0.893-0.737-1.562
                                            h5.602V7.965H6.304c0-0.111,0-0.222,0-0.357c0-0.246,0-0.467,0.021-0.692h5.893V5.332H6.661c0.158-0.58,0.378-1.093,0.715-1.45
                                            c0.69-0.827,1.674-1.206,2.723-1.206c0.979,0,1.918,0.291,2.498,0.536l0.623-2.543C12.416,0.313,11.213,0,9.873,0
                                            C7.754,0,5.968,0.847,4.72,2.299c-0.713,0.803-1.271,1.83-1.54,3.034H1.684v1.583h1.251c0,0.225-0.023,0.447-0.023,0.67
                                            c0,0.133,0,0.27,0,0.379H1.684V9.55h1.452c0.201,1.185,0.646,2.142,1.249,2.9c1.251,1.651,3.235,2.544,5.443,2.544
                                            c1.429,0,2.724-0.424,3.482-0.846L12.774,11.67z"/>
                                    </g>
                                </svg>

                                <span><span class="payment"></span> Payment (1 {{ico()}} = {{ Setting::get('coin_price') }} USD)</span>
                            </h4>
                            <ul class="calculation_ul">
                                <li>
                                    <div class="form-group">
                                        <label>Amount of {{ico()}} to buy</label>
                                        <input id="ico" type="number" step="any" name="quantity">
                                    </div>
                                </li>
                                <li class="hidden-xs">
                                    <span>=</span>
                                </li>
                                <li>
                                    <div class="form-group">
                                        <label>Sum To Spend in <span class="payment"></span></label>
                                        <input class="price" type="number" step="any" name="">
                                    </div>
                                </li>
                            </ul>
                            <ul class="calculation_result">
                                <li style="display: none;">
                                    <p><input id="promocode" type="text" name="promocode" placeholder="Promocode"><span class="promo-txt no-promo"></span></p>
                                </li>
                                <li>
                                    <p>Final price <span class="payment"></span> <span class="price">0.00</span></p>
                                </li>
                                @if(count($bonuses)>0)
                                    <li>
                                        <p>{{$bonuses[0]->percentage}}% Discount  <span>&nbsp;{{ico()}}</span><span id="bonus">  0.00</span></p>
                                        <input type="hidden" id="bonus_point" name="bonus_point" value="{{$bonuses[0]->percentage}}" />
                                    </li>
                                @endif
                                <li>
                                    <h4>Final {{ico()}} <span>&nbsp;{{ico()}}</span><span id="total">0.00  </span></h4>
                                </li>
                            </ul>
                        </div>
                        <ul class="list-inline">
                            <li>
                                <button type="button" class="btn btn-default prev-step">Back to payment options</button>
                            </li>
                            <li class="pull-right">
                                <button type="button" disabled="disabled" class="btn btn-primary step-2 next-step">next step</button>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="tab-pane" role="tabpanel" id="step3">
                        <div class="eth-address-seciton">
                            <h4>Your ETH wallet</h4>
                            <p><strong>To receive {{ico()}} you'll need an ERC20-compliant ETH wallet. If you don't have one, watch our tutorial video and create your ETH wallet for free at MyEtherWallet.com.</strong></p>
                            <div class="form-control">
                                <input type="text" placeholder="Ethereum Address" name="coin_address" value="{{ Auth::user()->coin_address }}" id="address">
                                <label style="color:red;display: block;text-align: center;" class="error_address"></label>
                            </div>
                            <p>Don't use your exchange wallets for buying {{ico()}}. Use personal wallet only! Your ETH address must start with "0x", eg.: "0x80d29f34570225bd21fe7c79c53425b3a4c71e71".</p>
                        </div>
                        <ul class="list-inline">
                            <li>
                                <button type="button" class="btn btn-default prev-step">Back to payment options</button>
                            </li>
                            <li class="pull-right">
                                <button type="button" @if(!Auth::user()->coin_address) disabled="disabled" @endif class="btn btn-primary step-3 btn-info-full next-step">PROCEED ORDER</button>
                            </li>
                        </ul>
                    </div> -->
                    <div class="tab-pane" role="tabpanel" id="step3">
                        <div class="tab-top">
                            <h4><span class="payment"></span> Funds Only!</h4>
                            <p>Send only <span class="payment"></span> to this address. The tokens will be <span> credited after we get confirmation from the network.</span></p>
                            <p><span>Please note</span> that the address for this funding is unique and can only be used once.</p>
                        </div>
                        <div class="QR-Code">
                            <p>send <span class="amount price">0.0000000</span><strong> <span class="payment"></span></strong> to this address:</p>
                            @foreach($cointype as $cointypes)
                                @if($cointypes->symbol != 'USD')
                                    <div class="{{$cointypes->symbol}} qr-code" style="display: none;">
                                        <img class="img-responsive" src="{{ img($cointypes->qr_code) }}" width="200">

                                        @if($cointypes->symbol == "XRP")
                                            Destination Tag: <?php echo $dest_tag = mt_rand(100000000, 999999999); ?>
                                        @endif
                                        
                                        <div class="input-group">
                                            <input type="text" placeholder="{{$cointypes->symbol}} Address" value="{{$cointypes->address}}" id="address-{{$cointypes->symbol}}">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-theme" onclick="myFunction{{$cointypes->symbol}}()" >copy to clipboard</button>
                                            </span>
                                        </div>

                                        @if($cointypes->symbol == "XRP")
                                            <p>Destination Tag: {{ $dest_tag }}</p>
                                        @endif

                                        <script>
                                            function myFunction{{$cointypes->symbol}}() {
                                                var copyText = document.getElementById("address-{{$cointypes->symbol}}");
                                                copyText.select();
                                                document.execCommand("Copy");
                                            }
                                        </script>
                                    </div>
                                @else
                                    <div class="{{$cointypes->symbol}} qr-code" style="display: none;">
                                        <div class="paymentdet">
                                            <h3 class="text-center">Payment Details</h3>
                                            <h2>DOMESTIC WIRE ROUTING TRANSIT (ABA#): 021 201 383</h2>
                                            <h2>INTERNATIONAL SWIFT/BIC code: <strong>MBNYU33</strong></h2>
                                            <p>Bank Name: <strong>Valley National Bank</strong></p>
                                            <p>Beneficiary Acct #: <strong>418 95 207</strong></p>
                                            <p>Beneficiary Name: <strong>AARNAV INC.</strong></p>
                                            <p>Beneficiary Address: <strong>546 C PLAINVIEW ROAD, PLAINVIEW, NEW YORK 11803 USA</strong></p>
                                        </div>
                                        <div class="text-right common-button">
                                            <button type="button" class="btn btn-primary btn-info-full next-step" data-toggle="modal" data-target="#squarespaceModal">SEND</button>
                                        </div>
                                    </div>
                                @endif
                                @if($cointypes->symbol == "XRP")
                                    <?php 
                                        $ripple_addr = $cointypes->address;
                                    ?>
                                    <h3 id="waiting-msg-{{$cointypes->name}}">
                                        <i class="fa fa-circle-o-notch fa-spin"></i>
                                        Awaiting Payment...
                                    </h3>
                                @endif
                            @endforeach
                            <form method="post" action="{{url('transaction')}}" id="transaction_form">
                                {{csrf_field()}}
                                <!-- <label>Transaction ID</label> -->

                                <input type="hidden"  id="amount_ctc"  name="amount_ctc" required="">
                                <input type="hidden" id="amount_new"  name="amount_new" required="">
                                <input type="hidden" id="promo_code"  name="promo_code" required="">
                                <input type="hidden" id="cointype"  name="cointype" required="">
                                <input type="hidden" id="coin_address"  name="coin_address" required="">
                                <input type="hidden" id="frm_referal_code"  name="referal_code" value="0">
                                
                                @if(count($bonuses)>0)
                                    <input type="hidden"  name="bonus_point" value="{{$bonuses[0]->percentage}}" />
                                @else
                                    <input type="hidden"  name="bonus_point" value="0" />
                                @endif



                                <div class="input-group">
                                    <input type="text" placeholder="Transaction Id" name="tranx_id" id="tranx_id">
                                    <span class="input-group-btn">
                                        <button type="button" id="btn-token-promocode-add-new" disabled="" class="btn btn-theme col-md-12 next_btn trans-btn step-3" >Submit</button>
                                    </span>
                                </div>
                                <label style="color:red;display: block;" class="error_tranx_id"></label>
                            </form>
                            <!-- <p class="received-amount">Amount Received: <span class="amount price">0.000000</span><strong> <span class="payment"></span></strong></p> -->
                        </div>
                        <ul class="list-inline">
                            <li>
                                <button type="button" class="btn btn-default prev-step">Back to payment options</button>
                            </li>
                            <li class="pull-right">
                                <a href="{{ url('/transaction') }}" disabled="disabled" class="btn btn-primary step-3 btn-info-full next-step">CHECK MY BALANCE</a>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="tab-pane" role="tabpanel" id="step5">
                        <div class="eth-address-seciton">
                            <h4>Confirm Your E-mail</h4>
                            <form>
                                <div class="form-control">
                                    <input type="email" placeholder="Enter Your E-mail" name="">
                                </div>
                            </form>
                            <p><strong>If you have purchased {{ico()}} through our Smart Contract it is necessary that your enter your ETH wallet address here:</strong></p>
                            <form>
                                <div class="form-control">
                                    <input type="text" placeholder="Ethereum Address" name="">
                                </div>
                            </form>
                        </div>
                        <ul class="list-inline pull-right">
                            <li class="pull-right">
                                <button type="button" class="btn btn-primary btn-info-full next-step">PROCEED</button>
                            </li>
                        </ul>
                    </div> -->
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

<!-- PAYMENT SECTION START -->
<!-- MODAL FUNCTION START -->
<!-- line modal -->
<div class="modal fade paymentmodal" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" id="lineModalLabel"><span class="payment"></span> Payment</h3>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Thanks for initiating the purchase.</h5>
                <p class="text-center">Invoice has been sent to your email.Please use the below bank information to process the payment.</p>
                <p class="text-center">Tokens will be sent out, The moment your payment arrived.</p>
            </div>
        </div>
    </div>
</div>

<button style="display: none;" type="button" class="USD-Popup" data-toggle="modal" data-target="#USD-Popup">SEND</button>
<div class="modal fade paymentmodal" id="USD-Popup" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button> -->
                <h3 class="modal-title" id="lineModalLabel">Profile Update</h3>
            </div>
            <div class="modal-body">
                <p class="text-center">Please update your profile before purchasing.</p>
                <h5 class="text-center"><a href="{{url('/profile')}}">Update</a></h5>
            </div>
        </div>
    </div>
</div>
<!-- MODAL FUNCTION END -->
<!-- PAYMENT SECTION END -->

@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        var payment, promo, ico;
        $('.pay-method input[type=radio]').change(function(){            
            if(payment = $(this).val()) {
                $('.step-1').prop('disabled',false);
                $('.payment').html(payment);
                $('.qr-code, .symbol').hide();
                $('.'+payment).show();
                $('#ico').trigger('change');
            }

            @if($accredited == 1)

            if($('#accredited').prop('checked') == false){
                $('.pay-method input[type=radio]').prop('checked', false);
                $('.step-1').prop('disabled',true);
            }

            @endif
        });

        @if($accredited == 1)

        $(document).on('click', '#accredited', function(){
            if($(this).prop('checked') == false){
                $('.pay-method input[type=radio]').prop('checked', false);
                $('.step-1').prop('disabled',true);
            }
        });

        @endif

        $("#ico, #promocode").change(function(){
            promo = $('#promocode').val();
            ico = $('#ico').val();
            if(ico) {
                $.get("{{url('/coinstatus')}}?promo="+promo+"&type="+payment, function(data, status) {
                    if(data.message == 'OK') {
                        if(payment == 'ETH') {
                            var live_price = data.result.ethusd;
                        } else {
                            var live_price = data.last;
                        }

                        if(payment == 'USD') {
                            var bitcoin = (parseFloat(<?php echo Setting::get('coin_price') ;?>) * ico).toFixed(8);
                        } else {
                            var bitcoin = (parseFloat(<?php echo Setting::get('coin_price') ;?>) * ico / live_price).toFixed(8);
                        }
                        $(".price").val(parseFloat(bitcoin));
                        $(".price").html(parseFloat(bitcoin));
                        var bonus_point = parseFloat($('#bonus_point').val());
                        var bonus = parseFloat(ico)*(bonus_point/100);

                        $("#bonus").html(parseFloat(bonus));
                        if(data.promo_percent) {
                            var promo_percent = parseFloat(ico)*(data.promo_percent/100);
                            $(".promo-txt").removeClass('no-promo');
                            $(".promo-txt").html('Promocode Applied');
                        } else {
                            var promo_percent = 0;
                        }
                        if(bonus_point) {
                            var total = parseFloat(ico)+parseFloat(bonus)+parseFloat(promo_percent);
                        } else {
                            var total = parseFloat(ico)+parseFloat(promo_percent);
                        }
                        $("#total").html(parseFloat(total));
                        $('.step-2').prop('disabled',false);
                    } else {
                        if(data.error == 'invalid_promo'){
                            $(".promo-txt").html('Invalid Promocode');
                        }else if(data.error == 'promo_expired'){
                            $(".promo-txt").html('Promocode Expired');
                        }else if(data.error == 'promo_used'){
                            $(".promo-txt").html('Promocode already Used');
                        }
                        $(".promo-txt").addClass('no-promo');
                        $('#promocode').val('');
                        $('#ico').trigger('change');
                    }
                });
            }
        });
        // $('#address').change(function(){
        //     $('.error_address').html('');
        //     if(!$(this).val()) {
        //         $('.step-3').prop('disabled',true);
        //     } else {
        //         $.ajax({
        //           url: "https://api.etherscan.io/api",
        //           type: "GET",
        //           data:{'module':'account','action':'balance','address':$(this).val()}
        //         }).done(function(response){
        //             if(response.status == 0) {
        //                 $('.error_address').html('Invalid Address!');
        //                 $('.step-3').prop('disabled',true);
        //             } else {
        //                 $('.step-3').prop('disabled',false);
        //                 $('#coin_address').val($('#address').val());
        //             }
        //         });
        //     }
        // });
        $(".step-1").click(function(){
            var empty = {{$empty}};
            if(payment == 'USD' && empty) {
                $('.USD-Popup').trigger('click');
            }
        });
        $(".step-2").click(function(){
            if(payment == 'XRP'){
                $('#tranx_id').hide();
                checkTransaction();
            } else {
                $('#tranx_id').show();
                $('#transaction_form button').attr('disabled', false);
                $('.step-3').attr('disabled', false);
            }
        });
        $('.step-3').on('click',function(){
            if($('#tranx_id').val()){
                var myVar;
                $.ajax({
                  url: "{{url('checkTransaction')}}",
                  type: "GET",
                  data:{'tranx_id':$('#tranx_id').val(),'amount':$('.price').val(),'amount_ctc':$('#ico').val(),'cointype':payment}
                }).done(function(response){

                    if(response.success == 'Ok'){
                        $(".error_tranx_id").html('');
                        $('#step-3').prop('disabled',false);
                        $('#amount_ctc').val($('#ico').val());
                        $('#amount_new').val($('.price').val());
                        $('#promo_code').val($('#promocode').val());
                        $('#cointype').val(payment);
                        $('#transaction_form').submit();
                    }else if(response.error == 'id_not_valid'){
                        error =1;
                        $('#step-3').prop('disabled',true);
                        $('#msg').html('');
                        $(".error_tranx_id").html('Invalid Transaction ID');
                    }else if(response.error == 'price_not_match'){
                        error =1;
                        $('#step-3').prop('disabled',true);
                        $('#msg').html('');
                        $(".error_tranx_id").html('Price does not match');
                    }else if(response.error == 'address_not_match'){
                        error =1;
                        $('#step-3').prop('disabled',true);
                        $('#msg').html('');
                        $(".error_tranx_id").html('Deposit Address does not match');
                    } else{
                        $('#loader').show();
                        $('#step-3').prop('disabled',true);
                        $('#msg').html('Please wait until your Transaction is Processing...');

                    }

                }).fail(function(jqXhr,status){
                    if(jqXhr.status === 422) {
                        error = 1;
                        $(".error_tranx_id").html('');
                        $(".error_tranx_id ").show();
                        var errors = jqXhr.responseJSON;
                        console.log(errors);
                        $.each( errors , function( key, value ) {
                            $(".error_tranx_id").html(value);
                        });
                    }
                    $('#step-3').prop('disabled',true);
                });
            }else{
                $('.error_tranx_id').html('This field is required');
            }
        });
    });

@if(isset($ripple_addr))
    var error = 0;
    function checkTransaction(){
        $.ajax({
            url: "https://data.ripple.com/v2/accounts/{{$ripple_addr}}/transactions?type=Payment&result=tesSUCCESS&limit=10",
            type: "GET",
            //data:{'payment_id':$('#transaction_id_'+type).val(),'amount':amount}
        }).done(function(response){
            var transa =1;
            var amount_ripple = $('#ico').val();
            if((response.transactions).length > 0){

                $.each(response.transactions ,function(index,value){
                    
                    if(value.tx.DestinationTag == {{$dest_tag}}){
                       transa =0;
                       console.log(value.tx.Amount/1000000 +'---'+ amount_ripple+'--'+parseFloat(amount_ripple - (value.tx.Amount/1000000)));
                       if(parseFloat(amount_ripple - (value.tx.Amount/1000000)) < 2){
                            $('#tranx_id').val(value.hash);
                            $('.fa').remove();
                            $("#waiting-msg-Ripple").html('<i class="fa fa-check"></i> Success');
                            $('.step-3').prop('disabled', false);
                        }else{
                            $("#waiting-msg-Ripple").html('<i class="fa fa-close"></i> Paid amount is less than the order amount. Please re-pay the exact amount.');
                        }
                    }
                });

                if(transa==1){
                  setTimeout(function() { checkTransaction(); }, 5000);
                }
                
            }
            else{
              setTimeout(function() { checkTransaction(); }, 5000);
            }
            
        }).fail(function(jqXhr,status){
            if(jqXhr.status === 422) {
                error =1;
                $("#waiting-msg-Ripple").html('');
                var errors = jqXhr.responseJSON;
                console.log(errors);
                $.each( errors , function( key, value ) { 
                    $("#waiting-msg-Ripple").html(value);
                }); 
            }
        })
    }
@endif
</script>
@endsection
@section('styles')
<style type="text/css">
    .promo-txt.no-promo {
        color: red !important;
    }
</style>
@endsection