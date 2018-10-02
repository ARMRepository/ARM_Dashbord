@extends('coinadmin.layout.base')

@section('title', 'Edit Promocode ')

@section('content')
<div class="content-area py-1">
    <div class="container-fluid">
        <div class="box box-block bg-white">
            <a href="{{ route('coinadmin.promocode.index') }}" class="btn btn-default pull-right"><i class="fa fa-angle-left"></i> Back</a>

            <h5 style="margin-bottom: 2em;">Edit Promocode</h5>

            <form class="form-horizontal" action="{{route('coinadmin.promocode.update', $Promocode->id )}}" method="POST" enctype="multipart/form-data" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group row">
                    <label for="promo_code" class="col-xs-12 col-form-label">Promocode</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $Promocode->promo_code }}" name="promo_code" required id="promo_code" placeholder="Promocode">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="percentage" class="col-xs-12 col-form-label">Percentage (%)</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="text" value="{{ $Promocode->percentage }}" name="percentage" required id="percentage" placeholder="Percentage (%)">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="expiration" class="col-xs-12 col-form-label">Expiration</label>
                    <div class="col-xs-10">
                        <input class="form-control" type="date" value="{{ $Promocode->expiration }}" name="expiration" required id="expiration">
                    </div>
                </div>

            
                <div class="form-group row">
                    <div class="col-xs-10">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="{{ route('coinadmin.promocode.index') }}" class="btn btn-danger btn-block">Cancel</a>
                            </div>
                            <div class="col-xs-12 col-sm-6 offset-md-6 col-md-3">
                                <button type="submit" class="btn btn-primary btn-block">
                                Update Promocode</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>
@endsection
