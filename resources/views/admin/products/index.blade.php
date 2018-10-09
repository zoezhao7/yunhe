@extends('admin.layouts.admin')

@section('title', '产品管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">产品列表</h4> </div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <a href="{{ route('admin.products.create') }}" class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">添加产品</a>

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li class="active">产品列表</li>
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
                        <input type="text" class="form-control" id="" name="spec_idnumber"
                               value="{{ $request->spec_idnumber }}" placeholder="产品型号ID">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="product_name"
                               value="{{ $request->product_name }}" placeholder="产品名称">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="category_id">
                            <option value="">产品系列</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @if($request->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
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
                        <th>图片</th>
                        <th>系列</th>
                        <th>名称</th>
                        <th width="25%">型号尺寸</th>
                        <th width="30%">简介</th>
                        <th>上架时间</th>
                        <th>销量</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($products as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td> @if ($product->image) <img src="{{ $product->image }}" alt="iMac" width="50"> @endif </td>
                        <td> <span class="label label-success font-weight-100">{{ $product->category->name }}</span> </td>
                        <td><a href="{{ route('admin.products.specs', $product->id) }}">{{ $product->name }}</a></td>
                        <td style="line-height:28px;">
                            @foreach ($product->specs as $key=>$spec)
                                <a href="{{ route('admin.specs.show', $spec->id) }}">
                                    <span class="label label-info">{{ $spec->size }}</span>
                                </a>
                            @endforeach
                        </td>
                        <td>{{ $product->intro }}</td>
                        <td>{{ $product->created_at->format('m/d H:i') }}</td>
                        <td>{{ $product->sales }}</td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id)  }}" class="text-inverse p-r-10" data-toggle="tooltip" title="编辑"><i class="ti-marker-alt"></i></a>
                            <form onsubmit="return confirm('确认删除吗？');" id="delete_form" method="post" action="{{ route('admin.products.destroy', $product->id) }}" style="display: inline">
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
                    {!! $products->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection