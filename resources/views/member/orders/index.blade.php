@extends('member.layouts.member')

@section('title', '我的订单')

@section('content')

    @if($orders->isEmpty())
        <div class="blank_content">
            <img style="display: block;margin:0 auto;margin-top: 20%; width: 36%;" src="/member/images/blank.png" alt="">
            <p style="margin-top: 20px;color: #999;font-size: 16px;text-align: center;">您还没有订单</p>
        </div>
    @else
        <div class="order_content">
            @foreach($orders as $order)
                <div class="section">
                    <div class="order_info flex_align bor_b">
                        <div class="img"><img src="{{ $order->product->image }}" alt=""></div>
                        <div class="title flex_1">
                            <h1>{{ $order->product->category->name }} {{ $order->product->name }}</h1>
                            <p>{{ $order->parameters }}</p>
                        </div>
                        <div class="price">
                            <h2>￥{{ $order->money }}</h2>
                            <p>×4</p>
                        </div>
                    </div>
                    <div class="time">{{ date('Y-m-d', strtotime($order->dealt_at)) }}</div>
                </div>
            @endforeach
        </div>
    @endif

@endsection