@extends('store.layouts.store')

@section('title', '账务管理')

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">账务列表</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <a href="{{ route('store.accounts.create') }}"
               class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">添加账务</a>
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">账务列表</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">

            <div class="table-responsive">
                <table class="table member-overview" id="myTable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>收支</th>
                        <th>类型</th>
                        <th>金额</th>
                        <th>时间</th>
                        <th>操作员</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($accounts as $key => $account)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $account->typeMsg[$account->type]['name'] }}</td>
                            <td>{{ $account->channel }}</td>
                            <td>{{ $account->money }}</td>
                            <td>{{ $account->operated_at }}</td>
                            <td>{{ $account->employee->name }}</td>
                            <td>
                                <form onsubmit="return confirm('确认删除吗？');" id="delete_form" method="post"
                                      action="{{ route('store.accounts.destroy', $account->id) }}"
                                      style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <a href="javascript:void(0);"
                                       onclick="document.getElementById('delete_form').submit();" class="text-inverse"
                                       title="删除" data-toggle="tooltip"><i class="ti-trash"></i></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $accounts->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection