@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Account / Show #{{ $account->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('accounts.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('accounts.edit', $account->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Store_id</label>
<p>
	{{ $account->store_id }}
</p> <label>Employee_id</label>
<p>
	{{ $account->employee_id }}
</p> <label>Order_id</label>
<p>
	{{ $account->order_id }}
</p> <label>Stock_order_id</label>
<p>
	{{ $account->stock_order_id }}
</p> <label>Type</label>
<p>
	{{ $account->type }}
</p> <label>Money</label>
<p>
	{{ $account->money }}
</p> <label>Channel</label>
<p>
	{{ $account->channel }}
</p> <label>Operated_at</label>
<p>
	{{ $account->operated_at }}
</p> <label>Remark</label>
<p>
	{{ $account->remark }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
