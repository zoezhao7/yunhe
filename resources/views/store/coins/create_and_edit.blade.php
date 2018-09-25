@extends('store.layouts.store')

{{ $page_name = '积分操作'  }}

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li><a href="{{ route('store.members.index') }}">客户列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('store.common._message')
    @include('store.common._error')

    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="POST" action="{{ route('store.members.coins.store', $member->id) }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="">姓名</label>
                            <input type="text" class="form-control" value="{{ $member->name }}" disabled="true">
                        </div>

                        <div class="form-group">
                            <label for="">账户积分</label>
                            <input type="text" class="form-control" value="{{ $member->coin_count }}" disabled="true">
                        </div>

                        <div class="form-group">
                            <label for="number">积分变动</label>
                            <input type="text" class="form-control" name="number" value="" placeholder="100 或者 -100">
                        </div>

                        <div class="form-group">
                            <label for="remark">原因</label>
                            <input type="text" class="form-control" name="remark"
                                   value="{{ old('remark', $coin->remark) }}" placeholder="请输入操作说明">
                        </div>


                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

