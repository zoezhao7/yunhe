@extends('store.layouts.store')

<?php $page_name = '产品尺寸详情'; ?>

@section('title', $page_name)

@section('style')
    <link href="/admin/plugins/bower_components/custom-select/dist/css/select2.min.css" rel="stylesheet"
          type="text/css"/>
@endsection

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.products.index') }}">产品列表</a></li>
                <li><a href="{{ route('store.products.specs', $spec->product_id) }}">{{ $spec->product->name }}型号列表</a>
                </li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')
    @include('store.common._error')

    <div class="row">
        <div class="col-lg-8">
            <div class="white-box">
                <div class="">
                    <div style="height: 55px;">
                        <div class="col-lg-8">
                            <h2 class="m-b-0 m-t-0">型号ID：{{ $spec->idnumber }}</h2>
                            <small class="text-muted db">{{ $spec->product->name }}</small>
                        </div>
                        {{--                        <div class="col-lg-4">
                                                    <a href="{{ route('store.specs.stock_orders.create', $spec->id) }}"
                                                       class="btn btn-outline btn-info" style="float:right;">备货</a>
                                                </div>--}}
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-center" style="margin-bottom: 0;">
                                <img src="{{ $spec->product->image }}" class="img-responsive"/>
                            </div>
                            @if($spec->product->colors)
                                @foreach($spec->product->colors as $color)
                                    <div style="width:50%;float: left;text-align:center;">
                                        <img src="{{ $color['path'] }}" width="70%" class="thumbnail img-responsive"
                                             style="margin:auto;">
                                        <small>{{ $color['title'] }}</small>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h4 class="box-title m-t-40">{{ $spec->product->category->name }}
                                - {{ $spec->product->name }}</h4>
                            <p>{{ $spec->product->intro }}</p>
                            <h2 class="m-t-40">￥{{ $spec->price }}
                                <small class="text-success">({{ $spec->product->discount * 100 }}% 折扣)</small>
                            </h2>
                            <h3 class="box-title m-t-20">尺寸：{{ $spec->size }}</h3>
                            <h3 class="box-title m-t-20">规格参数：</h3>
                            <div style="line-height: 28px;">
                                @foreach($spec->content as $key=>$value)
                                    <span class="label label-success">{{ $key }}：{{ $value }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h3 class="box-title m-t-30 m-b-0 m-l-20">备货：</h3>
                            <hr style="margin-top: 5px;">
                            <div class="table-responsive">
                                <div class="col-sm-6 col-xs-6">
                                    <form  method="POST"
                                          action="{{ route('store.stock_orders.add_product') }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="product_id" value="{{ $spec->product->id }}"/>
                                        <input type="hidden" name="spec_id" value="{{ $spec->id }}"/>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">轮毂个数：</label>
                                            <input type="text" value="{{ old('number' ) }}" name="number" required
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">轮毂色彩：</label>
                                            <select class="form-control" name="color" required>
                                                <option value="">请选择轮毂色彩</option>
                                                @foreach ($spec->product->colors as $color)
                                                    <option value="{{ $color['title'] }}">{{ $color['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">汽车型号：</label>
                                            <select class="form-control select2" name="car_vehicle_id" required>
                                                <option>选择车型</option>

                                                @foreach ($vehicleTree as $brand)
                                                    <optgroup label="{{ $brand['brand']['name'] }}">
                                                        @foreach ($brand['vehicles'] as $vehicle)
                                                            <option value="{{ $vehicle['id'] }}">{{ $vehicle['name'] }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">备注</label>
                                            <textarea class="form-control" rows="5"
                                                      name="remark">{{ old('remark' ) }}</textarea>
                                        </div>

                                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">下单
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="white-box">
                <h2>库存清单</h2>
                <hr>
                <table class="table product-overview color-table info-table">
                    <thead>
                    <tr>
                        <th>sn</th>
                        <th>色彩</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hubs as $hub)
                        <tr @if($hub->order_id)style="color: #98a6ad;"@endif>
                            <td>{{ $hub->sn }}</td>
                            <td>{{ $hub->color }}</td>
                            <td>@if($hub->order_id)售出@else在库@endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script src="/admin/plugins/bower_components/custom-select/dist/js/select2.full.min.js"
            type="text/javascript"></script>
    <script>
        $(function () {
            // For select 2
            $(".select2").select2();

            //选中后回调
            $(".select2").on("change", function (e) {
                console.log(e.target.value);
            });
            //选完之后回去值
            setTimeout(function () {
                console.log($(".select2").val());
            }, 4000);
        });
    </script>
@endsection


