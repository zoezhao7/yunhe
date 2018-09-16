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
            <div>
                <form method="get" action="{{ url()->full() }}" >
                    {{ csrf_field() }}
                    <input type="text" name="search_key" value="{{ request()->input('search_key') }}" id="demo-input-search2" placeholder="输入姓名..." class="form-control">
                </form>
            </div>

            <div class="table-responsive">
                <table class="table member-overview" id="myTable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>姓名</th>
                        <th>身份</th>
                        <th>电话</th>
                        <th>证件号码</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($employees as $key => $employee)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $employee->name }}</td>
                            <td>
                                @if ($employee->type == 1)
                                    <span class="label label-danger">店长</span>
                                @endif
                                @if ($employee->type == 2)
                                    <span class="label label-info">销售</span>
                                @endif
                                @if ($employee->type == 3)
                                    <span class="label label-warning">渠道</span>
                                @endif
                            </td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->idnumber }}</td>
                            <td>
                                <a href="{{ route('store.employees.edit', $employee->id)  }}" class="text-inverse p-r-10" data-toggle="tooltip" title="Edit"><i class="ti-marker-alt"></i></a>

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