@extends('store.layouts.store')

{{ $page_name = $stock_order->id ? '修改备货订单' : '备货下单'  }}

@section('title', $page_name)

@section('content')

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">{{ $page_name }}</h4>
    </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('store.welcome') }}">首页</a></li>
            <li><a href="{{ route('store.stock_orders.index') }}">备货订单列表</a></li>
            <li class="active">{{ $page_name }}</li>
        </ol>
    </div>
</div>

@include('store.common._message')
@include('store.common._error')

<div class="col-md-6">
    <div class="white-box">
        <div class="row">

            <div class="col-sm-12 col-xs-12">
                <h3>{{ $product->category->name }} - {{ $product->name }}</h3>
            </div>

            <div class="col-sm-12 col-xs-12">
                @if ($stock_order->id)
                <form method="POST" action="{{ route('store.stock_orders.update', $stock_order->id) }}"
                      enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    @else
                    <form method="POST" action="{{ route('store.stock_orders.store') }}">
                        @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />

                        <div class="form-group">
                            <label for="exampleInputEmail1">规格</label>
                            <select class="form-control" name="spec_id" required>
                                @foreach ($product->specs as $spec)
                                <option value="{{ $spec['id'] }}" {{ $stock_order->id == $spec->id ? 'selected' : '' }}>{{ $spec['number'] }} - {{ $spec['size'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">颜色</label>
                            <select class="form-control" name="color" required>
                                @foreach ($product->colors as $color)
                                <option value="{{ json_encode($color) }}" {{ $stock_order->color == json_encode($color) ? 'selected' : '' }}>{{ $color['title'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">数量</label>
                            <input type="text" class="form-control" name="number"
                                   value="{{ old('name', $stock_order->number) }}" placeholder="请输入数量（套）">
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交
                        </button>
                    </form>

            </div>
        </div>
    </div>
</div>

@endsection

