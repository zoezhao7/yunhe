@extends('admin.layouts.admin')

@section('title', '轮毂演示')

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">轮毂演示</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <a href="{{ route('admin.car_demos.create') }}"
               class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">添加演示车辆</a>

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li class="active">轮毂演示</li>
            </ol>
        </div>
    </div>

    @include('admin.common._message')

    <div class="row">
        <div class="white-box">
            <div class="table-responsive">
                <table class="table product-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>车辆名称</th>
                        <th>图片</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($carDemos as $key => $carDemo)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $carDemo->name }}</td>
                            <td><a href="{{ $carDemo->image }}" target="_blank">查看图片</a></td>
                            <td>{{ $carDemo->created_at->format('m-d H:i') }}</td>
                            <td>
                                <a class="btn btn-outline btn-info"
                                   href="{{ route('admin.car_demos.edit', $carDemo->id) }}">编辑</a>
                                <form method="post" action="{{ route('admin.car_demos.destroy', $carDemo->id) }}"
                                      style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-outline btn-danger">删除</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $carDemos->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection