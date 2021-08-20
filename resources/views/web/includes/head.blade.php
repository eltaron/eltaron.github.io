<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="MasterCode">
    <meta name="keywords" content="MasterCode, houses ,rent houses,sale">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Master Code</title>
    @if(lang() == "en")
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    @endif
    <!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('web')}}/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('web')}}/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('web')}}/images/favicon-16x16.png">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('web/new')}}/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="{{asset('web/new')}}/css/style.css" type="text/css">
    <style>
        .toast {
            position: fixed;
            top: 0;
            z-index: 99999;
        }
    </style>
    @if(lang() == "ar")
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kufam:wght@500&display=swap" rel="stylesheet">
    <style>
        body{
            text-align: right !important;
            direction: rtl !important;
            font-family: Kufam !important;
        }
        h1, h2, h3, h4, h5, h6,p {font-family: Kufam !important;}
        .search-form-content .filter-form .nice-select span {float: right;}
        .search-form-content .filter-form .nice-select:after {
            left: 16px;
            right: auto;
        }
        .toast-header strong {
            margin-right: 0 !important;
            margin-left: auto !important;
        }
        .toast-header button.close {
            margin-left: 0 !important;
            margin-right: 7px;
            margin-top: 5px
        }
        .nice-select .option{text-align: right !important}
        .section-title h4:after, .section-title h5:after, .section-title h6:after {
            right: 0;
            left: auto;
        }
        .section-title h4, .section-title h5, .section-title h6 {
            padding-right: 20px;
            padding-left: 0
        }
        .property-item .pi-text .heart-icon {
            right: -68% !important;
            left: auto !important;
        }
        .blog-sidebar .feature-post .recent-post .rp-item .rp-pic {
            float: right;
            margin-left: 20px;
            margin-right: 0
        }
        .blog-sidebar .feature-post .recent-post .rp-item .rp-text span {
            padding-right: 22px;
            padding-left: 0
        }
        .blog-sidebar .feature-post .recent-post .rp-item .rp-text span:after {
            right: 0;
        }
        .breadcrumb-text .bt-option a:after {
            left: -18px;
            right: auto;
        }
        .breadcrumb-text .bt-option span {
            float: left;
            padding-left: 104px;
            padding-top: 2px;
        }
        .breadcrumb-text .bt-option a {
            margin-left: 20px;
            margin-right: 0
        }
        .breadcrumb-text .bt-option a:after {
            content: "/";
        }
        .hs-nav .nav-menu ul li:last-child {
            margin-left: 0;
        }
        .hs-top .ht-widget {
            text-align: left;
        }
        .hs-top .ht-widget ul li span {
            margin-right: 20px;
            margin-left: 0
        }
        .hs-top .ht-widget ul li span:after {
            right: -13px;
            left: auto;
        }
        .hs-nav .nav-menu ul li:last-child {
            margin-right: 30px;
        }
        .hs-top .ht-widget ul li {
            margin-left: 45px;
            margin-right: 0
        }
        .blog-item .bi-text ul li {margin-right: 0}
        .blog-item .bi-text ul li:after{display: none}
        .arrow_right:before {
            content: "\23";
        }
        .blog-details-content .bc-quote .bq-icon {
            float: right !important;
            margin-left: 20px;
            margin-right: 0
        }
        .bc-widget .comment-option .co-item .ci-pic {
            float: right !important;
            margin-left: 25px;
            margin-right: 0
        }
        .bc-widget .comment-option .co-item .ci-text ul {
            left: 0 !important;
            right: auto !important;
        }
        .bc-widget .comment-option .co-item .ci-text ul li i {
            margin-left: 5px;
            margin-right: 0
        }
        .bh-text ul li {
            margin-right: 0;
            margin-left: 32px
        }
        .bh-text ul li:after {display: none}
        @media only screen and (max-width: 767px) {
            .bc-widget .comment-option .co-item .ci-text ul li {
                margin-left: 25px !important;
                margin-right: 0 !important;
            }
            .main_img{width: 50%;}
            .bh-text ul li:last-child {
                margin-left: 0;
            }
            .offcanvas-menu-wrapper .om-widget ul li span {
                margin-right: 20px;
                margin-left: 0
            }
            .offcanvas-menu-wrapper .om-widget ul li span:after {
                right: -13px;
                left: 0;
            }
        }
        .team .member .detail {
            float: left !important;
        }
        .fa-arrow-right:before {
            content: "\f060";
        }
        .member-info i{
            margin-right: 9px;
            margin-left: 0
        }
        .profile-agent-content .profile-agent-widget {
            padding-left: 50px;
            padding-right: 0
        }
        .profile-agent-content .profile-agent-info:after {
            left: 0;
            right: auto;
        }
        .profile-agent-content .profile-agent-info .pi-pic {
            float: right;
            margin-left: 30px;
            margin-right: 0
        }
        .profile-agent-content .profile-agent-widget {
            padding-right: 50px;
            padding-left: 0;
        }
        .profile-agent-content .profile-agent-widget:after {
            left: 0;
            right: auto;
        }
        .contact-us .single-info{text-align: right !important}
        .contact-us .form .form-group label span {
            left: -12px;
            right: auto;
        }
        .about-text .at-feature .af-item .af-icon {
            float: right;
            margin-left: 30px;
            margin-right: 0
        }
        .chooseus-features .cf-item .cf-pic {
            float: right;
            margin-left: 20px;
            margin-right: 0
        }
        .hero-section{direction: ltr;}
        .hs-item .hc-inner-text .hc-text p span {
            float: right;
            padding-top: 6px;
        }
    </style>
    @endif
    @stack('styles')
</head>
