@extends('admin.layouts.admin')

{{ $page_name = $product->id ? '编辑产品' : '添加产品'  }}

@section('title', $page_name)

@section('style')
    <link rel="stylesheet" href="/admin/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />
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

    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    @if ($product->id)
                        <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('admin.products.store') }}">
                                    @endif
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">产品名称</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{ old('name', $product->name) }}" placeholder="请输入用户名">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">产品分类</label>
                                        <select class="form-control" name="category_id" required>
                                            <option value="" hidden disabled {{ $product->id ? '' : 'selected' }}>请选择分类</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">产品简介</label>
                                        <input type="text" class="form-control" name="intro" value="{{ old('intro', $product->intro) }}"
                                               placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">产品图片</label>
                                        <div class="form-group">
                                            <input type="file" name="image" />
                                            <br>
                                            @if ($product->id)
                                            <img src="{{ $product->image }}" width="200" class="thumbnail img-responsive">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">产品详情</label>
                                        <div class="form-group">
                                            <textarea class="textarea_editor form-control" rows="15" placeholder="Enter text ..."></textarea>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交
                                    </button>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <!-- wysuhtml5 Plugin JavaScript -->
    <script src="/admin/plugins/bower_components/html5-editor/wysihtml5-0.3.0.js"></script>
    <script src="/admin/plugins/bower_components/html5-editor/bootstrap-wysihtml5.js"></script>
    <script>
        $(document).ready(function() {
            $('.textarea_editor').wysihtml5();
        });
    </script>
    <!--Style Switcher -->
@endsection
