@extends('admin.layouts.admin')

@section('title', '轮毂仓库')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">轮毂仓库</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li class="active">轮毂仓库</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._message')

    <div class="row">
        <div class="white-box">

            <div class="panel-body" style="padding-top:0;padding-left:0;">
                <form>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="sn" value="{{ $request->sn }}" placeholder="sn...">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="store_id">
                            <option value="0">选择门店</option>
                            @foreach($stores as $store)
                                <option value="{{ $store->id }}" @if($request->store_id==$store->id) selected @endif>{{ $store->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="status">
                            <option value="0">轮毂状态</option>
                            <option value="1" @if($request->status == 1) selected @endif>备货中</option>
                            <option value="2" @if($request->status == 2) selected @endif>门店仓库</option>
                            <option value="3" @if($request->status == 3) selected @endif>已售出</option>
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table product-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>sn</th>
                        <th>CID</th>
                        <th>系列/产品名</th>
                        <th>颜色</th>
                        <th>门店</th>
                        <th>添加时间</th>
                        <th>状态</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($hubs as $key => $hub)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $hub->sn }}</td>
                            <td>{{ $hub->spec->idnumber }}</td>
                            <td>{{ $hub->spec->product->category->name }} - {{ $hub->spec->product->name }}</td>
                            <td>{{ $hub->color }}</td>
                            <td>@if($hub->store){{ $hub->store->name }}@endif</td>
                            <td>{{ $hub->created_at->format('Y-m-d') }}</td>
                            <td>@if($hub->order_product_id)<span class="label label-info">已售出</span>
                                @elseif($hub->store_id)<span class="label label-warning">门店仓库</span>
                                @else<span class="label label-info">物流中</span>
                                @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $hubs->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection