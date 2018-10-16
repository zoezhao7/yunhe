@extends('admin.layouts.admin')

<?php $page_name = '订单详情'; ?>

@section('title', $page_name)

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <link href="/admin/plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li><a href="{{ route('admin.stock_orders.index') }}">备货订单列表</a></li>
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
                            @if($stockOrder->status == 0)
                                <button class="btn btn-info" style="float:right;" id="btn-jiedan">接单</button>
                            @elseif($stockOrder->status == 1)
                                <button class="btn btn-info" style="float:right;" data-toggle="modal"
                                        data-target="#responsive-modal" id="btn-fahuo">发货
                                </button>
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
                            <th width="10%">CID</th>
                            <th width="5%">数量</th>
                            <th width="10">图片</th>
                            <th width="15%">产品&尺寸</th>
                            <th width="10%">颜色</th>
                            <th width="25%">备注</th>
                            <th width="25%">轮毂sn清单</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $number_count = 0;?>
                        @foreach($stockOrderProducts as $stockOrderProduct)
                            <input type="hidden" id="order_product_id_{{ $stockOrderProduct->id }}"
                                   value="{{ $stockOrderProduct->id }}">
                            <input type="hidden" id="order_product_color_{{ $stockOrderProduct->id }}"
                                   value="{{ $stockOrderProduct->color }}">
                            <input type="hidden" id="order_product_number_{{ $stockOrderProduct->id }}"
                                   value="{{ $stockOrderProduct->number }}">
                            <input type="hidden" id="order_product_cid_{{ $stockOrderProduct->id }}"
                                   value="{{ $stockOrderProduct->spec->idnumber }}">
                            <tr>
                                <td>{{ $stockOrderProduct->spec->idnumber }}</td>
                                <td class="font-500" align="center">{{ $stockOrderProduct->number }}</td>
                                <td><img src="{{ $stockOrderProduct->spec->product->image }}" alt="" width="80"></td>
                                <td>
                                    {{ $stockOrderProduct->spec->product->category->name }}
                                    -{{ $stockOrderProduct->spec->product->name }}<br>
                                    尺寸：{{ $stockOrderProduct->spec->size }}
                                </td>
                                <td style="line-height:28px;">
                                    {{ $stockOrderProduct->color }}
                                </td>
                                <td class="font-500">{{ $stockOrderProduct->remark }}</td>
                                <td style="line-height: 28px;">
                                    @foreach($stockOrderProduct->hubs as $hub)
                                        <span class="label label-info">{{ $hub->sn }}</span>
                                    @endforeach

                                    @if($stockOrder->status == 1)
                                        <button onclick="add_sn({{ $stockOrderProduct->id }});" data-toggle="modal"
                                                data-target="#sn-modal" class="btn btn-outline btn-sm btn-info">添加SN码
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="font-500" align="right"><strong>总计：</strong></td>
                            <td class="font-500" align="center"><strong>{{ $number_count }}</strong></td>
                            <td colspan="5"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <div class="table-responsive">
        {{-- 发货单 --}}
        <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">发货单</h4></div>
                    <div class="modal-body">
                        <form onsubmit="return form_check(this);" id="delivery_form"
                              action="{{ route('admin.stock_orders.delivery', $stockOrder->id) }}"
                              method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">发货时间：</label>
                                <input type="text" class="form-control input-daterange-datepicker" id="delivered_time"
                                       name="delivered_at" required></div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">物流单号：</label>
                                <input type="text" class="form-control" id="" name="delivery_number" required></div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">备注：</label>
                                <textarea class="form-control" id="" name="delivery_note"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">取消
                                </button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">确认发货
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        {{-- 填写SN码 --}}
        <div id="sn-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">填写轮毂SN码</h4></div>
                    <div class="modal-body">
                        <form onsubmit="return form_check(this);" id="delivery_form"
                              action="{{ route('admin.stock_orders.hubs.store') }}"
                              method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="stock_order_product_id" id="stock_order_product_id">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">CID：</label>
                                <input type="text" class="form-control" id="sn_cid" disabled></div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">色彩：</label>
                                <input type="text" class="form-control" id="sn_color" disabled></div>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">数量：</label>
                                <input type="text" class="form-control" id="sn_number" disabled></div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">SN（数字/字母，15-20位）：</label>
                                <div id="ipts">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">取消
                                </button>
                                <button type="submit" class="btn btn-danger waves-effect waves-light">保存
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Button trigger modal -->
    </div>

@endsection

@section('script')
    <script src="/admin/plugins/bower_components/moment/moment.js"></script>
    <script src="/admin/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="/admin/plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        function add_sn(so_pid) {
            var order_product_color = $("#order_product_color_" + so_pid).val();
            var order_product_number = $("#order_product_number_" + so_pid).val();
            var order_product_cid = $("#order_product_cid_" + so_pid).val();

            $("#stock_order_product_id").val(so_pid);
            $("#sn_cid").val(order_product_cid);
            $("#sn_color").val(order_product_color);
            $("#sn_number").val(order_product_number);

            $("#ipts").html('');
            for (var i = 0; i < order_product_number; i++) {
                $("#ipts").append('<input type="text" class="form-control" name="sns[]" placeholder="sn..." required autocomplete="off"><br>');
            }
        }


        $('#btn-jiedan').click(function () {

            $('html').block({
                message: '<h4><img src="/admin/plugins/images/busy.gif" /> 接单处理中...</h4>',
                css: {border: '1px solid #fff'}
            });

            $.post(
                "/admin/stock_orders/{{ $stockOrder->id }}/order_taking",
                {
                    _token: $('meta[name="csrf-token"]').attr('content')
                }, function (data) {
                    $('html').unblock();
                    if (data.success) {
                        swal({
                            title: '接单成功！',
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

        });


        !function ($) {
            "use strict";
            var SweetAlert = function () {
            };
            SweetAlert.prototype.init = function () {
                //Success Message
                $('#sa-success').click(function () {
                    swal("接单成功！", "", "success")
                });
            },
                //init
                $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
        }(window.jQuery),
            function ($) {
                "use strict";
                $.SweetAlert.init()
            }(window.jQuery);


        $('#delivered_time').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker24Hour": true,
            "locale": {
                "format": 'YYYY-MM-DD hh:mm',
                "applyLabel": '确定',
                "cancelLabel": '取消',
                "daysOfWeek": ['日', '一', '二', '三', '四', '五', '六'],
                "monthNames": ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月']
            }
        });
    </script>
@endsection