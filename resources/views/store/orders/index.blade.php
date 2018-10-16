@extends('store.layouts.store')

@section('title', '订单管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">订单列表</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">订单列表</li>
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
                        <input type="text" class="form-control" id="" name="order_idnumber"
                               value="{{ $request->order_idnumber }}" placeholder="订单编号">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="member_name"
                               value="{{ $request->member_name }}" placeholder="客户姓名">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="employee_name"
                               value="{{ $request->employee_name }}" placeholder="顾问姓名">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="order_status">
                            <option value="">状态</option>
                            <option value="0" @if($request->order_status == '0') selected @endif>待审核</option>
                            <option value="1" @if($request->order_status == '1') selected @endif>审核通过</option>
                            <option value="2" @if($request->order_status == '2') selected @endif>审核失败</option>
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="order_by">
                            <option value="">排序</option>
                            <option value="orders.money" @if($request->order_by == 'orders.money') selected @endif>
                                成交金额
                            </option>
                            <option value="orders.id" @if($request->order_by == 'orders.id') selected @endif>成交时间
                            </option>
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table member-overview  color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>订单ID</th>
                        <th>客户</th>
                        <th>一级销售</th>
                        <th>二级销售</th>
                        <th>成交金额（元）</th>
                        <th>成交时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($orders as $key => $order)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <a href="{{ route('store.orders.show', $order->id) }}">
                                    {{ $order->idnumber }}
                                </a>
                            </td>
                            <td>{{ $order->member_name }}</td>
                            <td>@if($order->superior_name){{ $order->superior_name }}@else{{ $order->employee_name }}@endif</td>
                            <td>@if($order->superior_name){{ $order->employee_name }}@endif</td>
                            <td>{{ $order->money }}</td>
                            <td>{{ substr($order->dealt_at, 0, 10) }}</td>
                            <td>@if ($order->status == 0)
                                    <span class="label label-danger">待审核</span>
                                @elseif($order->status==1)
                                    <span class="label label-success">通过</span>
                                @else
                                    <span class="label label-inverse">失败</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-outline btn-info" href="{{ route('store.orders.show', $order->id) }}">
                                    查看
                                </a>

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