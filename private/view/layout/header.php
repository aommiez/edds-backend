<!DOCTYPE html>
<html class="sidebar sidebar-discover">
<head>
    <title>ED/DS Backend</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <!--
	**********************************************************
	In development, use the LESS files and the less.js compiler
	instead of the minified CSS loaded by default.
	**********************************************************
	-->
    <!--[if lt IE 9]><link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/assets/components/library/bootstrap/css/bootstrap.min.css");?>" /><![endif]-->
    <link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute("/public/assets/css/admin/module.admin.stylesheet-complete.sidebar_type.collapse.min.css");?>"/>
    <link rel="stylesheet" href="<?php echo \Main\Helper\URL::absolute();?>/public/assets/css/admin/module.admin.stylesheet-complete.sidebar_type.collapse.min.css"
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo \Main\Helper\URL::absolute("/public/assets/components/library/jquery/jquery.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/assets/components/library/jquery/jquery-migrate.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/assets/components/library/modernizr/modernizr.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/assets/components/plugins/less-js/less.min.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/assets/components/modules/admin/charts/flot/assets/lib/excanvas.js?v=v1.0.3-rc2");?>"></script>
    <script src="<?php echo \Main\Helper\URL::absolute("/public/assets/components/plugins/browser/ie/ie.prototype.polyfill.js?v=v1.0.3-rc2&sv=v0.0.1.1");?>"></script>
    <script>
        if ( /*@cc_on!@*/ false && document.documentMode === 10)
        {
            document.documentElement.className += ' ie ie10';
        }
    </script>
</head>
<body>
<!-- Main Container Fluid -->
<div class="container-fluid menu-hidden">
    <!-- Sidebar Menu -->
    <div id="menu" class="hidden-print hidden-xs ">
        <div id="sidebar-collapse-wrapper">
            <ul class="list-unstyled">
                <li><a class="glyphicons picture" href="<?php echo \Main\Helper\URL::absolute();?>/media"><i></i><span>Media</span></a></li>
                <li><a class="icon-bulleted-list" href="<?php echo \Main\Helper\URL::absolute();?>/playlist"><i></i><span>Playlist</span></a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute();?>/news" class="glyphicons edit"><i></i><span>News</span></a></li>
<!--                <li><a href="--><?php //echo \Main\Helper\URL::absolute();?><!--/event" class="glyphicons brightness_reduce"><i></i><span>Event</span></a></li>-->
                <li><a href="<?php echo \Main\Helper\URL::absolute();?>/device" class="icon-tablet"><i></i><span>Device</span></a></li>
                <li><a href="<?php echo \Main\Helper\URL::absolute();?>/layout" class="glyphicons magic"><i></i><span>Layout</span></a></li>

                <li><a href="#" class="glyphicons imac"><i></i><span>Resolution</span></a></li>
                <li><a href="#" class="glyphicons display"><i></i><span>Display</span></a></li>
                <li><a href="#" class="glyphicons show_big_thumbnails"><i></i><span>Display Group</span></a></li>
                <li><a href="#" class="glyphicons download"><i></i><span>Marker</span></a></li>
                <li><a href="#" class="glyphicons justify"><i></i><span>Floor</span></a></li>
                <li><a href="#" class="glyphicons table"><i></i><span>Category</span></a></li>
                <li><a href="#" class="glyphicons adjust_alt"><i></i><span>Setting</span></a></li>
            </ul>
        </div>
    </div>
    <!-- // Sidebar Menu END -->
    <!-- Content -->
    <div id="content">
        <nav class="navbar hidden-print main " role="navigation">
            <div class="navbar-header pull-left">
                <div class="user-action user-action-btn-navbar pull-left border-right">
                    <button class="btn btn-sm btn-navbar btn-inverse btn-stroke"><i class="fa fa-bars fa-2x"></i>
                    </button>
                </div>
            </div>
            <ul class="main pull-right ">

                <li class="dropdown username">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo \Main\Helper\URL::absolute("/public/assets/images/people/35/2.jpg");?>" class="img-circle"
                             width="30" />Administrator
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="my_account.html?lang=en" class="glyphicons user"><i></i> Account</a>
                        </li>
                        <li><a href="messages.html?lang=en" class="glyphicons envelope"><i></i>Messages</a>
                        </li>
                        <li><a href="index.html?lang=en" class="glyphicons settings"><i></i>Settings</a>
                        </li>
                        <li><a href="login.html?lang=en" class="glyphicons lock no-ajaxify"><i></i>Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="dropdown">
                        <a data-toggle="dropdown" style="font-weight:bolder" href="" >ED/DS Backend Manage</a>
                    </li>
                </ul>
            </div>
        </nav>