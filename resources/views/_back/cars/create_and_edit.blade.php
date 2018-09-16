@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Car /
                    @if($car->id)
                        Edit #{{$car->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($car->id)
                    <form action="{{ route('cars.update', $car->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('cars.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                    <label for="member_id-field">Member_id</label>
                    <input class="form-control" type="text" name="member_id" id="member_id-field" value="{{ old('member_id', $car->member_id ) }}" />
                </div> 
                <div class="form-group">
                	<label for="brand-field">Brand</label>
                	<input class="form-control" type="text" name="brand" id="brand-field" value="{{ old('brand', $car->brand ) }}" />
                </div> 
                <div class="form-group">
                	<label for="vehicles-field">Vehicles</label>
                	<input class="form-control" type="text" name="vehicles" id="vehicles-field" value="{{ old('vehicles', $car->vehicles ) }}" />
                </div> 
                <div class="form-group">
                	<label for="specs-field">Specs</label>
                	<input class="form-control" type="text" name="specs" id="specs-field" value="{{ old('specs', $car->specs ) }}" />
                </div> 
                <div class="form-group">
                	<label for="color-field">Color</label>
                	<input class="form-control" type="text" name="color" id="color-field" value="{{ old('color', $car->color ) }}" />
                </div> 
                <div class="form-group">
                    <label for="production_date-field">Production_date</label>
                    <input class="form-control" type="text" name="production_date" id="production_date-field" value="{{ old('production_date', $car->production_date ) }}" />
                </div> 
                <div class="form-group">
                    <label for="buy_date-field">Buy_date</label>
                    <input class="form-control" type="text" name="buy_date" id="buy_date-field" value="{{ old('buy_date', $car->buy_date ) }}" />
                </div> 
                <div class="form-group">
                	<label for="image-field">Image</label>
                	<input class="form-control" type="text" name="image" id="image-field" value="{{ old('image', $car->image ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('cars.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection