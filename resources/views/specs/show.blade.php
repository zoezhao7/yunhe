@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Spec / Show #{{ $spec->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('specs.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('specs.edit', $spec->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Number</label>
<p>
	{{ $spec->number }}
</p> <label>Product_id</label>
<p>
	{{ $spec->product_id }}
</p> <label>Price</label>
<p>
	{{ $spec->price }}
</p> <label>Discount</label>
<p>
	{{ $spec->discount }}
</p> <label>Content</label>
<p>
	{{ $spec->content }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
