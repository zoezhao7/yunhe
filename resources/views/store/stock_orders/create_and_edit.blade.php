@extends('store.layouts.store')

<?php $page_name = $stockOrder->id ? '修改备货订单' : '备货下单'; ?>

@section('title', $page_name)

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

    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="">
                    <h2 class="m-b-0 m-t-0">型号ID：{{ $spec->idnumber }}</h2>
                    <small class="text-muted db">{{ $product->name }}</small>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-center" style="margin-bottom: 0;">
                                <img src="{{ $product->image }}" class="img-responsive"/>
                            </div>
                            @foreach($product->colors as $color)
                                <div style="width:50%;float: left;text-align:center;">
                                    <img src="{{ $color['path'] }}" width="70%" class="thumbnail img-responsive" style="margin:auto;">
                                    <small>{{ $color['title'] }}</small>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h4 class="box-title m-t-40">{{ $product->category->name }} - {{ $product->name }}</h4>
                            <p>{{ $product->intro }}</p>
                            <h2 class="m-t-40">￥{{ $spec->price }}
                                <small class="text-success">({{ $product->discount }} 折扣)</small>
                            </h2>
                            <h3 class="box-title m-t-20">尺寸：{{ $spec->size }}</h3>
                            <h3 class="box-title m-t-20">型号参数：</h3>
                            @foreach($spec->content as $key=>$value)
                                <span class="label label-success">{{ $key }}：{{ $value }}</span>
                            @endforeach
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-30 m-b-0 m-l-20">下单</h3>
                            <hr style="margin-top: 5px;">
                            <div class="table-responsive">
                                <div class="col-sm-6 col-xs-6">
                                    @if ($stockOrder->id)
                                        <form onsubmit="return form_check(this);" method="POST"
                                              action="{{ route('store.stock_orders.update', $stockOrder->id) }}"
                                              enctype="multipart/form-data">
                                            {{ method_field('PUT') }}
                                            @else
                                                <form onsubmit="return form_check(this);" method="POST" action="{{ route('store.stock_orders.store') }}">
                                                    @endif
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}"/>
                                                    <input type="hidden" name="spec_id" value="{{ $spec->id }}"/>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">进货数量（套）：</label>
                                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                            <span class="input-group-btn input-group-prepend"><button
                                                                        class="btn btn-default btn-outline bootstrap-touchspin-down"
                                                                        type="button">-</button></span>
                                                            <input id="tch3_22" type="text"
                                                                   value="{{ old('name', $stockOrder->number ? $stockOrder->number : 1) }}"
                                                                   name="number"
                                                                   data-bts-button-down-class="btn btn-default btn-outline"
                                                                   data-bts-button-up-class="btn btn-default btn-outline"
                                                                   class="form-control">
                                                            <span class="input-group-btn input-group-append"><button
                                                                        class="btn btn-default btn-outline bootstrap-touchspin-up"
                                                                        type="button">+</button></span></div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">轮毂色彩：</label>
                                                        <select class="form-control" name="color" required>
                                                            <option value="">请选择轮毂色彩</option>
                                                            @foreach ($product->colors as $color)
                                                                <option value="{{ $color['title'] }}" {{ $stockOrder->color == $color['title'] ? 'selected' : '' }}>{{ $color['title'] }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">备注</label>
                                                        <textarea class="form-control" rows="5" name="remark">{{ old('remark', $stockOrder->remark ) }}</textarea>
                                                    </div>

                                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">下单
                                                    </button>
                                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            // Switchery
            var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
            $('.js-switch').each(function () {
                new Switchery($(this)[0], $(this).data());
            });
            // For select 2
            $(".select2").select2();
            $('.selectpicker').selectpicker();
            //Bootstrap-TouchSpin
            $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }
            $("input[name='tch1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%'
            });
            $("input[name='tch2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='tch3']").TouchSpin();
            $("input[name='tch3_22']").TouchSpin({
                initval: 40
            });
            $("input[name='tch5']").TouchSpin({
                prefix: "pre",
                postfix: "post"
            });
            // For multiselect
            $('#pre-selected-options').multiSelect();
            $('#optgroup').multiSelect({
                selectableOptgroup: true
            });
            $('#public-methods').multiSelect();
            $('#select-all').click(function () {
                $('#public-methods').multiSelect('select_all');
                return false;
            });
            $('#deselect-all').click(function () {
                $('#public-methods').multiSelect('deselect_all');
                return false;
            });
            $('#refresh').on('click', function () {
                $('#public-methods').multiSelect('refresh');
                return false;
            });
            $('#add-option').on('click', function () {
                $('#public-methods').multiSelect('addOption', {
                    value: 42,
                    text: 'test 42',
                    index: 0
                });
                return false;
            });
        });
    </script>
@endsection

