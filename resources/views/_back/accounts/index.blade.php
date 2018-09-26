@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> Account
                    <a class="btn btn-success pull-right" href="{{ route('accounts.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
                </h1>
            </div>

            <div class="panel-body">
                @if($accounts->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Store_id</th> <th>Employee_id</th> <th>Order_id</th> <th>Stock_order_id</th> <th>Type</th> <th>Money</th> <th>Channel</th> <th>Operated_at</th> <th>Remark</th>
                                <th class="text-right">OPTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($accounts as $account)
                                <tr>
                                    <td class="text-center"><strong>{{$account->id}}</strong></td>

                                    <td>{{$account->store_id}}</td> <td>{{$account->employee_id}}</td> <td>{{$account->order_id}}</td> <td>{{$account->stock_order_id}}</td> <td>{{$account->type}}</td> <td>{{$account->money}}</td> <td>{{$account->channel}}</td> <td>{{$account->operated_at}}</td> <td>{{$account->remark}}</td>
                                    
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-primary" href="{{ route('accounts.show', $account->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i> 
                                        </a>
                                        
                                        <a class="btn btn-xs btn-warning" href="{{ route('accounts.edit', $account->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> 
                                        </a>

                                        <form action="{{ route('accounts.destroy', $account->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $accounts->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection