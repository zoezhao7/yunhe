@extends('store.layouts.store')

@section('title', '员工管理')

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">员工列表</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="{{ route('store.employees.create') }}" class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">添加员工</a>
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">员工列表</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">

            <div class="panel-body" style="padding-top:0;padding-left:0;">
                <form>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="employee_name"
                               value="{{ $request->employee_name }}" placeholder="姓名">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="employee_phone"
                               value="{{ $request->employee_phone }}" placeholder="手机号码">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="employee_type">
                            <option value="">身份</option>
                            @foreach(\App\Models\Employee::$typeMsg as $type)
                                <option value="{{ $type['id'] }}" @if($request->employee_type == $type['id']) selected @endif>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="employee_status">
                            <option value="">状态</option>
                            @foreach(\App\Models\Employee::$statusMsg as $status)
                                <option value="{{ $status['id'] }}" @if($request->employee_type == $status['id']) selected @endif>{{ $status['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table member-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>姓名</th>
                        <th>身份</th>
                        <th>上级</th>
                        <th>电话</th>
                        <th>证件号码</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employees as $key => $employee)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>
                                <span class="label {{ \App\Models\Employee::$typeMsg[$employee->type]['label_class'] }}">{{ \App\Models\Employee::$typeMsg[$employee->type]['name'] }}</span>
                            </td>
                            <td>@if($employee->superior_id) {{ $employee->superior->name }} @else -- @endif</td>
                            <td>{{ yc_phone($employee->phone) }}</td>
                            <td>{{ $employee->idnumber }}</td>
                            <td>
                                <span class="label {{ \App\Models\Employee::$statusMsg[$employee->status]['label_class'] }}">
                                    {{ \App\Models\Employee::$statusMsg[$employee->status]['name'] }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('store.employees.edit', $employee->id)  }}" class="text-inverse p-r-10" data-toggle="tooltip" title="编辑"><i class="ti-marker-alt"></i></a>

                                <!--
                                <form onsubmit="return confirm('确认删除吗？');" id="delete_form" method="post" action="{{ route('store.employees.destroy', $employee->id) }}" style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="javascript:void(0);" onclick="document.getElementById('delete_form').submit();" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="ti-trash"></i></a>
                                </form>
                                -->

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $employees->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection