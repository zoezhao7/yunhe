@extends('store.layouts.store')

{{ $page_name = isset($member) && $member->id ? $member->name . '的积分记录' : '积分记录' }}

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                @if (isset($member) && $member->id)
                    <li><a href="{{ route('store.coins.index') }}">积分记录</a></li>
                @endif
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">

            @if (!isset($member) || !$member->id)
            <div>
                <form method="get" action="{{ url()->full() }}" >
                    {{ csrf_field() }}
                    <input type="text" name="search_key" value="{{ request()->input('search_key') }}" id="demo-input-search2" placeholder="输入客户姓名..." class="form-control">
                </form>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table member-overview" id="myTable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>操作类型</th>
                        <th>姓名</th>
                        <th>操作积分</th>
                        <th>账户积分</th>
                        <th>说明</th>
                        <th>操作源</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($coins as $key => $coin)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                @if ($coin->type == 1)
                                    <span class="label label-info">订单</span>
                                @endif
                                @if ($coin->type == 2)
                                    <span class="label label-warning">人工操作</span>
                                @endif
                            </td>
                            <td>
                                @if (isset($member) && $member->id)
                                    {{ $coin->member->name }}
                                @else
                                    <a href="{{ route('store.members.coins', $coin->member->id) }}">
                                        {{ $coin->member->name }}
                                    </a>
                                @endif
                            </td>
                            <td>@if($coin->number > 0) + @endif{{ $coin->number }}</td>
                            <td>{{ $coin->member->coin_count }}</td>
                            <td>{{ $coin->remark }}</td>
                            <td>@if($coin->order_id) 订单：[{{ $coin->order->idnumber }}] @elseif($coin->employee_id)
                                    操作员：[{{ $coin->employee->name }}] @else @endif</td>
                        </tr>
                    @endforeach
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $coins->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection