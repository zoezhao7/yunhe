@extends('member.layouts.member')

@section('title', '我的订单')

@section('content')

    @if($orders->isEmpty())
        <div class="blank_content">
            <img style="display: block;margin:0 auto;margin-top: 20%; width: 36%;" src="/member/images/blank.png"
                 alt="">
            <p style="margin-top: 20px;color: #999;font-size: 16px;text-align: center;">您还没有订单</p>
        </div>
    @else
        <div class="order_content">
            @foreach($orders as $order)
                <div class="section">

                    @foreach($order->orderProducts as $orderProduct)
                        <div class="order_info flex_align bor_b">
                            <div class="img"><img src="{{ $orderProduct->spec->product->image }}" alt=""  style="border:none;"></div>
                            <div class="title flex_1">
                                <h1>{{ $orderProduct->spec->product->category->name }} {{ $orderProduct->spec->product->name }}</h1>
                                <p>{{ $orderProduct->spec->size }} | {{ $orderProduct->color }}</p>
                            </div>
                            <div class="price">
                                <p>×{{ $orderProduct->number }}</p>
                            </div>
                        </div>
                    @endforeach

                    <div class="time">
                        <div style="float:left;">{{ date('Y-m-d', strtotime($order->dealt_at)) }}</div>
                        <h3 style="float:right;">￥{{ $order->money }}</h3>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection