@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> StockOrder
                    <a class="btn btn-success pull-right" href="{{ route('stock_orders.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
                </h1>
            </div>

            <div class="panel-body">
                @if($stock_orders->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Store_id</th> <th>Employee_id</th> <th>Spec_id</th> <th>Color</th> <th>Number</th> <th>Status</th> <th>Product_idnumber</th> <th>Transport_number</th> <th>Delivery_notes</th> <th>Receipted_at</th> <th>Transported_at</th> <th>Received_at</th>
                                <th class="text-right">OPTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($stock_orders as $stock_order)
                                <tr>
                                    <td class="text-center"><strong>{{$stock_order->id}}</strong></td>

                                    <td>{{$stock_order->store_id}}</td> <td>{{$stock_order->employee_id}}</td> <td>{{$stock_order->spec_id}}</td> <td>{{$stock_order->color}}</td> <td>{{$stock_order->number}}</td> <td>{{$stock_order->status}}</td> <td>{{$stock_order->product_idnumber}}</td> <td>{{$stock_order->transport_number}}</td> <td>{{$stock_order->delivery_notes}}</td> <td>{{$stock_order->receipted_at}}</td> <td>{{$stock_order->transported_at}}</td> <td>{{$stock_order->received_at}}</td>
                                    
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-primary" href="{{ route('stock_orders.show', $stock_order->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i> 
                                        </a>
                                        
                                        <a class="btn btn-xs btn-warning" href="{{ route('stock_orders.edit', $stock_order->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> 
                                        </a>

                                        <form action="{{ route('stock_orders.destroy', $stock_order->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $stock_orders->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection