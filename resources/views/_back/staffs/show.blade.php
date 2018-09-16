@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Staff / Show #{{ $staff->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('staffs.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('staffs.edit', $staff->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Name</label>
<p>
	{{ $staff->name }}
</p> <label>Phone</label>
<p>
	{{ $staff->phone }}
</p> <label>Store_id</label>
<p>
	{{ $staff->store_id }}
</p> <label>Type</label>
<p>
	{{ $staff->type }}
</p> <label>Password</label>
<p>
	{{ $staff->password }}
</p> <label>Idnumber</label>
<p>
	{{ $staff->idnumber }}
</p> <label>Status</label>
<p>
	{{ $staff->status }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
