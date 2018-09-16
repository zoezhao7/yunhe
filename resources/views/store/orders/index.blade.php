@extends('store.layouts.store')

@section('title', '订单管理')

@section('content')

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">订单列表</h4> </div>
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
        <div class="table-responsive">
            <table class="table member-overview" id="myTable">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>编号</th>
                    <th>客户</th>
                    <th>销售</th>
                    <th>产品&型号</th>
                    <th>参数</th>
                    <th>成交金额（元）</th>
                    <th>享受折扣</th>
                    <th>成交时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($orders as $key => $order)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td> -- </td>
                    <td>{{ $order->member_name }}</td>
                    <td>{{ $order->employee_name }}</td>
                    <td>{{ $order->product_name }} - {{ $order->spec_size }}</td>
                    <td>{{ $order->parameters }}</td>
                    <td>{{ $order->money }}</td>
                    <td>{{ $order->discount }}</td>
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
                        @if ($order->status == 0)
                        <form onsubmit="return confirm('确认到账吗？');" id="success_form_{{$order->id}}" method="post" action="{{ route('store.orders.check_success', $order->id) }}" style="display: inline">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <a href="javascript:void(0);" onclick="document.getElementById('success_form_{{$order->id}}').submit();" class="text-inverse" title="审核通过" data-toggle="tooltip"><i class="icon-check"></i></a>
                        </form>
                        &nbsp;&nbsp;
                        <form onsubmit="return confirm('确认未到账吗？');" id="fail_form_{{$order->id}}" method="post" action="{{ route('store.orders.check_fail', $order->id) }}" style="display: inline">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <a href="javascript:void(0);" onclick="document.getElementById('fail_form_{{$order->id}}').submit();" class="text-inverse" title="审核通过" data-toggle="tooltip"><i class="icon-close"></i></a>
                        </form>
                        @endif

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