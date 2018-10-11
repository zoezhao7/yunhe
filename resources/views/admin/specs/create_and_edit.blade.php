@extends('admin.layouts.admin')

<?php $page_name = $spec->id ? '编辑型号' : '添加型号'; ?>

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li><a href="{{ route('admin.products.index') }}">产品列表</a></li>
                <li><a href="{{ route('admin.products.specs', $product->id) }}">产品型号列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._error')

    <div class="col-md-9">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    @if ($spec->id)
                        <form method="POST" action="{{ route('admin.specs.update', $spec->id) }}"
                              enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('admin.specs.store') }}" enctype="multipart/form-data">
                                    @endif
                                    {{ csrf_field() }}
                                    <input type="hidden" name="product_id" value="{{ $product->id }}" >
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">型号ID</label>
                                        <input type="text" class="form-control" name="idnumber" value="{{ old('idnumber', $spec->idnumber) }}" placeholder="型号ID"
                                               @if ($spec->id) readonly @endif required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">尺寸</label>
                                            <input type="text" class="form-control" name="size" value="{{ old('size', $spec->size) }}" placeholder="请输入尺寸" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">价格</label>
                                        <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                            <input type="text" value="{{ old('price', $spec->price) }}" name="price" class="form-control" required>
                                            <span class="input-group-addon bootstrap-touchspin-postfix input-group-append">
                                                <span class="input-group-text">元</span>
                                            </span>
                                        </div>
                                    </div>
                                    <h3>参数</h3>
                                    <hr>
                                    <div class="form-group">
                                        <div class="row params_box">
                                            @if($spec->id)
                                                @foreach($spec->content as $key=>$value)
                                                    <div>
                                                        <div class="col-sm-3 ol-md-3 m-b-10">
                                                            <input type="text" class="form-control" id="" name="param_key[]" placeholder="参数名" value="{{ $key }}">
                                                        </div>
                                                        <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;">：</div>
                                                        <div class="col-sm-6 ol-md-6 m-b-10">
                                                            <input type="text" class="form-control" id="" name="param_value[]" placeholder="{{ $value }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                @foreach(\App\Models\Spec::$paramMsg as $key=>$value)
                                                    <div>
                                                        <div class="col-sm-3 ol-md-3 m-b-10">
                                                            <input type="text" class="form-control" id="" name="param_key[]" placeholder="参数名" value="{{ $value['name'] }}">
                                                        </div>
                                                        <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;">：</div>
                                                        <div class="col-sm-6 ol-md-6 m-b-10">
                                                            <input type="text" class="form-control" id="" name="param_value[]" placeholder="例：{{ $value['placeholder'] }}">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 ol-md-6 col-xs-12">
                                                <button class="btn btn-block btn-outline btn-info" type="button" style="width: 200px;" onclick="addParams()">添加参数</button>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交</button>
                                </form>

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
            <hr>
            <img src="{{ $product->image }}" width="200"
                 class="thumbnail img-responsive">
        </div>
    </div>

@endsection

@section('script')
    <script>
        function addParams(){
            var tpl =  '<div class="params_more_box clearfix">'+
                '<div class="col-sm-3 ol-md-3 m-b-10">'+
                '<input type="text" class="form-control" id="" name="param_key[]" placeholder="参数名">'+
                '</div>'+
                '<div class="col-sm-1 ol-md-1 m-b-10" style="line-height: 32px;text-align: center;padding:0;">:</div>'+
                '<div class="col-sm-6 ol-md-6 m-b-10">'+
                '<input type="text" class="form-control" id=""  name="param_value[]" placeholder="参数值">'+
                '</div>'+
                '<div class="col-sm-2 ol-md-2 m-b-10" style="width: 100px;">'+
                '<button class="btn btn-block btn-outline btn-danger" type="button" onclick="deleteParamsInput(this)">删除</button>'+
                '</div>'+
                '</div>';
            $('.params_box').append(tpl);
        }

        function deleteParamsInput(el){
            $(el).parents('.params_more_box').remove();
        }
    </script>
@endsection
