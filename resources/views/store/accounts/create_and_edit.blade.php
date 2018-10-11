@extends('store.layouts.store')

<?php $page_name = $account->id ? '编辑账务' : '添加账务'; ?>

@section('title', $page_name)

@section('style')
    <link href="/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

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
                                <form onsubmit="return form_check(this);" method="POST" action="{{ route('store.accounts.store') }}">
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
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <input type="text" class="form-control" name="money" value="{{ old('money', $account->money) }}" placeholder="请输入金额" required>
                                            <span class="input-group-addon bootstrap-touchspin-postfix input-group-append">
                                                <span class="input-group-text">元</span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="operated_at">时间</label>
                                        <input type="text" id="acctount_time" class="form-control input-daterange-datepicker" name="operated_at" value="{{ old('operated_at', $account->operated_at) }}" placeholder="请选择时间" autocomplete="off" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="remark">备注</label>
                                        <textarea class="form-control" rows="5" name="remark">{{ old('remark', $account->remark) }}</textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">提交</button>
                                </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/admin/plugins/bower_components/moment/moment.js"></script>
    <script src="/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        $('#acctount_time').daterangepicker({
            "autoUpdateInput": false,
            "singleDatePicker":true,
            "locale": {
                "format": 'YYYY-MM-DD',
                "applyLabel": '确定',
                "cancelLabel": '取消',
                "daysOfWeek": ['日', '一', '二', '三', '四', '五', '六'],
                "monthNames": ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
            }
        }).on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });
    </script>

@endsection

