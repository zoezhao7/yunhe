@extends('store.layouts.store')

@section('title', '佣金管理')

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">佣金记录</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="{{ route('store.commissions.make') }}" class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">生成本月佣金记录</a>
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">佣金记录</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">

            <div class="panel-body" style="padding-top:0;padding-left:0;">
                <form>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="employee_name"
                               value="{{ $request->employee_name }}" placeholder="姓名">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="commission_type">
                            <option value="">佣金类型</option>
                            <option value="order" @if($request->commission_type == 'order') selected @endif>轮毂销售
                            </option>
                            <option value="subordinate" @if($request->commission_type == 'subordinate') selected @endif>
                                渠道提成
                            </option>
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="month"
                               value="{{ $request->month }}" placeholder="2018-09">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table member-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>姓名</th>
                        <th>佣金（元）</th>
                        <th>类型</th>
                        <th>来源</th>
                        <th>日期</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sum_money = 0; ?>
                    @foreach ($commissions as $key => $commission)
                        <?php $sum_money += $commission->money; ?>
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $commission->employee_name }}</td>
                            <td>{{ $commission->money }}</td>
                            <td>
                                @if ($commission->type == 'order')
                                    <span class="label label-danger">一级销售</span>
                                @endif
                                @if ($commission->type == 'subordinate')
                                    <span class="label label-info">二级销售</span>
                                @endif
                            </td>
                            <td>
                                @if ($commission->type == 'order')
                                    订单编号：[{{ $commission->order_idnumber }}]
                                @endif
                                @if ($commission->type == 'subordinate')
                                    渠道：{{ $commission->subordinate_name }}</br>
                                    订单：{{ $commission->order->idnumber }}
                                @endif
                            </td>
                            <td>
                                {{ date('Y-m-d', strtotime($commission->order_dealt_at)) }}
                            </td>
                        </tr>
                    @endforeach
                    <tfoot>
                        <tr>
                            <th>总计：</th>
                            <th></th>
                            <th>{{ $sum_money }}</th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

@endsection