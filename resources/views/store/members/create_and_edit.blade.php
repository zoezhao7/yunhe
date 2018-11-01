@extends('store.layouts.store')

<?php $page_name = $member->id ? '编辑客户资料' : '添加客户资料'; ?>

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
                <li><a href="{{ route('store.members.index') }}">客户列表</a></li>
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
                    @if ($member->id)
                        <form method="POST" action="{{ route('store.members.update', $member->id) }}"
                              enctype="multipart/form-data">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('store.members.store') }}">
                                    @endif
                                    {{ csrf_field() }}

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">姓名</label>
                                        <input type="text" class="form-control" name="name"
                                               value="{{ old('name', $member->name) }}" placeholder="请输入姓名">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">电话</label>
                                        <input type="text" class="form-control" name="phone"
                                               value="{{ old('phone', $member->phone) }}" placeholder="请输入电话">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">身份证号</label>
                                        <input type="text" class="form-control" name="idnumber"
                                               value="{{ old('idnumber', $member->idnumber) }}" placeholder="请输入身份证号">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">地址</label>
                                        <input type="text" class="form-control" name="address"
                                               value="{{ old('idnumber', $member->address) }}" placeholder="请输入居住地址">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">销售</label>
                                        <select class="form-control" name="employee_id" required>
                                            <option value="0">请选择</option>
                                            @foreach ($employees as $item)
                                                <option value="{{ $item['id'] }}" {{ $member->employee_id == $item['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary waves-effect waves-light m-r-10">提交
                                    </button>
                                </form>

                </div>
            </div>
        </div>
    </div>

@endsection

