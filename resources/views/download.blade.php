@extends('layouts.app')

@section('content')
    <div class="kyc-details">
        <div class="container">
            <div class="transaction_balance">
                <div class="settings-content-wrap p-f-30">
                    <!-- Settings Section Starts -->
                    <div class="msg">
                        Purchases cannot be made until download forms are Verified
                    </div>
                    <div class="set-section">
                        <h6 class="m-0 set-main-tit">Download forms</h6>
                            <table class="table table-striped table-bordered dataTable" id="table-2">
                                @if($KycDocument != "")
                                    <tbody>
                                    @foreach($KycDocument  as $doc)
                                    	@if($doc->document->download == 1)
                                        <tr>
                                            <td><a href="{{img($doc->url)}}" target="_blank">{{$doc->document->name}}</a></td>
                                            <td>
                                               @if($doc->status == "PENDING")
                                                <i class="fa fa-check-circle-o" style="font-size:48px;color:blue"></i>
                                                @elseif($doc->status=="APPROVED")
                                                <i class="fa fa-check-circle-o" style="font-size:48px;color:green"></i>
                                                @else
                                                <i class="fa fa-ban" style="font-size:48px;color:red"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    	@endif
                                    @endforeach
                                    </tbody>
                                @endif
                            </table>
                        <!-- <div class="set-sec-inner">
                            <div class="set-block">
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <p class="set-txt"><b>First Name</b></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="John" name="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <p class="set-txt"><b>Last Name</b></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" value="Smith" name="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <p class="set-txt"><b>Valid Identity Card</b></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- Settings Section Ends -->
                    <!-- Settings Section Starts -->
                    <div class="set-section">
                        <!-- <h6 class="m-0 set-main-tit"></h6> -->
                        <div class="set-sec-inner">
                            @if(count($Kyc))
                                <form method="POST" action="{{ url('/kyc') }}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <!-- Settings Block Starts -->
                                    @foreach($Kyc as $kyc)
                                        <?php //$allow = true; ?>
                                        @if($kyc->usa_accredited == 1 && country() == 'US')
                                        	<?php $allow = true; ?>
                                        @elseif($kyc->usa_accredited == 1 && country() != 'US')
                                        	<?php $allow = false; ?>
                                        @elseif($kyc->usa_accredited == 0 && country() != 'US')
                                        	<?php $allow = true; ?>
                                        @endif
                                        @if($allow == true)
	                                        <div class="set-block">
	                                            <div class="form-group row">
	                                                <div class="col-sm-2">
	                                                    <p class="set-txt"><b>{{$kyc->name}}</b></p>
	                                                </div>
	                                                <div class="col-sm-6">
	                                                    <div id="kyc-image-preview-{{$kyc->id}}" class="kyc-image-preview">
	                                                        <label for="kyc-image-upload-{{$kyc->id}}" class="kyc-image-label" id="kyc-image-label-{{$kyc->id}}">Upload</label>
	                                                        <input type="file" name="image[{{$kyc->id}}]" class="kyc-image-upload" id="kyc-image-upload-{{$kyc->id}}" @if(Auth::user()->status == 1) disabled="disabled" @endif />
	                                                    </div>
	                                                    <p class="muted kyc-txt">The file size should not be exceed 10 MB</p>
	                                                </div>
	                                                <!-- <div class="col-sm-4">
	                                                    <h5 class="example-tit">Example</h5>
	                                                    <div class="kyc-demo-img bg-img" style="background-image: url({{img($kyc->image)}});"></div>
	                                                </div> -->
	                                                <div class="col-sm-4">
	                                                    @if(isset($kyc->doc))
	                                                        <h5 class="example-tit">Download</h5>
	                                                        <a href="{{img($kyc->doc)}}" target="_blank">Download</a>
	                                                    @endif
	                                                </div>
	                                            </div>
	                                        </div>
	                                    @endif
                                    @endforeach
                                    <!-- Settings Block Ends -->
                                    <div class="text-center common-button">
                                        <button type="submit" class="btn btn-primary btn-info-full next-step">Submit</button>
                                    </div>
                                    <!-- Settings Block Ends -->
                                </form>
                            @endif
                        </div>
                    </div>
                    <!-- Settings Section Ends -->
                </div>
            </div>
        </div>
    </div>
@endsection