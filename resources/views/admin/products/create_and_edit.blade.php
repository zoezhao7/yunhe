@extends('admin.layouts.admin')

<?php $page_name = $product->id ? '编辑产品' : '添加产品'; ?>

@section('title', $page_name)

@section('style')
    <link rel="stylesheet" href="/admin/simditor/css/simditor.css"/>
@endsection

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
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._error')

    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    @if ($product->id)
                        <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                              enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('admin.products.store') }}"
                                      enctype="multipart/form-data">
                                    @endif
                                    {{ csrf_field() }}

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>在售/下架</strong></label>
                                            <select class="form-control" name="is_sale" required>
                                                <option value="1" {{ $product->is_sale ? '' : 'selected' }}>在售</option>
                                                <option value="0" {{ !$product->is_sale ? '' : 'selected' }}>下架</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>产品名称</strong></label>
                                            <input type="text" class="form-control" name="name"
                                                   value="{{ old('name', $product->name) }}" placeholder="请输入产品名称">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>产品分类</strong></label>
                                            <select class="form-control" name="category_id" required>
                                                <option value="" hidden disabled {{ $product->id ? '' : 'selected' }}>
                                                    请选择分类
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>产品折扣</strong></label>
                                            <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                                <input type="text" value="{{ old('discount', $product->discount) }}"
                                                       name="discount" class="form-control">
                                                <span class="input-group-addon bootstrap-touchspin-postfix input-group-append">
                                                <span class="input-group-text">%</span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>产品简介</strong></label>
                                            <textarea name="intro" class="form-control"
                                                      rows="4">{{ old('intro', $product->intro) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>产品详情</strong></label>
                                            <div class="form-group">
                                                <textarea name="content" id="editor" rows="12"
                                                          placeholder="请输入产品详细介绍...">{!! $product->content !!}</textarea>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交
                                        </button>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><strong>产品图片</strong></label>
                                            <div class="form-group">
                                                @if ($product->image)
                                                    <img src="{{ $product->image }}" width="200"
                                                         class="thumbnail img-responsive">
                                                @endif
                                                <input type="file" name="image"/>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>轮毂色彩</strong></label>
                                            <div class="row upload_row">

                                                @if($product->id)
                                                    @foreach ($product->colors as $key => $color)
                                                        <div class="col-sm-6 ol-md-6 col-xs-12 m-b-20">
                                                            <img src="{{ $color['path'] }}"
                                                                 class="thumbnail img-responsive" width="200">
                                                            <div><input type="file" class="dropify"
                                                                        name="colors[file][]"></div>
                                                            <input type="hidden" name="colors[path][]"
                                                                   value="{{ $color['path'] }}">
                                                            <input type='text' class="form-control m-t-10"
                                                                   name="colors[title][]" data-show-remove="false"
                                                                   placeholder="输入色彩名称" value="{{ $color['title'] }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                                <div class="col-sm-6 ol-md-6 col-xs-12 m-b-20">
                                                    <div><input type='file' class="dropify" name="colors[file][]"/>
                                                    </div>
                                                    <input type='text' class="form-control m-t-10"
                                                           name="colors[title][]" data-show-remove="false"
                                                           placeholder="输入色彩名称">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6 ol-md-6 col-xs-12">
                                                    <button class="btn btn-block btn-info" type="button"
                                                            style="width: 200px;" onclick="addUpload()">添加色彩
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('admin/simditor/js/module.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/simditor/js/hotkeys.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/simditor/js/uploader.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admin/simditor/js/simditor.js') }}"></script>

    <script>
        $(document).ready(function () {
            var editor = new Simditor({
                textarea: $('#editor'),
            });
        });

        var messages = {
            'default': '上传图片',
            'replace': '替换图片',
            'remove': '删除',
            'error': '上传时发生未知错误'
        };
        $(document).ready(function () {
            $('.dropify').dropify({
                messages: messages
            });
        });

        function addUpload() {
            var tpl = '<div class="col-sm-6 ol-md-6 col-xs-12 m-b-20 more_upload_box">' +
                '<div>' +
                '<input type="file" class="dropify" name="colors[file][]" />' +
                '</div>' +
                '<input type="text" class="form-control m-t-10" id="" name="colors[title][]" placeholder="输入颜色名称">' +
                '<button class="btn btn-sm btn-danger btn-outline m-t-10" type="button" onclick="deleteBox(this)" style="width: 100px;">删除</button>' +
                '</div>';
            $('.upload_row').append(tpl);
            $('.dropify').dropify({
                messages: messages
            });
        }

        function deleteBox(el) {
            $(el).parents('.more_upload_box').remove();
        }
    </script>

@endsection
