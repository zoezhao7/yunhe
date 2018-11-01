@extends('store.layouts.store')

<?php $page_name = $node->id ? '编辑节点' : '创建节点'; ?>

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4> </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.nodes.index') }}">节点列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._error')

    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    @if ($node->id)
                        <form method="POST" action="{{ route('store.nodes.update', $node->id) }}">
                        {{ method_field('PUT') }}
                    @else
                         <form method="POST" action="{{ route('store.nodes.store') }}">
                    @endif
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputEmail1">控制器名称</label>
                            <input type="text" class="form-control" name="controller_name" value="{{ old('controller_name', $node->controller_name) }}" placeholder="请输入控制器名称">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">控制器</label>
                            <input type="text" class="form-control" name="controller" value="{{ old('controller', $node->controller) }}" placeholder="请输入控制器">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">操作名称</label>
                            <input type="text" class="form-control" name="action_name" value="{{ old('action_name', $node->action_name) }}" placeholder="请输入操作名称">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">操作</label>
                            <input type="text" class="form-control" name="action" value="{{ old('action', $node->action) }}" placeholder="请输入操作">
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

