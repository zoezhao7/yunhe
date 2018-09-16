@extends('store.layouts.store')

@section('title', '产品管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">产品列表</h4> </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">产品列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._message')

    <div class="row">
        <div class="white-box">
            <div class="table-responsive">
                <table class="table product-overview" id="myTable">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>图片</th>
                        <th>系列</th>
                        <th>名称</th>
                        <th>规格尺寸</th>
                        <th width="30%">简介</th>
                        <th>上架时间</th>
                        <th>销量</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td> @if ($product->image) <img src="{{ $product->image }}" alt="iMac" width="50"> @endif </td>
                        <td> <span class="label label-success font-weight-100">{{ $product->category->name }}</span> </td>
                        <td><a href="{{ route('store.products.specs', $product->id) }}">{{ $product->name }}</a></td>
                        <td>
                            @foreach ($product->specs as $key=>$spec)
                                @if ($key>0) <br> @endif
                                {{ $spec->size }}
                            @endforeach
                        </td>
                        <td>{{ $product->intro }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->sales }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $products->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection