@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>StockOrder / Show #{{ $stock_order->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('stock_orders.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('stock_orders.edit', $stock_order->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Store_id</label>
<p>
	{{ $stock_order->store_id }}
</p> <label>Employee_id</label>
<p>
	{{ $stock_order->employee_id }}
</p> <label>Spec_id</label>
<p>
	{{ $stock_order->spec_id }}
</p> <label>Color</label>
<p>
	{{ $stock_order->color }}
</p> <label>Number</label>
<p>
	{{ $stock_order->number }}
</p> <label>Status</label>
<p>
	{{ $stock_order->status }}
</p> <label>Product_idnumber</label>
<p>
	{{ $stock_order->product_idnumber }}
</p> <label>Transport_number</label>
<p>
	{{ $stock_order->delivery_number }}
</p> <label>Delivery_notes</label>
<p>
	{{ $stock_order->delivery_note }}
</p> <label>Receipted_at</label>
<p>
	{{ $stock_order->receipted_at }}
</p> <label>Transported_at</label>
<p>
	{{ $stock_order->delivered_at }}
</p> <label>Received_at</label>
<p>
	{{ $stock_order->received_at }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
