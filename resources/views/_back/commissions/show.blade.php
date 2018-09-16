@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Commission / Show #{{ $commission->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('commissions.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('commissions.edit', $commission->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Employee_id</label>
<p>
	{{ $commission->employee_id }}
</p> <label>Type</label>
<p>
	{{ $commission->type }}
</p> <label>Suboardinate_id</label>
<p>
	{{ $commission->suboardinate_id }}
</p> <label>Order_id</label>
<p>
	{{ $commission->order_id }}
</p> <label>Money</label>
<p>
	{{ $commission->money }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
