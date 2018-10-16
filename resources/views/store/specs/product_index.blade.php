@extends('store.layouts.store')

@section('title', '产品规则列表')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">产品型号列表</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.products.index') }}">产品列表</a></li>
                <li class="active">产品型号列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-7">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="pan

                    el-body">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                <tr>
                                    <th style="text-align:center" width="10%">CID</th>
                                    <th style="text-align:center" width="10%">尺寸</th>
                                    <th style="text-align:center" width="10%">价格</th>
                                    <th style="text-align:center" width="50%">参数</th>
                                    <th style="text-align:center" width="10%">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($specs as $key=>$spec)
                                    <tr>
                                        <td align="center">
                                            <a href="{{ route('store.specs.show', $spec->id) }}">
                                            {{ $spec->idnumber }}
                                            </a>
                                        </td>
                                        <td align="center">{{ $spec->size }}</td>
                                        <td align="center" class="font-500">￥{{ $spec->price }}</td>
                                        <td>
                                            <p>
                                                @foreach ($spec->content as $key=>$value)
                                                    {{ $key }}:{{ $value }}&nbsp;&nbsp;&nbsp;
                                                @endforeach
                                            </p>
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('store.specs.show', $spec->id) }}" class="btn btn-default" data-toggle="tooltip">进货</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-5">
            <div class="white-box">
                <h3 class="box-title">{{ $product->name }}</h3>
                <hr>
                <small>分类</small>
                <h2> {{ $product->category->name }} </h2>
                <small>折扣</small>
                <h2> {{ $product->discount }}% </h2>
                <small>简介</small>
                <h2> {{ $product->intro }} </h2>
                <small>产品图</small>
                <h2><img src="{{ $product->image }}" width="200" class="thumbnail img-responsive"></h2>
                <small>色彩</small>
                <h2>
                    @foreach($product->colors as $color)
                        <div style="width:50%;float: left;text-align:center;"><img src="{{ $color['path'] }}" width="90" class="thumbnail img-responsive" style="margin-bottom: 0;">
                            <small>{{ $color['title'] }}</small>
                        </div>
                    @endforeach
                    <div style="clear: both;"></div>
                </h2>

            </div>
        </div>
    </div>


@endsection