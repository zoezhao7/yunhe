@extends('admin.layouts.admin')

<?php $page_name = $carDemo->id ? '编辑演示车辆' : '添加演示车辆'; ?>

@section('title', $page_name)

@section('style')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        .carimg_box {
            position: relative
        }

        .carimg_box .imgbox {
            display: inline-block;
            position: relative;
            overflow: hidden
        }

        .carimg_box .carimg {
            width: 1100px
        }

        .wheel_block {
            position: absolute;
            width: 113px;
            height: 113px;
            box-sizing: border-box;
            background-color: rgba(255, 255, 255, .5);
            left: 0;
            top: 0;
            cursor: pointer;
            border-radius: 50%
        }
    </style>
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
                <li><a href="{{ route('admin.car_demos.index') }}">演示车辆列表</a></li>
                <li class="active">{{ $page_name }}</li>
            </ol>
        </div>
        <!-- /.breadcrumb -->
    </div>

    @include('admin.common._message')
    @include('admin.common._error')

    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <div class="col-sm-12 col-xs-12">
                        @if($carDemo->id)
                            <form method="post" action="{{ route('admin.car_demos.update', $carDemo->id) }}">
                                {{ method_field('PUT') }}
                                @else
                                    <form method="post" action="{{ route('admin.car_demos.store') }}">
                                        @endif
                                        <form method="post" action="{{ route('admin.car_demos.store') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="image"
                                                   value="{{ old('image', $carDemo->image) }}">
                                            <input type="hidden" name="more[front][top]"
                                                   value="{{ old('more[front][top]', $more['front']['top']) }}">
                                            <input type="hidden" name="more[front][left]"
                                                   value="{{ old('more[front][left]', $more['front']['left']) }}">
                                            <input type="hidden" name="more[rear][top]"
                                                   value="{{ old('more[rear][top]', $more['rear']['top']) }}">
                                            <input type="hidden" name="more[rear][left]"
                                                   value="{{ old('more[rear][left]', $more['rear']['left']) }}">

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-sm-6 ol-md-6 col-xs-12">

                                                        <div class="form-group">
                                                            <label for="">车辆名称</label>
                                                            <input type="text" class="form-control" name="name"
                                                                   value="{{ old('name', $carDemo->name) }}"
                                                                   placeholder="请输入车辆名称"
                                                                   required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">上传图片（图片大小：1100*500；后轮毂宽：113）</label>
                                                            <input type="file" id="carpic" onchange="uploadFile()"/>
                                                        </div>

                                                        @if($carDemo->id)
                                                            <div class="carimg_box m-t-20">
                                                                <div class="imgbox">
                                                                    <img class="carimg" src="{{ $carDemo->image }}"
                                                                         alt="">
                                                                    <div class="wheel_block block_01"></div>
                                                                    <div class="wheel_block block_02"></div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="carimg_box m-t-20">
                                                                <div class="imgbox">
                                                                    <img class="carimg" src="/admin/images/car_demo.png"
                                                                         alt="">
                                                                    <div class="wheel_block block_01"></div>
                                                                    <div class="wheel_block block_02"></div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info waves-effect waves-light m-r-10">
                                                提交
                                            </button>
                                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function check_form() {

            $.blockUI({
                message: '<h4><img src="/admin/plugins/images/busy.gif" /> 提交中...</h4>',
                css: {border: '1px solid #fff'}
            });

            $('input[name="more[front][top]"]').val($('.block_01').attr('top'));
            $('input[name="more[front][left]"]').val($('.block_01').attr('left'));
            $('input[name="more[rear][top]"]').val($('.block_02').attr('top'));
            $('input[name="more[rear][left]"]').val($('.block_02').attr('left'));
            return true;
        }

        var drag = function (obj, fn) {
            obj = $(obj);
            obj.bind('mousedown', start);
            var left = obj.offset().left,
                top = obj.offset().top;

            function start(event) {
                if (event.button == 0) {
                    gapX = event.clientX - obj.offset().left;
                    gapY = event.clientY - obj.offset().top;
                    $(document).bind('mousemove', move);
                    $(document).bind('mouseup', stop);
                }
                return false;
            }

            function move(event) {
                obj.css({
                    'left': (event.clientX - gapX - left) + 'px',
                    'top': (event.clientY - gapY - top) + 'px'
                });
                fn(event.clientX - gapX - left, event.clientY - gapY - top);
                return false;
            }

            function stop() {
                $(document).unbind('mousemove', move);
                $(document).unbind('mouseup', stop);
            }
        }

        // 文件上传
        function uploadFile() {
            var myform = new FormData();
            myform.append('file', $('#carpic')[0].files[0]);
            myform.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: "{{ route('admin.car_demos.upload') }}",
                type: "POST",
                data: myform,
                encType: "multipart/form-data",
                contentType: false,
                processData: false,
                success: function (data) {
                    $(".carimg").attr('src', data.image);
                    $('input[name="image"]').val(data.image);
                }
            });
        }

        /*轮毂位置信息*/
        drag('.block_01', function (left, top) {
            left = (left / ($('.carimg_box .imgbox').width()) * 100).toFixed(2) + '%';
            top = (top / ($('.carimg_box .imgbox').height()) * 100).toFixed(2) + '%';

            $('input[name="more[front][top]"]').val(top);
            $('input[name="more[front][left]"]').val(left);

        });

        drag('.block_02', function (left, top) {
            left = (left / ($('.carimg_box .imgbox').width()) * 100).toFixed(2) + '%';
            top = (top / ($('.carimg_box .imgbox').height()) * 100).toFixed(2) + '%';

            $('input[name="more[rear][top]"]').val(top);
            $('input[name="more[rear][left]"]').val(left);
        });

        @if($carDemo->id)
        $('.block_01').css({
            'top':{{ $morePx['front']['top'] }},
            'left':{{ $morePx['front']['left'] }}
        });
        $('.block_02').css({
            'top':{{ $morePx['rear']['top'] }},
            'left':{{ $morePx['rear']['left'] }}
        });
        @endif


    </script>
@endsection
