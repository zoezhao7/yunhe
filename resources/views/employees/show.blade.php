@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Employee / Show #{{ $employee->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('employees.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('employees.edit', $employee->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Name</label>
<p>
	{{ $employee->name }}
</p> <label>Phone</label>
<p>
	{{ $employee->phone }}
</p> <label>Store_id</label>
<p>
	{{ $employee->store_id }}
</p> <label>Type</label>
<p>
	{{ $employee->type }}
</p> <label>Password</label>
<p>
	{{ $employee->password }}
</p> <label>Idnumber</label>
<p>
	{{ $employee->idnumber }}
</p> <label>Status</label>
<p>
	{{ $employee->status }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
