@extends('member.layouts.member')

@section('title', '我的消息')

@section('content')

    @if($notifications->isEmpty())
        <div class="blank_content">
            <img style="display: block;margin:0 auto;margin-top: 20%; width: 36%;" src="/member/images/blank.png"
                 alt="">
            <p style="margin-top: 20px;color: #999;font-size: 16px;text-align: center;">您还没有消息</p>
        </div>
    @else
        <div class="message_content">
            @foreach($notifications as $notification)
                <div class="section">
                    <div class="infomation flex_align bor_b">
                        <div class="img">
                            <div class="imgbox">
                                <img src="{{ $member->employee->avatar }}" alt="">
                                @if(is_null($notification->read_at))<i></i>@endif
                            </div>
                        </div>
                        <div class="con flex_1">
                            <div class="namebox flex_align">
                                <div class="name flex_1">{{ $notification->data['title'] }} </div>
                                <div class="time">{{ $notification->created_at->format('Y-m-d H:i') }}</div>
                            </div>
                            <p class="text_o">{{ $notification->data['content'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection