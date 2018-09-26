@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> StockOrder /
                    @if($stock_order->id)
                        Edit #{{$stock_order->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($stock_order->id)
                    <form action="{{ route('stock_orders.update', $stock_order->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('stock_orders.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                    <label for="store_id-field">Store_id</label>
                    <input class="form-control" type="text" name="store_id" id="store_id-field" value="{{ old('store_id', $stock_order->store_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="employee_id-field">Employee_id</label>
                    <input class="form-control" type="text" name="employee_id" id="employee_id-field" value="{{ old('employee_id', $stock_order->employee_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="spec_id-field">Spec_id</label>
                    <input class="form-control" type="text" name="spec_id" id="spec_id-field" value="{{ old('spec_id', $stock_order->spec_id ) }}" />
                </div> 
                <div class="form-group">
                	<label for="color-field">Color</label>
                	<input class="form-control" type="text" name="color" id="color-field" value="{{ old('color', $stock_order->color ) }}" />
                </div> 
                <div class="form-group">
                    <label for="number-field">Number</label>
                    <input class="form-control" type="text" name="number" id="number-field" value="{{ old('number', $stock_order->number ) }}" />
                </div> 
                <div class="form-group">
                    <label for="status-field">Status</label>
                    <input class="form-control" type="text" name="status" id="status-field" value="{{ old('status', $stock_order->status ) }}" />
                </div> 
                <div class="form-group">
                	<label for="product_idnumber-field">Product_idnumber</label>
                	<input class="form-control" type="text" name="product_idnumber" id="product_idnumber-field" value="{{ old('product_idnumber', $stock_order->product_idnumber ) }}" />
                </div> 
                <div class="form-group">
                	<label for="transport_number-field">Transport_number</label>
                	<input class="form-control" type="text" name="transport_number" id="transport_number-field" value="{{ old('transport_number', $stock_order->transport_number ) }}" />
                </div> 
                <div class="form-group">
                	<label for="delivery_notes-field">Delivery_notes</label>
                	<textarea name="delivery_notes" id="delivery_notes-field" class="form-control" rows="3">{{ old('delivery_notes', $stock_order->delivery_notes ) }}</textarea>
                </div> 
                <div class="form-group">
                    <label for="receipted_at-field">Receipted_at</label>
                    <input class="form-control" type="text" name="receipted_at" id="receipted_at-field" value="{{ old('receipted_at', $stock_order->receipted_at ) }}" />
                </div> 
                <div class="form-group">
                    <label for="transported_at-field">Transported_at</label>
                    <input class="form-control" type="text" name="transported_at" id="transported_at-field" value="{{ old('transported_at', $stock_order->transported_at ) }}" />
                </div> 
                <div class="form-group">
                    <label for="received_at-field">Received_at</label>
                    <input class="form-control" type="text" name="received_at" id="received_at-field" value="{{ old('received_at', $stock_order->received_at ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('stock_orders.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection