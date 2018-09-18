@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Memo /
                    @if($memo->id)
                        Edit #{{$memo->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($memo->id)
                    <form action="{{ route('memos.update', $memo->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('memos.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    
                <div class="form-group">
                    <label for="employee_id-field">Employee_id</label>
                    <input class="form-control" type="text" name="employee_id" id="employee_id-field" value="{{ old('employee_id', $memo->employee_id ) }}" />
                </div> 
                <div class="form-group">
                    <label for="type-field">Type</label>
                    <input class="form-control" type="text" name="type" id="type-field" value="{{ old('type', $memo->type ) }}" />
                </div> 
                <div class="form-group">
                    <label for="member_id-field">Member_id</label>
                    <input class="form-control" type="text" name="member_id" id="member_id-field" value="{{ old('member_id', $memo->member_id ) }}" />
                </div> 
                <div class="form-group">
                	<label for="content-field">Content</label>
                	<textarea name="content" id="content-field" class="form-control" rows="3">{{ old('content', $memo->content ) }}</textarea>
                </div> 
                <div class="form-group">
                    <label for="status-field">Status</label>
                    <input class="form-control" type="text" name="status" id="status-field" value="{{ old('status', $memo->status ) }}" />
                </div> 
                <div class="form-group">
                    <label for="handled_at-field">Handled_at</label>
                    <input class="form-control" type="text" name="handled_at" id="handled_at-field" value="{{ old('handled_at', $memo->handled_at ) }}" />
                </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('memos.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection