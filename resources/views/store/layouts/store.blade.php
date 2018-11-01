<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') - 云和</title>
    <link href="/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="/admin/css/animate.css" rel="stylesheet">
    <link href="/admin/css/style.css" rel="stylesheet">
    <link href="/admin/css/colors/blue-dark.css" id="theme" rel="stylesheet">

    @yield('style')

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="fix-sidebar">

<!-- Preloader -->
<!--
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>
-->

<div id="wrapper">

    @include('store.common._top')

    @include('store.common._leftmenu')

    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('content', 'this is a new page')
        </div>
    </div>

</div>

<script src="/admin/plugins/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/admin/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/admin/plugins/bower_components/blockUI/jquery.blockUI.js"></script>
<script src="/admin/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="/admin/js/jquery.slimscroll.js"></script>
<script src="/admin/js/custom.js"></script>

@yield('script')

<script>
    $("form").submit(function (e) {
        if ($(this).attr('onsubmit') !== undefined) {
            return true;
        }

        var inputs = $(this).serialize();
        if (inputs.indexOf('_method=DELETE') != -1) {
            if (!confirm("确定要删除吗？")) {
                return false;
            }
        }

        $.blockUI({
            message: '<h4><img src="/admin/plugins/images/busy.gif" /> 提交中...</h4>',
            css: {border: '1px solid #fff'}
        });

        return true;
    });

    $(document).ajaxStart(function () {
        $.blockUI({
            message: '<h4><img src="/admin/plugins/images/busy.gif" /> 提交中...</h4>',
            css: {border: '1px solid #fff'}
        });
    }).ajaxStop(function () {
        $.unblockUI();
    });
</script>

</body>
</html>