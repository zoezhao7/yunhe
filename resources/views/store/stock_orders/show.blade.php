@extends('store.layouts.store')

<?php $page_name = '订单详情'; ?>

@section('title', $page_name)

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.stock_orders.index') }}">备货订单列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')
    @include('store.common._error')

    <div class="row content">
        <div class="col-md-12 col-xs-12">
            <div class="white-box">

                <h3 class="box-title">订单信息</h3>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="25%">订货人</th>
                        <th width="25%">备注</th>
                        <th width="50%">订单进度
                            @if($stockOrder->status == 2)
                                <button class="btn btn-info" style="float:right;" id="btn-received">确认收货</button>
                            @endif
                        </th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            门店：{{ $stockOrder->store->name }}<br>
                            订购人：{{ $stockOrder->employee->name }}<br>
                            电话：{{ $stockOrder->employee->phone }}<br>
                            下单时间：{{ $stockOrder->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td>
                            <p>{{ $stockOrder->remark }}</p>
                        </td>
                        <td style="line-height:28px;">
                            @if($stockOrder->status == 0)
                                <span class="label label-danger">待接单</span>
                            @endif

                            @if($stockOrder->status == 1)
                                <span class="label label-success">已接单</span>&nbsp;
                                接单时间：{{ date('m-d H:i', strtotime($stockOrder->receipted_at)) }}<br>
                                <span class="label label-danger">待发货</span>
                            @endif

                            @if($stockOrder->status == 2)
                                <span class="label label-success">已接单</span>&nbsp;
                                接单时间：{{ date('m-d H:i', strtotime($stockOrder->receipted_at)) }}<br>
                                <span class="label label-success">已发货</span>&nbsp;
                                发货时间：{{ date('m-d H:i', strtotime($stockOrder->delivered_at)) }}
                                ，物流单号：{{ $stockOrder->delivery_number }}<br>
                                <span class="label label-danger">待收货</span>
                            @endif

                            @if($stockOrder->status == 3)
                                <span class="label label-success">已接单</span>&nbsp;
                                接单时间：{{ date('m-d H:i', strtotime($stockOrder->receipted_at)) }}<br>
                                <span class="label label-success">已发货</span>&nbsp;
                                发货时间：{{ date('m-d H:i', strtotime($stockOrder->delivered_at)) }}
                                ，物流单号：{{ $stockOrder->delivery_number }}<br>
                                <span class="label label-success">已收货</span>&nbsp;
                                收货时间：{{ date('m-d H:i', strtotime($stockOrder->received_at)) }}
                            @endif

                        </td>
                    </tr>
                    </tbody>
                </table>

                <h3 class="box-title" style="margin-top: 40px;">备货清单</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>CID</th>
                            <th>数量</th>
                            <th>图片</th>
                            <th>产品&尺寸</th>
                            <th>车型</th>
                            <th>颜色</th>
                            <th width="20%">备注</th>
                            <th width="20%">轮毂sn清单</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $number_count = 0; ?>
                        @foreach($stockOrderProducts as $stockOrderProduct)
                            <?php $number_count += $stockOrderProduct->number; ?>
                            <tr>
                                <td>
                                    <a href="{{ route('store.specs.show', $stockOrderProduct->spec->id) }}">
                                        {{ $stockOrderProduct->spec->idnumber }}
                                    </a>
                                </td>
                                <td class="font-500" align="center">{{ $stockOrderProduct->number }}</td>
                                <td><img src="{{ $stockOrderProduct->spec->product->image }}" alt="" width="80"></td>
                                <td>
                                    {{ $stockOrderProduct->spec->product->category->name }}
                                    -{{ $stockOrderProduct->spec->product->name }}<br>
                                    尺寸：{{ $stockOrderProduct->spec->size }}
                                </td>
                                <td>
                                    {{ $stockOrderProduct->car_brand }} - {{ $stockOrderProduct->car_vehicle }}
                                </td>
                                <td style="line-height:28px;">
                                    {{ $stockOrderProduct->color }}
                                </td>
                                <td class="font-500">{{ $stockOrderProduct->remark }}</td>
                                <td style="line-height: 28px;">
                                    @foreach($stockOrderProduct->hubs as $hub)
                                        <span class="label label-info">{{ $hub->sn }}</span>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="font-500" align="right"><strong>总计：</strong></td>
                            <td class="font-500" align="center"><strong>{{ $number_count }}</strong></td>
                            <td colspan="6"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                @if($stockOrder->status == 1)
                @endif

                @if($stockOrder->status == 2)
                @endif

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/admin/plugins/bower_components/blockUI/jquery.blockUI.js"></script>
    <script src="/admin/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script>
        $('#btn-received').click(function () {

            swal({
                title: '确定提交订单吗？',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '确定收货！',
                cancelButtonText: '取消',
            }).then(function (data) {
                if (data.value) {
                    $.post(
                        "/store/stock_orders/{{ $stockOrder->id }}/received",
                        {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        function (data) {
                            if (data.success) {
                                swal({
                                    title: '成功确认收货！',
                                    text: '',
                                    type: 'success',
                                    showConfirmButton: false,
                                });
                                setTimeout("location.reload()", 3000);
                                return true;
                            } else {
                                swal("操作失败！", data.message, "error");
                                return false;
                            }
                        });
                }
            });
        });
    </script>
@endsection