@extends('store.layouts.store')

<?php $page_name = '产品型号详情'; ?>

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.specs.index') }}">产品列表</a></li>
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
                            <h2 class="m-b-0 m-t-0">{{ $spec->product->category->name }} - {{ $spec->idnumber }}</h2>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h2>￥{{ $spec->price }}
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
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                <span class="input-group-btn input-group-prepend"><button
                                                            class="btn btn-default btn-outline bootstrap-touchspin-down"
                                                            type="button">-</button></span>
                                                <input id="tch3_22" type="text" value="{{ old('number' ) }}"
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
                                                @foreach ($spec->product->colors as $color)
                                                    <option value="{{ $color['title'] }}">{{ $color['title'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">备注</label>
                                            <textarea class="form-control" rows="5"
                                                      name="remark">{{ old('remark' ) }}</textarea>
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



