@extends('store.layouts.store')

<?php $page_name = '备货清单'; ?>

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

                <h3 class="box-title">备货清单</h3>

                @if($products->isEmpty())
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="10%">CID</th>
                                <th width="20%">轮毂图片</th>
                                <th width="25%">产品&型号&尺寸</th>
                                <th width="10%">色彩</th>
                                <th width="5%">数量</th>
                                <th width="25%">备注</th>
                                <th width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="7" style="text-align:center;">还没有添加产品</td>
                            </tr>
                            </tbody>

                        </table>
                        <a href="{{ route('store.products.index') }}">
                            <button class="btn btn-default btn-outline"><i class="fa fa-arrow-left"></i> 添加产品</button>
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th width="10%">CID</th>
                                <th width="20%">轮毂图片</th>
                                <th width="20%">产品&型号&尺寸</th>
                                <th width="10%">色彩</th>
                                <th width="10%">数量</th>
                                <th width="25%">备注</th>
                                <th width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $key=>$product)
                                <tr>
                                    <td><a href="{{ route('store.specs.show', $product->spec->id) }}">{{ $product->spec->idnumber }}</a></td>
                                    <td><img src="{{ $product->spec->product->image }}" alt="iMac" width="80"></td>
                                    <td>
                                        型号：{{ $product->spec->product->category->name }}<br>
                                        产品：{{ $product->spec->product->name }}<br>
                                        尺寸：{{ $product->spec->size }}<br>
                                    </td>
                                    <td style="line-height:28px;">
                                        {{ $product->color }}
                                    </td>
                                    <td>
                                        <input type="hidden" class="sop_id" value="{{ $product->id }}" >
                                        <input type="text" class="form-control sop_number" value="{{ $product->number }}">
                                    </td>
                                    <td>{{ $product->remark }}</td>
                                    <td>
                                        <form onsubmit="return confirm('确定要从备货清单中删除该产品吗？');"
                                              action="{{ route('store.stock_orders.product.destroy', $product->id) }}"
                                              method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('delete') }}
                                            <button type="submit" class="btn btn-xs btn-outline btn-danger">删除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="1" style="text-align:right;">备注：</td>
                                <td colspan="6"><textarea id="remark" name="remark" class="form-control" rows="5"></textarea></td>
                            </tr>
                            </tbody>

                        </table>
                        <button onclick="submitOrder();" class="btn btn-danger pull-right"><i
                                    class="fa fa fa-shopping-cart"></i>
                            提交订单
                        </button>
                        <a href="{{ route('store.products.index') }}">
                            <button class="btn btn-default btn-outline"><i class="fa fa-arrow-left"></i> 继续添加产品</button>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="/admin/plugins/bower_components/blockUI/jquery.blockUI.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.all.min.js"></script>
    <script>

        function submitOrder() {
            /*            swal({
                            title: '确定提交订单吗？',
                            text: '',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '确定提交！',
                            cancelButtonText: '取消',
                        }).then(function(data){
                            if(data.value) {
                                swal(
                                    '订单提交成功',
                                    '你的文件已经被删除。',
                                    'success'
                                );
                            }

                        });
                        return false;*/
            var number_data = [];
            $(".sop_id").each(function(i, c){
                number_data.push({
                    id: $(".sop_id")[i].value,
                    number: $(".sop_number")[i].value,
                })
            });

            $.post(
                "{{ route('store.stock_orders.store') }}",
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    remark: $('#remark').val(),
                    numbers: number_data,
                }, function (data) {
                    if (data.success) {
                        swal({
                            title: '备货订单提交成功！',
                            text: '',
                            type: 'success',
                            showConfirmButton: false,
                        });
                        setTimeout(function(){
                            window.location.href = '/store/stock_orders/' + data.data.stock_order_id;
                        }, 3000);
                        return true;
                    } else {
                        swal("操作失败，请重新尝试！", data.message, "error");
                        return false;
                    }
                });
        }


        /*            $('html').block({
                        message: '<h4><img src="/store/plugins/images/busy.gif" /> 确认收货中...</h4>',
                        css: {border: '1px solid #fff'}
                    });*/


    </script>
@endsection