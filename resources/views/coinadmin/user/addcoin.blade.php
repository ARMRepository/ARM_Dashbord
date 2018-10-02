@extends('coinadmin.layout.base')

@section('title', 'Add Coin ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <h4>Add Coin</h4>
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


                        <dt class="col-sm-4">{{ico()}} Balance :</dt>
                        <dd class="col-sm-8">{{ $User->ico_balance + $User->ico_bonus }}</dd>

                    </dl>
                </div>
            </div>
            <h5 style="margin-bottom: 2em;">Add {{ico()}} Coin</h5>

            <form class="form-horizontal" action="{{route('coinadmin.user.addcoin')}}" method="POST" enctype="multipart/form-data" role="form">
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{request()->route('id')}}">

                <div class="form-group row">
                    <label for="token" class="col-xs-12 col-form-label">{{ico()}} Coin</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ old('token') }}" name="token" required id="token" placeholder="{{ico()}} Coin">
                    </div>
                </div>
               
                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="{{ route('coinadmin.promocode.index') }}" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">Add {{ico()}} Coin</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection