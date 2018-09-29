@extends('member.layouts.member')

@section('title', '我的斯享币')

@section('content')
    <div class="score_content">
        <div class="banner_box">
            <img class="coin_bg" src="/member/images/coin_bg.jpg" alt="">
            <div class="infomation">
                <h2>当前斯享币<img src="/member/images/ic_ques.png" alt=""></h2>
                <h1>{{ $member->coin_count }}</h1>
                <p><a href="javascript:;">去提升<img src="/member/images/arrow3.png" alt=""></a>提升币值享受更多权益</p>
            </div>
            <div class="power_box">
                <div class="power">
                    <div class="title flex_align">
                        <div class="name flex_1">会员权益</div>
                        <div class="ic_car"><img src="/member/images/ic_car.png" alt=""></div>
                        <div class="ic_cake"><img src="/member/images/ic_cake.png" alt=""></div>
                        <div class="arrow"><img src="/member/images/arrow_push.png" alt=""></div>
                    </div>
                    <ul class="list_ul hide">
                        <li><img src="/member/images/ic_car.png" alt="">跑车俱乐部嘉年华资格</li>
                        <li><img src="/member/images/ic_cake.png" alt="">高端会员聚会活动</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="detail_box">
            <div class="title bor_b">斯享币收支明细</div>
            <ul>
                @foreach($coins as $coin)
                    <li class="flex_align bor_b">
                        <div class="left flex_1">
                            <div class="type">{{ $coin->typeMsg[$coin->type]['name'] }}</div>
                            <div class="time">{{ $coin->created_at }}</div>
                        </div>
                        <div class="right">
                            <span class="on">
                                @if($coin->number>=0) + @endif
                                {{ $coin->number }}
                            </span>
                        </div>
                    </li>
                @endforeach

            </ul>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            $('.power .title').click(function () {
                $('.power .list_ul').slideToggle(200);
            });
        })
    </script>
@endsection