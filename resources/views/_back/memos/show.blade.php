@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Memo / Show #{{ $memo->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('memos.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('memos.edit', $memo->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Employee_id</label>
<p>
	{{ $memo->employee_id }}
</p> <label>Type</label>
<p>
	{{ $memo->type }}
</p> <label>Member_id</label>
<p>
	{{ $memo->member_id }}
</p> <label>Content</label>
<p>
	{{ $memo->content }}
</p> <label>Status</label>
<p>
	{{ $memo->status }}
</p> <label>Handled_at</label>
<p>
	{{ $memo->handled_at }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
