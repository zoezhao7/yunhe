@extends('admin.layouts.admin')

{{ $page_name = $role->id ? '编辑角色' : '创建角色'  }}

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
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li><a href="{{ route('admin.roles.index') }}">角色列表</a></li>
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
                    @if ($role->id)
                        <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                            {{ method_field('PUT') }}
                            @else
                                <form method="POST" action="{{ route('admin.roles.store') }}">
                                    @endif
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">角色名称</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $role->name) }}" placeholder="请输入角色名称">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">权限节点</label>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>

                                                @foreach($nodes as $node)
                                                <tr>
                                                    <td>{{ $node['name'] }}</td>
                                                    <td>
                                                        @foreach ($node['actions'] as $key=>$action)
                                                        <div class="checkbox checkbox-primary ">

                                                            @if ($role->id)
                                                                <input id="checkbox{{ $node['name'] . $key }}" name="node_ids[]" value="{{ $action['id'] }}" type="checkbox" @if(in_array($action['id'], $role['node_ids'])) checked @endif>
                                                                @else
                                                                <input id="checkbox{{ $node['name'] . $key }}" name="node_ids[]" value="{{ $action['id'] }}" type="checkbox">
                                                                @endif

                                                            <label for="checkbox{{ $node['name'] . $key }}"> {{ $action['action_name'] }} </label>
                                                        </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交</button>
                                </form>
                </div>
            </div>
        </div>
    </div>

@endsection

