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
                <div class="content flex bor_b">
                    <div class="img">
                        <img src="{{ $order->product->image }}" alt="{{ $order->product->name }}">
                    </div>
                    <div class="name_box">
                        <div class="name">{{ $order->product->category->name }} {{ $order->product->name }}</div>
                        <p>{{ $order->parameters }}</p>
                    </div>
                    <div class="money">
                        <p>￥{{ $order->money }}</p>
                        <b>&nbsp;×4</b>
                    </div>
                </div>
                <div class="time">{{ date('Y-m-d', strtotime($order->dealt_at)) }}</div>
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