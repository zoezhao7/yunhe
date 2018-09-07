@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Spec /
                    @if($spec->id)
                        Edit #{{$spec->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($spec->id)
                    <form action="{{ route('specs.update', $spec->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('specs.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                	<label for="number-field">Number</label>
                	<input class="form-control" type="text" name="number" id="number-field" value="{{ old('number', $spec->number ) }}" />
                </div> 
                <div class="form-group">
                    <label for="product_id-field">Product_id</label>
                    <input class="form-control" type="text" name="product_id" id="product_id-field" value="{{ old('product_id', $spec->product_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="price-field">Price</label>
                    <input class="form-control" type="text" name="price" id="price-field" value="{{ old('price', $spec->price ) }}" />
                </div> 
                <div class="form-group">
                    <label for="discount-field">Discount</label>
                    <input class="form-control" type="text" name="discount" id="discount-field" value="{{ old('discount', $spec->discount ) }}" />
                </div> 
                <div class="form-group">
                	<label for="content-field">Content</label>
                	<textarea name="content" id="content-field" class="form-control" rows="3">{{ old('content', $spec->content ) }}</textarea>
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('specs.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection