@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Member /
                    @if($member->id)
                        Edit #{{$member->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($member->id)
                    <form action="{{ route('members.update', $member->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('members.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                	<label for="name-field">Name</label>
                	<input class="form-control" type="text" name="name" id="name-field" value="{{ old('name', $member->name ) }}" />
                </div> 
                <div class="form-group">
                	<label for="phone-field">Phone</label>
                	<input class="form-control" type="text" name="phone" id="phone-field" value="{{ old('phone', $member->phone ) }}" />
                </div> 
                <div class="form-group">
                    <label for="employee_id-field">Employee_id</label>
                    <input class="form-control" type="text" name="employee_id" id="employee_id-field" value="{{ old('employee_id', $member->employee_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="store_id-field">Store_id</label>
                    <input class="form-control" type="text" name="store_id" id="store_id-field" value="{{ old('store_id', $member->store_id ) }}" />
                </div> 
                <div class="form-group">
                	<label for="idnumber-field">Idnumber</label>
                	<input class="form-control" type="text" name="idnumber" id="idnumber-field" value="{{ old('idnumber', $member->idnumber ) }}" />
                </div> 
                <div class="form-group">
                	<label for="address-field">Address</label>
                	<input class="form-control" type="text" name="address" id="address-field" value="{{ old('address', $member->address ) }}" />
                </div> 
                <div class="form-group">
                    <label for="status-field">Status</label>
                    <input class="form-control" type="text" name="status" id="status-field" value="{{ old('status', $member->status ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('members.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection