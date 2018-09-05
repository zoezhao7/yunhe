@extends('admin.layouts.admin')

@section('title', '管理员管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">管理员列表</h4> </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li class="active">管理员列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._message')

    <!-- .row -->
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <div class="card-body">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('admin.admins.create') }}">创建管理员</a>
                    <div class="table-responsive">
                        <table id="demo-foo-addrow" class="table table-bordered m-t-10 table-hover contact-list" data-paging="true" data-paging-size="7">
                            <thead>
                            <tr>
                                <th width="5%">序号</th>
                                <th>用户名</th>
                                <th>姓名</th>
                                <th>手机</th>
                                <th>邮箱</th>
                                <th width="40%">角色清单</th>
                                <th width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($admins as $key => $admin)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $admin->user_name }}</td>
                                    <td>{{ $admin->real_name }}</td>
                                    <td>{{ $admin->mobile }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->role_names }}</td>
                                    <td>
                                        <a href="{{ route('admin.admins.edit', $admin->id) }}" class="btn btn-sm btn-outline btn-info m-r-10">编辑</a>

                                        <form onsubmit="return confirm('确认删除吗？')" method="post" action="{{ route('admin.admins.destroy', $admin->id) }}" style="display: inline">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit"  class="btn btn-sm btn-outline btn-danger">删除</button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                            {!! $admins->appends(Request::except('page'))->render() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

@endsection