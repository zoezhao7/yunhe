@extends('store.layouts.store')

@section('title', '客户管理')

@section('content')

<div class="row bg-title">
    <!-- .page title -->
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">客户列表</h4> </div>
    <!-- /.page title -->
    <!-- .breadcrumb -->
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <a href="{{ route('store.members.create') }}" class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">添加客户</a>

        <ol class="breadcrumb">
            <li><a href="{{ route('store.welcome') }}">首页</a></li>
            <li class="active">客户列表</li>
        </ol>
    </div>
    <!-- /.breadcrumb -->
</div>

@include('store.common._message')

<div class="row">
    <div class="white-box">
        <div class="table-responsive">
            <table class="table member-overview" id="myTable">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>销售</th>
                    <th>姓名</th>
                    <th>手机号</th>
                    <th>车辆数</th>
                    <th>账户积分</th>
                    <th>添加时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($members as $key => $member)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $member->employee->name }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->cars_count }}</td>
                    <td>{{ $member->coin_count }}</td>
                    <td>{{ $member->created_at }}</td>
                    <td>
                        <a href="{{ route('store.members.coins.create', $member->id)  }}" class="text-inverse p-r-10" data-toggle="tooltip" title="积分操作"><i class="ti-server"></i></a>
                        <a href="{{ route('store.members.edit', $member->id)  }}" class="text-inverse p-r-10" data-toggle="tooltip" title="编辑"><i class="ti-marker-alt"></i></a>
                        <form onsubmit="return confirm('确认删除吗？');" id="delete_form" method="post" action="{{ route('store.members.destroy', $member->id) }}" style="display: inline">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <a href="javascript:void(0);" onclick="document.getElementById('delete_form').submit();" class="text-inverse" title="删除" data-toggle="tooltip"><i class="ti-trash"></i></a>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

            <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                {!! $members->appends(Request::except('page'))->render() !!}
            </div>

        </div>
    </div>
</div>

@endsection