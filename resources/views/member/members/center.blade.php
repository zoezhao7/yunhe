@extends('member.layouts.member')

@section('title', '会员中心')

@section('content')

    <div class="index_content">
        <div class="member_box">
            <img class="banner" src="images/banner.jpg" alt="">
            <div class="infomation">
                <div class="notice">
                    <a href="{{ route('member.notifications') }}">
                        @if ($member->notification_count>0) <i></i> @endif
                        <img src="/member/images/notice.png" alt="新消息">
                    </a>
                </div>
                <div class="avatar_box">
                    <div class="head_pic"><img src="{{ $member->avatar }}" alt="{{ $member->name }}"></div>
                    <div class="name">{{ $member->name }}</div>
                    <div class="score">积分：{{ $member->coin_count }} <a href="{{ route('member.coins') }}">明细</a></div>
                </div>
            </div>
        </div>

        <div class="section order">
            <a href="{{ route('member.orders') }}" class="top_title bor_b flex_align">
                <div class="img"><img src="images/ic_money.png" alt=""></div>
                <div class="title flex_1">我的订单</div>
                <div class="arrow"><img src="images/ic_arrow.png" alt=""></div>
            </a>

            @if($order)
                @foreach($order->orderProducts as $orderProduct)
                    <div class="content flex bor_b">
                        <div class="img">
                            <img src="{{ $orderProduct->spec->product->image }}"
                                 alt="{{ $orderProduct->spec->product->name }}">
                        </div>
                        <div class="name_box">
                            <div class="name">{{ $orderProduct->spec->product->category->name }} {{ $orderProduct->spec->product->name }}</div>
                            <p>{{ $orderProduct->spec->size }} | {{ $orderProduct->color }}</p>
                        </div>
                        <div class="money">
                            <b>×{{ $orderProduct->number }}</b>
                        </div>
                    </div>
                @endforeach
                <div class="time">
                    <div style="float:left;">{{ date('Y-m-d', strtotime($order->dealt_at)) }}</div>
                    <h3 style="float:right;">￥{{ $order->money }}</h3>
                    <div style="clear: both;"></div>
                </div>
            @else
                <div class="content">
                    <p style="text-align:center;font-size: 14px;color: #aaa;">暂无订单</p>
                </div>
            @endif
        </div>

        <div class="ad_box"><img src="/member/images/pic2.jpg" alt=""></div>

        @if($member->employee)
            <div class="adviser_list">
                <div class="title">顾问推荐</div>
                <ul>
                    <li class="flex_align">
                        <div class="avatar">
                            <div class="imgbox"><img src="{{ $member->employee->avatar }}" alt=""></div>
                        </div>
                        <div class="con flex_1">
                            <div class="name">{{ $member->employee->name }}</div>
                            <p>服务客户: {{ $member->employee->membersCount() }}位</p>
                            <div class="star">
                                {!! $member->employee->starString !!}
                            </div>
                        </div>
                        <div class="contact">
                            <a href="tel:{{ $member->employee->phone }}">联系Ta<img src="images/arrow2.png" alt=""></a>
                        </div>
                    </li>
                </ul>
            </div>
        @endif

    </div>

@endsection