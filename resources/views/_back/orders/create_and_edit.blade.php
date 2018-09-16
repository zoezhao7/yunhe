@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Order /
                    @if($order->id)
                        Edit #{{$order->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($order->id)
                    <form action="{{ route('orders.update', $order->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('orders.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                    <label for="member_id-field">Member_id</label>
                    <input class="form-control" type="text" name="member_id" id="member_id-field" value="{{ old('member_id', $order->member_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="car_id-field">Car_id</label>
                    <input class="form-control" type="text" name="car_id" id="car_id-field" value="{{ old('car_id', $order->car_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="spec_id-field">Spec_id</label>
                    <input class="form-control" type="text" name="spec_id" id="spec_id-field" value="{{ old('spec_id', $order->spec_id ) }}" />
                </div> 
                <div class="form-group">
                	<label for="parameters-field">Parameters</label>
                	<textarea name="parameters" id="parameters-field" class="form-control" rows="3">{{ old('parameters', $order->parameters ) }}</textarea>
                </div> 
                <div class="form-group">
                    <label for="price-field">Price</label>
                    <input class="form-control" type="text" name="price" id="price-field" value="{{ old('price', $order->price ) }}" />
                </div> 
                <div class="form-group">
                    <label for="discount-field">Discount</label>
                    <input class="form-control" type="text" name="discount" id="discount-field" value="{{ old('discount', $order->discount ) }}" />
                </div> 
                <div class="form-group">
                    <label for="money-field">Money</label>
                    <input class="form-control" type="text" name="money" id="money-field" value="{{ old('money', $order->money ) }}" />
                </div> 
                <div class="form-group">
                    <label for="dealt_at-field">Dealt_at</label>
                    <input class="form-control" type="text" name="dealt_at" id="dealt_at-field" value="{{ old('dealt_at', $order->dealt_at ) }}" />
                </div> 
                <div class="form-group">
                    <label for="status-field">Status</label>
                    <input class="form-control" type="text" name="status" id="status-field" value="{{ old('status', $order->status ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('orders.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection