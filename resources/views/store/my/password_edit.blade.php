@extends('store.layouts.store')

<?php $page_name = '修改密码'; ?>

@section('title', $page_name)

@section('content')

    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4></div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('store.welcome') }}">首页</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
    </div>

    @include('store.common._message')
    @include('store.common._error')

    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="POST" action="{{ route('store.my.passwordUpdate') }}"
                          enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="old_password">姓名</label>
                            <input type="text" class="form-control" name="" value="{{ $manager->name }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="old_password">电话</label>
                            <input type="text" class="form-control" name="" value="{{ $manager->phone }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="old_password">原密码</label>
                            <input type="password" class="form-control" name="old_password" value="">
                        </div>

                        <div class="form-group">
                            <label for="password">新密码</label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>

                        <div class="form-group">
                            <label for="">重复新密码</label>
                            <input type="password" class="form-control" name="password_confirmation" value="">
                        </div>


                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">提交
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

