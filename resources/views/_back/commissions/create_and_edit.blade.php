@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Commission /
                    @if($commission->id)
                        Edit #{{$commission->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($commission->id)
                    <form action="{{ route('commissions.update', $commission->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('commissions.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                    <label for="employee_id-field">Employee_id</label>
                    <input class="form-control" type="text" name="employee_id" id="employee_id-field" value="{{ old('employee_id', $commission->employee_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="type-field">Type</label>
                    <input class="form-control" type="text" name="type" id="type-field" value="{{ old('type', $commission->type ) }}" />
                </div> 
                <div class="form-group">
                    <label for="suboardinate_id-field">Suboardinate_id</label>
                    <input class="form-control" type="text" name="suboardinate_id" id="suboardinate_id-field" value="{{ old('suboardinate_id', $commission->suboardinate_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="order_id-field">Order_id</label>
                    <input class="form-control" type="text" name="order_id" id="order_id-field" value="{{ old('order_id', $commission->order_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="money-field">Money</label>
                    <input class="form-control" type="text" name="money" id="money-field" value="{{ old('money', $commission->money ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('commissions.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection