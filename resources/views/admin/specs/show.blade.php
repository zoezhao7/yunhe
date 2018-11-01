@extends('admin.layouts.admin')

<?php $page_name = '产品尺寸详情'; ?>

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li><a href="{{ route('admin.products.index') }}">产品列表</a></li>
                <li><a href="{{ route('admin.products.specs', $spec->product_id) }}">{{ $spec->product->name }}型号列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
    </div>

    @include('admin.common._message')
    @include('admin.common._error')

    <div class="row">
        <div class="col-lg-8">
            <div class="white-box">
                <div class="">
                    <h2 class="m-b-0 m-t-0">型号ID：{{ $spec->idnumber }}</h2>
                    <small class="text-muted db">{{ $spec->product->name }}</small>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6">
                            <div class="white-box text-center" style="margin-bottom: 0;">
                                <img src="{{ $spec->product->image }}" class="img-responsive"/>
                            </div>
                            @foreach($spec->product->colors as $color)
                                <div style="width:50%;float: left;text-align:center;">
                                    <img src="{{ $color['path'] }}" width="70%" class="thumbnail img-responsive" style="margin:auto;">
                                    <small>{{ $color['title'] }}</small>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-6">
                            <h4 class="box-title m-t-40">{{ $spec->product->category->name }} - {{ $spec->product->name }}</h4>
                            <p>{{ $spec->product->intro }}</p>
                            <h2 class="m-t-40">￥{{ $spec->price }}
                                <small class="text-success">({{ $spec->product->discount * 100 }}% 折扣)</small>
                            </h2>
                            <h3 class="box-title m-t-20">尺寸：{{ $spec->size }}</h3>
                            <h3 class="box-title m-t-20">规格参数：</h3>
                            @foreach($spec->content as $key=>$value)
                                <span class="label label-success">{{ $key }}：{{ $value }}</span>
                            @endforeach
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
                        <th>门店</th>
                        <th width="20%">状态</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hubs as $hub)
                        <tr @if($hub->order_id)style="color: #98a6ad;"@endif>
                            <td>{{ $hub->sn }}</td>
                            <td>{{ $hub->color }}</td>
                            <td>{{ $hub->store->name }}</td>
                            <td>@if($hub->status==1)
                                    <span class="label label-warning">备货中</span>
                                @elseif($hub->status==2)
                                    <span class="label label-info">在库</span>
                                @else
                                    <span class="label label-danger">售出</span>
                                @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection


