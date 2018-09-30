@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Product / Show #{{ $product->id }}</h1>
                </div>

                <div class="panel-body">
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-md-6">
                                <a class="btn btn-link" href="{{ route('products.index') }}"><i
                                            class="glyphicon glyphicon-backward"></i> Back</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-sm btn-warning pull-right"
                                   href="{{ route('products.edit', $product->id) }}">
                                    <i class="glyphicon glyphicon-edit"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>

                    <label>Name</label>
                    <p>
                        {{ $product->name }}
                    </p> <label>Intro</label>
                    <p>
                        {{ $product->intro }}
                    </p> <label>Content</label>
                    <p>
                        {{ $product->content }}
                    </p> <label>Image</label>
                    <p>
                        {{ $product->image }}
                    </p> <label>Sales</label>
                    <p>
                        {{ $product->sales }}
                    </p> <label>Is_sale</label>
                    <p>
                        {{ $product->is_sale }}
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
