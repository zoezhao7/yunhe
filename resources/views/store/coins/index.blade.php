@extends('store.layouts.store')

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
                <div class="panel-body" style="padding-top:0;padding-left:0;">
                    <form>
                        <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                            <input type="text" class="form-control" id="" name="member_name"
                                   value="{{ $request->member_name }}" placeholder="客户姓名">
                        </div>
                        <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                            <select class="form-control" name="coin_type">
                                <option value="">类型</option>
                                @foreach(\App\Models\Coin::$typeMsg as $type)
                                    <option value="{{ $type['id'] }}"
                                            @if($request->coin_type == $type['id']) selected @endif>{{ $type['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                            <select class="form-control" name="order_by">
                                <option value="">排序</option>
                                <option value="coins.number" @if($request->order_by == 'coins.number') selected @endif>
                                    积分数量
                                </option>
                                <option value="coins.id" @if($request->order_by == 'coins.id') selected @endif>操作时间
                                </option>
                            </select>
                        </div>
                        <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                            <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                        </div>
                    </form>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table member-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>操作类型</th>
                        <th>姓名</th>
                        <th>操作积分</th>
                        <th>账户积分</th>
                        <th>说明</th>
                        <th>操作人</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($coins as $key => $coin)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <span class="label {{\App\Models\Coin::$typeMsg[$coin->type]['label_class']}}">{{ \App\Models\Coin::$typeMsg[$coin->type]['name'] }}</span>
                            </td>
                            <td>
                                @if (isset($member) && $member->id)
                                    {{ $coin->member_name }}
                                @else
                                    <a href="{{ route('store.members.coins', $coin->member_name) }}">
                                        {{ $coin->member_name }}
                                    </a>
                                @endif
                            </td>
                            <td>@if($coin->number > 0) + @endif{{ $coin->number }}</td>
                            <td>{{ $coin->member_coin_count }}</td>
                            <td>{{ $coin->remark }}</td>
                            <td>@if($coin->employee_id) 操作人：[{{ $coin->employee_name }}] @else -- @endif</td>
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