@extends('store.layouts.store')

@section('title', '积分记录')

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">积分记录</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">积分记录</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">

            <div class="table-responsive">
                <table class="table member-overview" id="myTable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>姓名</th>
                        <th>账户积分</th>
                        <th>操作类型</th>
                        <th>操作积分</th>
                        <th>操作源</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($coins as $key => $coin)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $coin->member->name }}</td>
                            <td>{{ $order->member->coin_count }}</td>
                            <td>
                                @if ($coin->type == 1)
                                    <span class="label label-info">订单</span>
                                @endif
                                @if ($coin->type == 2)
                                    <span class="label label-warning">人工操作</span>
                                @endif
                            </td>
                            <td>{{ $coin->number }}</td>
                            <td>
                                @if($coin->order_id)
                                    订单：[{{ $coin->order->idnumber }}]
                                @elseif($coin->employee_id)
                                    操作人：[{{ $coin->employee_name }}]
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $coins->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection