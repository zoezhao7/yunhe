@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Product /
                    @if($product->id)
                        Edit #{{$product->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($product->id)
                    <form action="{{ route('products.update', $product->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('products.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                	<label for="name-field">Name</label>
                	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $product->name ) }}" />
                </div> 
                <div class="form-group">
                	<label for="intro-field">Intro</label>
                	<input class="form-control" type="text" name="intro" id="intro-field" value="{{ old('intro', $product->intro ) }}" />
                </div> 
                <div class="form-group">
                	<label for="content-field">Content</label>
                	<textarea name="content" id="content-field" class="form-control" rows="3">{{ old('content', $product->content ) }}</textarea>
                </div> 
                <div class="form-group">
                	<label for="image-field">Image</label>
                	<input class="form-control" type="text" name="image" id="image-field" value="{{ old('image', $product->image ) }}" />
                </div> 
                <div class="form-group">
                    <label for="sales-field">Sales</label>
                    <input class="form-control" type="text" name="sales" id="sales-field" value="{{ old('sales', $product->sales ) }}" />
                </div> 
                <div class="form-group">
                    <label for="is_sale-field">Is_sale</label>
                    <input class="form-control" type="text" name="is_sale" id="is_sale-field" value="{{ old('is_sale', $product->is_sale ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('products.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection