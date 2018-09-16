@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Order / Show #{{ $order->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('orders.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('orders.edit', $order->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Member_id</label>
<p>
	{{ $order->member_id }}
</p> <label>Car_id</label>
<p>
	{{ $order->car_id }}
</p> <label>Spec_id</label>
<p>
	{{ $order->spec_id }}
</p> <label>Parameters</label>
<p>
	{{ $order->parameters }}
</p> <label>Price</label>
<p>
	{{ $order->price }}
</p> <label>Discount</label>
<p>
	{{ $order->discount }}
</p> <label>Money</label>
<p>
	{{ $order->money }}
</p> <label>Dealt_at</label>
<p>
	{{ $order->dealt_at }}
</p> <label>Status</label>
<p>
	{{ $order->status }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
