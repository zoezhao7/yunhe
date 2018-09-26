@extends('store.layouts.store')

{{ $page_name = $account->id ? '编辑账务' : '添加账务'  }}

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.accounts.index') }}">账务列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._message')
    @include('store.common._error')

    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    @if ($account->id)
                        <form method="POST" action="{{ route('store.accounts.update', $account->id) }}"
                              enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('store.accounts.store') }}">
                                    @endif
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="type">收支</label>
                                        <select class="form-control" name="type" required>
                                            @foreach ($account->typeMsg as $type)
                                                <option value="{{ $type['id'] }}" {{ $account->type == $type['id'] ? 'selected' : '' }}>{{ $type['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="channel">类型</label>
                                        <select class="form-control" name="channel" required>
                                            @foreach ($account->channelMsg as $channel)
                                                <option value="{{ $channel['id'] }}" {{ $account->channel == $channel['id'] ? 'selected' : '' }}>{{ $channel['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="money">金额</label>
                                        <input type="text" class="form-control" name="money"
                                               value="{{ old('money', $account->money) }}" placeholder="请输入金额">
                                    </div>

                                    <div class="form-group">
                                        <label for="operated_at">时间</label>
                                        <input type="text" class="form-control" name="operated_at"
                                               value="{{ old('operated_at', $account->operated_at) }}" placeholder="请输入时间">
                                    </div>

                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">提交</button>
                                </form>

                </div>
            </div>
        </div>
    </div>

@endsection

