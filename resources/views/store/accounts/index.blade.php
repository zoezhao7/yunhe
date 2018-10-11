@extends('store.layouts.store')

@section('title', '账务管理')

@section('style')
    <link href="/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">账务列表</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="{{ route('store.accounts.create') }}"
               class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">记账</a>
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">账务列表</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">


            <div class="panel-body" style="padding-top:0;padding-left:0;">
                <form>
                    <div class="col-sm-6">
                        <div class="input-daterange input-group" id="date-range">
                            <input type="text" class="form-control single-date" name="stime" autocomplete="off" value="{{ $request->stime }}" autocomplete="off" placeholder="开始日期">
                            <span class="input-group-addon bg-info b-0 text-white">到</span>
                            <input type="text" class="form-control single-date" name="etime" value="{{ $request->etime }}" autocomplete="off" placeholder="结束日期">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table member-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>收支</th>
                        <th>类型</th>
                        <th>金额</th>
                        <th>时间</th>
                        <th width="30%">备注</th>
                        <th>操作员</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($accounts as $key => $account)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <span class="label {{ $account->typeMsg[$account->type]['label_class'] }}" >{{ $account->typeMsg[$account->type]['name'] }}</span>
                            </td>
                            <td>{{ $account->channel }}</td>
                            <td>{{ $account->money }}</td>
                            <td>{{ date('Y-m-d', strtotime($account->operated_at)) }}</td>
                            <td>{{ $account->remark }}</td>
                            <td>{{ $account->employee->name }}</td>
                            <td>
                                <form onsubmit="return confirm('确认删除吗？');" id="delete_form" method="post"
                                      action="{{ route('store.accounts.destroy', $account->id) }}"
                                      style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-outline btn-xs btn-danger">删除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $accounts->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="/admin/plugins/bower_components/moment/moment.js"></script>
    <script src="/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        $('.single-date').daterangepicker({
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
