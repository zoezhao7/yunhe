@extends('admin.layouts.admin')

@section('title', '门店管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">门店列表</h4> </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <a href="{{ route('admin.stores.create') }}" class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">添加门店</a>

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li class="active">门店列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._message')

    <div class="row">
        <div class="white-box">
            <div class="table-responsive">
                <table class="table store-overview" id="myTable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>名称</th>
                        <th>电话</th>
                        <th>地址</th>
                        <th>员工数</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($stores as $key => $store)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->phone }}</td>
                            <td>{{ $store->address }}</td>
                            <td>{{ $store->employee_count }}</td>
                            <td>
                                @if ($store->is_open===1)
                                    <span class="label label-success font-weight-100">营业</span>
                                @else
                                    <span class="label label-danger font-weight-100">不营业</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.stores.edit', $store->id) }}" class="btn btn-xs btn-outline btn-info">编辑</a>
                                <form onsubmit="return confirm('确定要删除吗！');" id="delete_form_{{ $store->id }}" method="post" action="{{ route('admin.stores.destroy', $store->id) }}" style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-xs btn-outline btn-danger">删除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $stores->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection