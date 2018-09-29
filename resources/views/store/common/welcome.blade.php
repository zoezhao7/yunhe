@extends('store.layouts.store')

@section('title', '欢迎页')

@section('content')
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">欢迎你，{{ $manager->name }}</h4>
                </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
                    <ol class="breadcrumb">
                        <li class="active">{{ now()->format('Y-m-d') }}</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <div class="row row-in">

                            <div class="col-lg-3 col-sm-6 row-in-br">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-danger"><i class="ti-clipboard"></i></span>
                                    </li>
                                    <li class="col-last">
                                        <h3 class="counter text-right m-t-15">{{ $productCount }}</h3>
                                    </li>
                                    <li class="col-middle">
                                        <h4>产品数量</h4>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-sm-6 row-in-br  b-r-none">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-info"><i class="ti-wallet"></i></span>
                                    </li>
                                    <li class="col-last">
                                        <h3 class="counter text-right m-t-15">{{ $orderSum }}</h3>
                                    </li>
                                    <li class="col-middle">
                                        <h4>总销售额</h4>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-sm-6 row-in-br">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-success"><i class=" ti-shopping-cart"></i></span>
                                    </li>
                                    <li class="col-last">
                                        <h3 class="counter text-right m-t-15">{{ $orderMonthCount }}</h3>
                                    </li>
                                    <li class="col-middle">
                                        <h4>月订单数</h4>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-lg-3 col-sm-6  b-0">
                                <ul class="col-in">
                                    <li>
                                        <span class="circle circle-md bg-warning"><i class="fas fa-dollar-sign"></i></span>
                                    </li>
                                    <li class="col-last">
                                        <h3 class="counter text-right m-t-15">{{ $orderMonthSum }}</h3>
                                    </li>
                                    <li class="col-middle">
                                        <h4>月销售额</h4>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

@endsection