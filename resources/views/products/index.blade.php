@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-align-justify"></i> Product
                    <a class="btn btn-success pull-right" href="{{ route('products.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
                </h1>
            </div>

            <div class="panel-body">
                @if($products->count())
                    <table class="table table-condensed table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th> <th>Intro</th> <th>Content</th> <th>Image</th> <th>Sales</th> <th>Is_sale</th>
                                <th class="text-right">OPTIONS</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="text-center"><strong>{{$product->id}}</strong></td>

                                    <td>{{$product->name}}</td> <td>{{$product->intro}}</td> <td>{{$product->content}}</td> <td>{{$product->image}}</td> <td>{{$product->sales}}</td> <td>{{$product->is_sale}}</td>
                                    
                                    <td class="text-right">
                                        <a class="btn btn-xs btn-primary" href="{{ route('products.show', $product->id) }}">
                                            <i class="glyphicon glyphicon-eye-open"></i> 
                                        </a>
                                        
                                        <a class="btn btn-xs btn-warning" href="{{ route('products.edit', $product->id) }}">
                                            <i class="glyphicon glyphicon-edit"></i> 
                                        </a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Delete? Are you sure?');">
                                            {{csrf_field()}}
                                            <input type="hidden" name="_method" value="DELETE">

                                            <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $products->render() !!}
                @else
                    <h3 class="text-center alert alert-info">Empty!</h3>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection