@extends('store.layouts.store')

@section('title', '备货订单管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">备货订单列表</h4> </div>
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
            <div class="table-responsive">
                <table class="table member-overview" id="myTable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>编号</th>
                        <th>产品</th>
                        <th>型号</th>
                        <th>色彩</th>
                        <th>数量</th>
                        <th>下单时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($stock_orders as $key => $order)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td> -- </td>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->spec->number }} - {{ $order->spec->size }}</td>
                            <td>{{ $order->color }}</td>
                            <td>{{ $order->number }}</td>
                            <td>{{ $order->created_at }}</td>
                            <td>@if ($order->status == 0)
                                    <span class="label label-danger">待接单</span>
                                @elseif($order->status==1)
                                    <span class="label label-success">备货中</span>
                                @elseif($order->status==2)
                                    <span class="label label-success">已发货</span>
                                @elseif($order->status==3)
                                    <span class="label label-success">已发货</span>
                                @else
                                    <span class="label label-inverse">状态错误</span>
                                @endif
                            </td>
                            <td>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $orders->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection