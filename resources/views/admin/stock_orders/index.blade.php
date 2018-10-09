@extends('admin.layouts.admin')

@section('title', '备货订单管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">备货订单列表</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li class="active">备货订单列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._message')

    <div class="row">
        <div class="white-box">

            <div class="panel-body" style="padding-top:0;padding-left:0;">
                <form>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="stock_order_idnumber"
                               value="{{ $request->stock_order_idnumber }}" placeholder="备货编号">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="product_name"
                               value="{{ $request->product_name }}" placeholder="产品名称">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="spec_idnumber"
                               value="{{ $request->spec_idnumber }}" placeholder="产品型号ID">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="order_status">
                            <option value="">订单状态</option>
                            @foreach(\App\Models\StockOrder::$statusMsg as $msg)
                                <option value="{{ $msg['id'] }}"
                                        @if($request->order_status == $msg['id']) selected @endif>{{ $msg['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table product-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>备货编号</th>
                        <th>门店</th>
                        <th>图片</th>
                        <th>产品</th>
                        <th>型号</th>
                        <th>颜色</th>
                        <th>数量（套）</th>
                        <th>下单时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($stockOrders as $key => $order)
                        <tr>
                            <td>
                                <a href="{{ route('admin.stock_orders.show', $order->id) }}">{{ $order->idnumber }}</a>
                            </td>
                            <td>
                                {{ $order->store->name }}
                            </td>
                            <td><img src="{{ $order->product->image }}" width="70px;"></td>
                            <td>
                                <a href="{{ route('admin.products.specs', $order->product_id) }}">{{ $order->product->name }}</a>
                            </td>
                            <td>{{ $order->spec->idnumber }} - {{ $order->spec->size }}</td>
                            <td>{{ $order->color }}</td>
                            <td>{{ $order->number }}</td>
                            <td>{{ $order->created_at->format('m-d H:i') }}</td>
                            <td>
                                <span class="label {{ App\Models\StockOrder::$statusMsg[$order->status]['label-class'] }}">{{ App\Models\StockOrder::$statusMsg[$order->status]['name'] }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.stock_orders.show', $order->id) }}" class="btn btn-info btn-small">详情</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $stockOrders->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection