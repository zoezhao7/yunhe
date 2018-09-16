@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Store /
                    @if($store->id)
                        Edit #{{$store->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($store->id)
                    <form action="{{ route('stores.update', $store->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('stores.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                	<label for="name-field">Name</label>
                	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $store->name ) }}" />
                </div> 
                <div class="form-group">
                	<label for="phone-field">Phone</label>
                	<input class="form-control" type="text" name="phone" id="phone-field" value="{{ old('phone', $store->phone ) }}" />
                </div> 
                <div class="form-group">
                	<label for="address-field">Address</label>
                	<input class="form-control" type="text" name="address" id="address-field" value="{{ old('address', $store->address ) }}" />
                </div> 
                <div class="form-group">
                    <label for="employees_count-field">Employees_count</label>
                    <input class="form-control" type="text" name="employees_count" id="employees_count-field" value="{{ old('employees_count', $store->employees_count ) }}" />
                </div> 
                <div class="form-group">
                    <label for="is_open-field">Is_open</label>
                    <input class="form-control" type="text" name="is_open" id="is_open-field" value="{{ old('is_open', $store->is_open ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('stores.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection