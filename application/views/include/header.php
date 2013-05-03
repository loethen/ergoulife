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
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/todc-bootstrap.css'); ?>">

        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap-responsive.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('css/main.css'); ?>">
        <!--[if lte IE 8]>
        <style>
        .row-fluid [class*="span"] { min-height: 20px; }
        </style>
        <![endif]-->
        <script src="<?php echo base_url('js/vendor/modernizr-2.6.2-respond-1.1.0.min.js'); ?>"></script>
        <script>
        var site_url = "<?=site_url()?>", 
            base_url="<?=base_url() ;?>";
            window.UEDITOR_HOME_URL = "<?=base_url('ueditor') ;?>"+'/'
        </script> 
        
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">你正在使用一个 <strong>过时</strong> 的浏览器. 请 <a href="http://browsehappy.com/">点击这里</a>更新浏览器 或者 <a href="http://www.google.com/chromeframe/?redirect=true">点击这里</a> 试试google chrome</p>
        <![endif]-->

        <!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->
    <div id="toptip" class="fix tip">
        <div class="tip-inner">
            <i class="icon-flag icon-white"></i>
            <span>正在加载...</span>
            <em id="tipclose">x</em>
        </div>
    </div>
    <div id="wrap">
        <div class="navbar navbar-googlenav">
              <div class="navbar-inner">
                <div class="container">
                  <a class="pull-left logo" href="<?=site_url() ?>"></a>
                  <ul class="nav">
                    <li class="<?=$this->uri->segment(1)=='allbrand'?'active':''?>"><a href="<?=site_url('allbrand') ?>">所有品牌</a></li>
                    <li class="<?=$this->uri->segment(1)=='meowtown'?'active':''?>"><a href="<?=site_url('meowtown') ?>">精选</a></li>
                    <li class="<?=$this->uri->segment(1)=='meowtown'?'active':''?>"><a href="<?=site_url('meowtown') ?>">发现</a></li>
                    <li class="<?=$this->uri->segment(1)=='create'?'active':''?>"><a href="<?=site_url('create') ?>">添加</a></li>
                  </ul>
                  <ul class="nav pull-right">
                    <?php if($this->session->userdata('log_in')): ?>
                    <li>
                        <a href="<?=site_url('brand/mybrands') ?>">
                            <div class="favorite"></div>我关注的品牌
                        </a>
                    </li>
                    <li class="divider-vertical"></li>
                    <li class='dropdown'>
                        <a class='dropdown-toggle' href='#' data-toggle='dropdown' data-target='#'>
                            <?= $this->session->userdata('username')?>
                            <span class="caret"></span>
                        </a>
                        <ul class='dropdown-menu'>
                        <?php if($this->session->userdata('admin')==true): ?>
                            <li><a href="<?=site_url('admin'); ?>">管理员</a></li>
                        <?php endif; ?>
                            <li><a href="<?=site_url('setting'); ?>">设置</a></li>
                            <li class="divider"></li>
                            <li><a href="<?=site_url('sign/logout'); ?>">登出</a></li>
                        </ul>
                    </li>
                    <?php else: ?>
                    <li><a href="<?=site_url('sign/signin_form') ?>">登录</a></li>
                    <li class="divider-vertical"></li>
                    <li><a href="<?=site_url('sign/signup_form') ?>">注册</a></li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
        </div>
        <div class="container-narrow">
            
            <div class="container-narrow container-margin">