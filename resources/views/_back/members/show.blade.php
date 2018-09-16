@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Member / Show #{{ $member->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('members.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('members.edit', $member->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Name</label>
<p>
	{{ $member->name }}
</p> <label>Phone</label>
<p>
	{{ $member->phone }}
</p> <label>Employee_id</label>
<p>
	{{ $member->employee_id }}
</p> <label>Store_id</label>
<p>
	{{ $member->store_id }}
</p> <label>Idnumber</label>
<p>
	{{ $member->idnumber }}
</p> <label>Address</label>
<p>
	{{ $member->address }}
</p> <label>Status</label>
<p>
	{{ $member->status }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
