@extends('store.layouts.store')

<?php $page_name = $employee->id ? '编辑员工' : '添加员工'; ?>

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
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.employees.index') }}">员工列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._message')
    @include('store.common._error')

    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    @if ($employee->id)
                        <form method="POST" action="{{ route('store.employees.update', $employee->id) }}"
                              enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('store.employees.store') }}">
                                    @endif
                                    {{ csrf_field() }}
                                    <input type="hidden" name="store_id" value="{{ $store_id }}" />

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">姓名</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{ old('name', $employee->name) }}" placeholder="请输入姓名">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">电话</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="{{ old('phone', $employee->phone) }}" placeholder="请输入电话">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">密码</label>
                                        <input type="password" class="form-control" name="password" value="" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">身份证号</label>
                                        <input type="text" class="form-control" name="idnumber"
                                               value="{{ old('idnumber', $employee->idnumber) }}" placeholder="请输入身份证号">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">身份</label>
                                        <select class="form-control" name="type" required>
                                            @foreach (\App\Models\Employee::$typeMsg as $type)
                                                <option value="{{ $type['id'] }}" {{ $employee->type == $type['id'] ? 'selected' : '' }}>{{ $type['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">上级（渠道归属的销售）：</label>
                                        <select class="form-control" name="superior_id" required>
                                            <option value="0">无</option>
                                            @foreach ($employees as $item)
                                                <option value="{{ $item['id'] }}" {{ $employee->superior_id == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">状态</label>
                                        <select class="form-control" name="status" required>
                                            @foreach (\App\Models\Employee::$statusMsg as $status)
                                                <option value="{{ $status['id'] }}" {{ $employee->status == $status['id'] ? 'selected' : '' }}>{{ $status['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">后台角色</label>
                                        @foreach($roles as $key => $role)
                                            <div class="checkbox checkbox-primary ">
                                                @if ($employee->id)
                                                    <input id="checkbox{{ $key }}" name="role_ids[]"
                                                           value="{{ $role->id }}" type="checkbox"
                                                           @if(!empty($employee['role_ids']) && in_array($role->id, $employee['role_ids'])) checked @endif>
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

