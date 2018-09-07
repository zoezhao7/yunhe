@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>Car / Show #{{ $car->id }}</h1>
            </div>

            <div class="panel-body">
                <div class="well well-sm">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="btn btn-link" href="{{ route('cars.index') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                        </div>
                        <div class="col-md-6">
                             <a class="btn btn-sm btn-warning pull-right" href="{{ route('cars.edit', $car->id) }}">
                                <i class="glyphicon glyphicon-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>

                <label>Member_id</label>
<p>
	{{ $car->member_id }}
</p> <label>Brand</label>
<p>
	{{ $car->brand }}
</p> <label>Vehicles</label>
<p>
	{{ $car->vehicles }}
</p> <label>Specs</label>
<p>
	{{ $car->specs }}
</p> <label>Color</label>
<p>
	{{ $car->color }}
</p> <label>Production_date</label>
<p>
	{{ $car->production_date }}
</p> <label>Buy_date</label>
<p>
	{{ $car->buy_date }}
</p> <label>Image</label>
<p>
	{{ $car->image }}
</p>
            </div>
        </div>
    </div>
</div>

@endsection
