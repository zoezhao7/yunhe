@extends('admin.layouts.admin')

@section('title', '产品型号列表')

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">产品型号列表</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            <a href="{{ route('admin.products.specs.create', $product->id) }}"
               class="btn btn-info pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">添加产品型号</a>

            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li><a href="{{ route('admin.products.index') }}">产品列表</a></li>
                <li class="active">产品型号列表</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._message')

    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-7">
            <div class="panel panel-info">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="pan

                    el-body">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                <tr>
                                    <th style="text-align:center" width="10%">编号</th>
                                    <th style="text-align:center" width="10%">尺寸</th>
                                    <th style="text-align:center" width="10%">价格</th>
                                    <th style="text-align:center" width="60%">参数</th>
                                    <th style="text-align:center" width="10%">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($specs as $key=>$spec)
                                    <tr>
                                        <td align="center">
                                            <a href="{{ route('admin.specs.show', $spec->id) }}">
                                                {{ $spec->idnumber }}
                                            </a>
                                        </td>
                                        <td align="center">{{ $spec->size }}</td>
                                        <td align="center" class="font-500">￥{{ $spec->price }}</td>
                                        <td style="line-height: 30px;">
                                            <p>
                                                @if($spec->content)
                                                    @foreach ($spec->content as $key=>$value)
                                                        <span class="label label-info">{{ $key }}:{{ $value }}</span>
                                                    @endforeach
                                                @endif
                                            </p>
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('admin.specs.edit', $spec->id) }}" class="btn btn-xs btn-outline btn-info">编辑</a>
                                            <form onsubmit="return confirm('确定要删除吗！');" id="delete_form_{{ $spec->id }}"
                                                  method="post" action="{{ route('admin.specs.destroy', $spec->id) }}"
                                                  style="display: inline">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-xs btn-outline btn-danger">删除</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-lg-3 col-sm-5">
            <div class="white-box">
                <h3 class="box-title">{{ $product->name }}</h3>
                <hr>
                <small>分类</small>
                <h2> {{ $product->category->name }} </h2>
                <small>折扣</small>
                <h2> {{ $product->discount }}% </h2>
                <small>简介</small>
                <h2> {{ $product->intro }} </h2>
                <hr>
                <img src="{{ $product->image }}" width="200"
                     class="thumbnail img-responsive">
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function sure(){
            if(confirm("您即将执行form表单，确定吗？")){
                alert("即将执行form表单中request.asp的内容");
            }
            else{
                return false;
            }
        }
    </script>
@endsection