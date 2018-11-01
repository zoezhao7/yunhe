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
                <li><a href="{{ route('store.orders.index') }}">订单列表</a></li>
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
                        <th width="15%">客户</th>
                        <th width="10%">车辆</th>
                        <th width="10%">销售</th>
                        <th width="10%">销售时间</th>
                        <th width="25%">备注</th>
                        <th width="30%">
                            @if($order->status == 0)

                                <form onsubmit="return confirm('确认订单要审核失败吗？');" id="fail_form_{{$order->id}}"
                                      method="post" action="{{ route('store.orders.check_fail', $order->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <button type="submit" class="btn btn-outline btn-danger" style="float:right;margin-left: 10px;" id="">审核失败
                                    </button>
                                </form>

                                <form onsubmit="return confirm('确认订单要审核吗？');" id="success_form_{{$order->id}}"
                                      method="post" action="{{ route('store.orders.check_success', $order->id) }}">
                                    {{ csrf_field() }}
                                    {{ method_field('PUT') }}
                                    <button type="submit" class="btn btn-outline btn-success" style="float:right;" id="">审核通过
                                    </button>
                                </form>

                            @endif
                            <span style="float:left;margin-left: 10px;line-height: 34px;margin-right: 10px;">订单进度</span>
                        </th>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            姓名：{{ $order->member->name }}<br>
                            电话：{{ $order->member->phone }}<br>
                            身份证号：{{ $order->member->idnumber }}
                        </td>
                        <td>@if($order->car){{ $order->car->vehicles }}@else未绑定@endif</td>
                        <td>
                            @if($order->employee->superior_id)
                                二级销售：{{ $order->employee->name }}<br>
                                一级销售：{{ $order->employee->superior->name }}
                            @else
                                一级销售：{{ $order->employee->name }}
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            <p>{{ $order->remark }}</p>
                        </td>
                        <td style="line-height:28px;">
                            @if($order->status == 0)
                                <span class="label label-danger">待审核</span>
                            @endif

                            @if($order->status == 1)
                                <span class="label label-success">审核通过</span>&nbsp;
                            @endif

                            @if($order->status == 2)
                                <span class="label label-danger">审核失败</span>&nbsp;
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>

                <h3 class="box-title" style="margin-top: 40px;">轮毂清单</h3>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th width="10%">CID</th>
                            <th width="5%">数量</th>
                            <th width="10">图片</th>
                            <th width="15%">产品&尺寸</th>
                            <th width="10%">颜色</th>
                            <th width="25%">轮毂sn清单</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $number_count = 0; ?>
                        @foreach($order->orderProducts as $orderProduct)
                            <input type="hidden" id="order_product_id_{{ $orderProduct->id }}"
                                   value="{{ $orderProduct->id }}">
                            <input type="hidden" id="order_product_color_{{ $orderProduct->id }}"
                                   value="{{ $orderProduct->color }}">
                            <input type="hidden" id="order_product_number_{{ $orderProduct->id }}"
                                   value="{{ $orderProduct->number }}">
                            <input type="hidden" id="order_product_cid_{{ $orderProduct->id }}"
                                   value="{{ $orderProduct->spec->idnumber }}">
                            <?php $number_count += $orderProduct->number; ?>
                            <tr>
                                <td><a href="{{ route('store.specs.show', $orderProduct->spec->id) }}">{{ $orderProduct->spec->idnumber }}</a></td>
                                <td class="font-500" align="center">{{ $orderProduct->number }}</td>
                                <td><img src="{{ $orderProduct->spec->product->image }}" alt="" width="80"></td>
                                <td>
                                    {{ $orderProduct->spec->product->category->name }}
                                    -{{ $orderProduct->spec->product->name }}<br>
                                    尺寸：{{ $orderProduct->spec->size }}
                                </td>
                                <td style="line-height:28px;">
                                    {{ $orderProduct->color }}
                                </td>
                                <td style="line-height: 28px;">
                                    @foreach($orderProduct->hubs as $hub)
                                        <span class="label label-info">{{ $hub->sn }}</span>
                                    @endforeach

                                    @if($order->status == 0)
                                        <button onclick="add_sn({{ $orderProduct->id }});" data-toggle="modal"
                                                data-target="#sn-modal" class="btn btn-outline btn-info">添加sn
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
        {{-- 添加sn --}}
        <div id="sn-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">添加sn</h4></div>
                    <form  id="delivery_form" action="{{ route('store.order_products.hubs.bindding') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" id="order_product_id" name="order_product_id" value="">
                    <div class="modal-body">
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
                                <label for="message-text" class="control-label">SN：</label>
                                <div id="ipts">
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">取消
                        </button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">提交
                        </button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function add_sn(so_pid) {
            var order_product_color = $("#order_product_color_" + so_pid).val();
            var order_product_number = $("#order_product_number_" + so_pid).val();
            var order_product_cid = $("#order_product_cid_" + so_pid).val();

            $("#order_product_id").val(so_pid);
            $("#sn_cid").val(order_product_cid);
            $("#sn_color").val(order_product_color);
            $("#sn_number").val(order_product_number);

            $("#ipts").html('');
            for (var i = 0; i < order_product_number; i++) {
                $("#ipts").append('<input type="text" class="form-control" name="sns[]" placeholder="sn..." required autocomplete="off"><br>');
            }
        }
    </script>
@endsection

