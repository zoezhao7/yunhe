<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8'>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta name="format-detection" content="telphone=no" />
    <script src="/car_demos/js/flexible.js" type="text/javascript" charset="utf-8"></script>
    <title>斯柏森 - 高端轮毂演示</title>
    <link rel="stylesheet" type="text/css" href="/car_demos/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="/car_demos/css/swiper.min.css" />
    <link rel="stylesheet" type="text/css" href="/car_demos/css/style.css" />
    <script src="/car_demos/js/jquery2.1.4.min.js"></script>
    <script src="/car_demos/js/swiper.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="pageIndex">
    <div class="">
        <!-- <img src="images/car.png" alt=""> -->
        <!-- <img src="images/wheel_01.png" alt=""> -->
        <div class="car_swiper_container" style="padding-top:20px;">
            <div class="swiper-wrapper">

            </div>
        </div>
        <div class="wheel_swiper_container">
            <div class="swiper-wrapper">

            </div>
        </div>
    </div>
</div>
<script src="/car_demos/js/pub.js" type="text/javascript" charset="utf-8"></script>
<script>
    var cars = [1,2],
        hubs = [],
        carSwiper,
        wheelSwiper;

    $.get('{{ route('tools.car_demos.cars') }}',function(res){
        cars = res.data;
        $.each(cars,function(i,c){
            var html = '<div class="swiper-slide swiper_box">\
				                    <span>\
				                        <img class="bg_car" src="'+c.image+'" alt="">\
				                        <div class="wheel_box1"><img src="" alt=""></div>\
				                        <div class="wheel_box2"><img src="" alt=""></div>\
				                    </span>\
				                </div>';
            $('.car_swiper_container .swiper-wrapper').append(html);
        });
        setTimeout(() => {
            carSwiperInit();
        }, 1);

        // 获取轮毂
        $.get('{{ route('tools.car_demos.hubs') }}',function(res){
            hubs = res.data;
            $.each(hubs,function(i,c){
                var html = '<div class="swiper-slide swiper_box" onclick="selectWheel('+i+')">\
					                    <span><img src="'+c.image+'" alt=""></span>\
					                </div>';
                $('.wheel_swiper_container .swiper-wrapper').append(html);
            });

            //初始化
            setTimeout(() => {
                wheelSwiperInit();
                selectWheel(0);
            }, 1);
        });
    });

    function carSwiperInit(){
        carSwiper = new Swiper('.car_swiper_container', {
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            on: {
                init:function(){
                    $('.wheel_box1').css({
                        'top':cars[this.activeIndex].more.front.top,
                        'left':cars[this.activeIndex].more.front.left,
                    });
                    $('.wheel_box2').css({
                        'top':cars[this.activeIndex].more.rear.top,
                        'left':cars[this.activeIndex].more.rear.left,
                    });
                },
                slideChangeTransitionEnd: function(){
                    $('.wheel_box1').css({
                        'top':cars[this.activeIndex].more.front.top,
                        'left':cars[this.activeIndex].more.front.left,
                    });
                    $('.wheel_box2').css({
                        'top':cars[this.activeIndex].more.rear.top,
                        'left':cars[this.activeIndex].more.rear.left,
                    });
                },
            }
        });

    }

    function wheelSwiperInit(){
        wheelSwiper = new Swiper('.wheel_swiper_container', {
            slidesPerView: 'auto',
            spaceBetween: 20,
            centeredSlides: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }

    function selectWheel(i){
        $('.wheel_swiper_container .swiper_box').eq(i).addClass('on').siblings().removeClass('on');
        $('.wheel_box1 img').attr('src', hubs[i].image);
        $('.wheel_box2 img').attr('src', hubs[i].image);
    }
</script>
</body>
</html>