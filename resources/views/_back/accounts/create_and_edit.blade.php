@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Account /
                    @if($account->id)
                        Edit #{{$account->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($account->id)
                    <form action="{{ route('accounts.update', $account->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('accounts.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                    <label for="store_id-field">Store_id</label>
                    <input class="form-control" type="text" name="store_id" id="store_id-field" value="{{ old('store_id', $account->store_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="employee_id-field">Employee_id</label>
                    <input class="form-control" type="text" name="employee_id" id="employee_id-field" value="{{ old('employee_id', $account->employee_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="order_id-field">Order_id</label>
                    <input class="form-control" type="text" name="order_id" id="order_id-field" value="{{ old('order_id', $account->order_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="stock_order_id-field">Stock_order_id</label>
                    <input class="form-control" type="text" name="stock_order_id" id="stock_order_id-field" value="{{ old('stock_order_id', $account->stock_order_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="type-field">Type</label>
                    <input class="form-control" type="text" name="type" id="type-field" value="{{ old('type', $account->type ) }}" />
                </div> 
                <div class="form-group">
                    <label for="money-field">Money</label>
                    <input class="form-control" type="text" name="money" id="money-field" value="{{ old('money', $account->money ) }}" />
                </div> 
                <div class="form-group">
                	<label for="channel-field">Channel</label>
                	<input class="form-control" type="text" name="channel" id="channel-field" value="{{ old('channel', $account->channel ) }}" />
                </div> 
                <div class="form-group">
                    <label for="operated_at-field">Operated_at</label>
                    <input class="form-control" type="text" name="operated_at" id="operated_at-field" value="{{ old('operated_at', $account->operated_at ) }}" />
                </div> 
                <div class="form-group">
                	<label for="remark-field">Remark</label>
                	<textarea name="remark" id="remark-field" class="form-control" rows="3">{{ old('remark', $account->remark ) }}</textarea>
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('accounts.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection