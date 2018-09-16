@extends('store.layouts.store')

@section('title', '欢迎页')

@section('content')

    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">欢迎页</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20">
                        <i class="ti-settings text-white"></i>
                    </button>
                    <a href="javascript: void(0);" target="_blank" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">
                        Buy Admin Now
                    </a>
                    <ol class="breadcrumb">
                        <li><a href="{{ route('store.welcome') }}">首页</a></li>
                        <li class="active">欢迎页</li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">欢迎页</h3> </div>
                </div>
            </div>

        </div>
    </div>

@endsection