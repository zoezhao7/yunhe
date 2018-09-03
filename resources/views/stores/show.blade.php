@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Store / Show #{{ $store->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('stores.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('stores.edit', $store->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Name</label>
<p>
	{{ $store->name }}
</p> <label>Phone</label>
<p>
	{{ $store->phone }}
</p> <label>Address</label>
<p>
	{{ $store->address }}
</p> <label>Employees_count</label>
<p>
	{{ $store->employees_count }}
</p> <label>Is_open</label>
<p>
	{{ $store->is_open }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
