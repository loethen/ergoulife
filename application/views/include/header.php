<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap-responsive.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/main.css'); ?>">

        <script src="<?php echo base_url('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js'); ?>"></script>
        <script>var site_url = "<?=site_url()?>", base_url="<?=base_url() ;?>"</script> 
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
    <div class="container-narrow">
        <div class="navbar navbar-fixed-top">
            <div class="header-bg">
                <div class="header-wrap container-narrow">
                    <a class="logo pull-left" href="<?=site_url()?>">ergoulife</a>
                    <ul class="pull-right nav nav-pills">
                        <?php if($this->session->userdata('log_in')): ?>
                        <li class='dropdown'>
                            <a class='dropdown-toggle' role='button' href='#' data-toggle='dropdown' data-target='#'>
                                <?= $this->session->userdata('username')?>
                                <span class="caret"></span>
                            </a>
                            <ul class='dropdown-menu'>
                                <li><a href="<?=site_url('usercenter'); ?>">用户中心</a></li>
                                <li class="divider"></li>
                                <li><a href="<?=site_url('sign/logout'); ?>">登出</a></li>
                            </ul>
                        </li>
                        <?php else: ?>
                        <li><a role="button" href="<?=site_url('sign/signin_form') ?>">登录</a></li>
                        <li><a role="button" href="<?=site_url('sign/signup_form') ?>">注册</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-narrow container-margin">