@extends('store.layouts.store')

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
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">备货订单列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">

            <div class="panel-body" style="padding-top:0;padding-left:0;">
                <form>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="stock_order_idnumber"
                               value="{{ $request->stock_order_idnumber }}" placeholder="备货编号">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="order_status">
                            <option value="">订单状态</option>
                            @foreach(\App\Models\StockOrder::$statusMsg as $msg)
                                <option value="{{ $msg['id'] }}" @if($request->order_status == $msg['id']) selected @endif>{{ $msg['name'] }}</option>
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
                        <th>#</th>
                        <th>备货编号</th>
                        <th>产品清单</th>
                        <th>下单时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($stockOrders as $key => $order)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <a href="{{ route('store.stock_orders.show', $order->id) }}">{{ $order->idnumber }}</a>
                            </td>
                            <td style="line-height: 30px;">
                                @foreach($order->stockOrderProducts as $stockOrderProduct)
                                    <span class="label label-info">{{ $stockOrderProduct->spec->idnumber }}*{{ $stockOrderProduct->number }}</span>
                                @endforeach
                            </td>
                            <td>{{ $order->created_at->format('m-d H:i') }}</td>
                            <td>
                                    <span class="label {{ App\Models\StockOrder::$statusMsg[$order->status]['label-class'] }}">{{ App\Models\StockOrder::$statusMsg[$order->status]['name'] }}</span>
                            </td>
                            <td>
                                @if($order->status == 0)
                                    <form onsubmit="return confirm('确认取消订单吗？');" method="post" action="{{ route('store.stock_orders.cancel', $order->id) }}" style="display: inline">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-outline btn-xs btn-danger">取消订单</button>
                                    </form>
                                @endif
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