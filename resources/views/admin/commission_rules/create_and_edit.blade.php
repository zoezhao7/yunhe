@extends('admin.layouts.admin')

<?php $page_name = '佣金规则'; ?>

@section('title', $page_name)

@section('style')
    <link rel="stylesheet" href="/admin/simditor/css/simditor.css"/>
@endsection

@section('content')

    <div class="row bg-title">
        <!-- .page title -->
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">{{ $page_name }}</h4></div>
        <!-- /.page title -->
        <!-- .breadcrumb -->
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.welcome') }}">首页</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._error')

    @include('admin.common._message')

    <div class="col-md-6">
        <div class="white-box">
            <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <form method="POST" action="{{ route('admin.commission_rules.update') }}"
                          enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}


                        <h3>销售提成：</h3>
                        <hr>
                        @if($commissionRule->id)
                            @foreach($commissionRule->sale_rate as $saleRate)
                                <div class="form-group">
                                    <div class="row params_box">
                                        <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;">
                                            销量：
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" value="{{ $saleRate['min'] }}"
                                                       name="mins[]" class="form-control"
                                                       required>
                                                <span class="input-group-addon">
                                    <span class="input-group-text">个</span>
                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;"> -
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" value="{{ $saleRate['max'] }}"
                                                       name="maxs[]" class="form-control"
                                                       required>
                                                <span class="input-group-addon">
                                    <span class="input-group-text">个</span>
                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;">
                                            提成：
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="input-group">
                                                <input type="text" value="{{ $saleRate['rate'] * 100 }}"
                                                       name="rates[]" class="form-control"
                                                       required>
                                                <span class="input-group-addon">
                                    <span class="input-group-text">%</span>
                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            @for($i=0;$i<3;$i++)
                            <div class="form-group">
                                <div class="row params_box">
                                    <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;">销量：
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" value="" name="mins[]" class="form-control"
                                                   required>
                                            <span class="input-group-addon">
                                    <span class="input-group-text">个</span>
                                </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;"> -
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" value="" name="maxs[]" class="form-control"
                                                   required>
                                            <span class="input-group-addon">
                                    <span class="input-group-text">个</span>
                                </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-1" style="line-height: 32px;text-align: center;padding:0;">提成：
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="input-group">
                                            <input type="text" value="" name="rates[]" class="form-control"
                                                   required>
                                            <span class="input-group-addon">
                                    <span class="input-group-text">%</span>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        @endif

                        <h3 style="margin-top: 20px;">一级销售提成：</h3>
                        <hr>
                        <div class="form-group">
                            <div class="input-group bootstrap-touchspin ">
                                <input type="text"
                                       value="@if($commissionRule->id){{ $commissionRule->subordinate_rate * 100 }}@endif"
                                       name="subordinate_rate" class="form-control" required>
                                <span class="input-group-addon">
                                    <span class="input-group-text">%</span>
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">提交</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection
