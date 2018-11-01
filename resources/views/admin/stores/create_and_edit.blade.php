@extends('admin.layouts.admin')

<?php $page_name = $store->id ? '编辑门店' : '添加门店'; ?>

@section('title', $page_name)

@section('style')
    <link rel="stylesheet" href="/admin/simditor/css/simditor.css" />
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
                <li><a href="{{ route('admin.stores.index') }}">门店列表</a></li>
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
                    @if ($store->id)
                        <form method="POST" action="{{ route('admin.stores.update', $store->id) }}" enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('admin.stores.store') }}">
                                    @endif
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">门店名称</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{ old('name', $store->name) }}" placeholder="请输入门店名称">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">门店电话</label>
                                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $store->phone) }}" placeholder="请输入门店电话">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">门店地址</label>
                                        <input type="text" class="form-control" name="address" value="{{ old('address', $store->address) }}" placeholder="请输入门店地址">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">备注信息</label>
                                        <textarea name="remark" class="form-control" rows="5">{{ old('remark', $store->remark) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">是否营业</label>
                                        <select class="form-control" name="is_open" required>
                                            <option value="1" {{ $store->is_open == 1 ? 'selectd' : '' }}>营业</option>
                                                <option value="0" {{ $store->is_open == 0 ? 'selected' : '' }}>不营业</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交</button>
                                </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript"  src="{{ asset('admin/simditor/js/module.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('admin/simditor/js/hotkeys.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('admin/simditor/js/uploader.js') }}"></script>
    <script type="text/javascript"  src="{{ asset('admin/simditor/js/simditor.js') }}"></script>

    <script>
        $(document).ready(function(){
            var editor = new Simditor({
                textarea: $('#editor'),
            });
        });
    </script>
@endsection
