@extends('admin.layouts.admin')

<?php $page_name = $admin->id ? '编辑管理员' : '创建管理员'; ?>

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
                <li><a href="{{ route('admin.admins.index') }}">管理员列表</a></li>
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
                    @if ($admin->id)
                        <form method="POST" action="{{ route('admin.admins.update', $admin->id) }}">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('admin.admins.store') }}">
                                    @endif
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">用户名</label>
                                        <input type="text" class="form-control" name="user_name"
                                               value="{{ old('user_name', $admin->user_name) }}" placeholder="请输入用户名">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">密码</label>
                                        <input type="password" class="form-control" name="password" value=""
                                               placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">姓名</label>
                                        <input type="text" class="form-control" name="real_name"
                                               value="{{ old('real_name', $admin->real_name) }}" placeholder="请输入姓名">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">手机</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="{{ old('mobile', $admin->phone) }}" placeholder="请输入手机号码">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">邮箱</label>
                                        <input type="email" class="form-control" name="email"
                                               value="{{ old('email', $admin->email) }}" placeholder="请输入邮箱地址">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">角色列表</label>

                                        @foreach($roles as $key => $role)
                                            <div class="checkbox checkbox-primary ">
                                                @if ($admin->id)
                                                    <input id="checkbox{{ $key }}" name="role_ids[]"
                                                           value="{{ $role->id }}" type="checkbox"
                                                           @if(!empty($admin['role_ids']) && in_array($role->id, $admin['role_ids'])) checked @endif>
                                                @else
                                                    <input id="checkbox{{ $role->name . $key }}" name="role_ids[]"
                                                           value="{{ $role->id }}" type="checkbox">
                                                @endif

                                                <label for="checkbox{{ $key }}"> {{ $role->name }} </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交
                                    </button>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

