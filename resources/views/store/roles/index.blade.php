@extends('store.layouts.store')

@section('title', '角色管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">角色列表</h4> </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">角色列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._message')

    <!-- .row -->
    <!-- row -->
    <div class="row">
        <div class="col-12">
            <div class="white-box">
                <div class="card-body">
                    <a class="btn btn-info btn-sm float-right" href="{{ route('store.roles.create') }}">创建角色</a>
                    <div class="table-responsive">
                        <table id="demo-foo-addrow" class="table table-bordered m-t-10 table-hover contact-list" data-paging="true" data-paging-size="7">
                            <thead>
                            <tr>
                                <th width="5%">序号</th>
                                <th width="15%">角色名称</th>
                                <th>权限清单</th>
                                <th width="15%">操作</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($roles as $key => $role)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->node_names }}</td>
                                    <td>
                                        {{--@if(\Gate::forUser(\Auth::guard('store')->user())->allows('edit', $role))--}}
                                            <a href="{{ route('store.roles.edit', $role->id) }}" class="btn btn-sm btn-outline btn-info m-r-10">编辑</a>
                                            <form  method="post" action="{{ route('store.roles.destroy', $role->id) }}" style="display: inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit"  class="btn btn-sm btn-outline btn-danger">删除</button>
                                            </form>
                                        {{--@endif--}}
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                            {!! $roles->appends(Request::except('page'))->render() !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .row -->

@endsection