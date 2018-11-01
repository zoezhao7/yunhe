@extends('store.layouts.store')

@section('title', '产品管理')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">产品列表</h4></div>
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

            <div class="panel-body" style="padding-top:0;padding-left:0;">
                <form>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <input type="text" class="form-control" id="" name="spec_idnumber"
                               value="{{ $request->spec_idnumber }}" placeholder="CID">
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <select class="form-control" name="category_id">
                            <option value="">产品系列</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if($request->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-lg-2 col-md-3 col-sm-4 col-xs-10">
                        <button class="btn btn-block btn-info" style="max-width: 100px;">查询</button>
                    </div>
                </form>
            </div>

            <div class="table-responsive">
                <table class="table spec-overview color-table info-table" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>CID</th>
                        <th>系列</th>
                        <th>尺寸</th>
                        <th width="45%">参数</th>
                        <th>上架日期</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach ($specs as $key => $spec)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td><a href="{{ route('store.specs.show2', $spec->id) }}">{{ $spec->idnumber }}</a></td>
                            <td><span class="label label-success font-weight-100">{{ $spec->product->category->name }}</span>
                            <td>{{ $spec->size }}</td>
                            <td style="line-height: 28px;">@foreach($spec->content as $key=>$content)
                            <span class="label label-info">{{ $key }}：{{ $content }}</span>@endforeach</td>
                            <td>@if($spec->created_at) {{ $spec->created_at->format('Y-m-d') }} @endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="dataTables_paginate paging_simple_numbers" id="example23_paginate">
                    {!! $specs->appends(Request::except('page'))->render() !!}
                </div>

            </div>
        </div>
    </div>

@endsection