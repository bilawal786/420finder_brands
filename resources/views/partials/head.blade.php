<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/logo.png') }}" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/star-rating/star-rating-svg.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toast.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/select2.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/mystyles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/business.css') }}">

</head>

<body>
    <style>
        #businesssidebar .list-group-item a {
            padding: 18px 30px;
            display: block;
            font-weight: bold;
        }
        @media(max-width: 980px) {
            img.card-img-top {
                width: 100% !important;
                height: 150px !important;
            }
            .post-slide {
                margin: 0px 3px 0px !important;
            }
            .retailerOrderBtn {
                font-size: 8px !important;
            }
            .retailerTitle {
                font-size: 16px !important;
            }
            .post-slide {
                border: none !important;
            }
            .post-slide .post-content {
                padding: 0 !important;
            }
        }

    /* DEAL SINGLE CONTENT */
        .liveMenu {
        border: 1px solid green;
        color: green;
        padding: 2px 6px;
        border-radius: 5px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .liveMenu:before {
        content: "•";
        width: 0.375rem;
        height: 0.375rem;
        font-size: 14px;
        border-radius: 50%;
        margin-right: 0.25rem;
    }
    i.fa.fa-star {
        color: #f8971c;
    }
    .showOnMobileRetailerSidebar {
        display: none;
    }
    @media(max-width:  980px) {
        .showOnMobileRetailerSidebar button {
            font-size: 12px;
        }
        .showOnMobileRetailerSidebar {
            display: block;
            margin-top: 15px;
        }
        .hideRetailerDetailSidebar {
            display: none;
        }
        i.fa.fa-star {
            font-size: 24px;
        }
        span.reviewCount {
            font-size: 14px;
        }
        .topDeliveryRow .col-4 img {
            width: 100% !important;
        }
        .topDeliveryRow .col-4 {
            text-align: left !important;
        }
        .topDeliveryRow .col-8 h3 {
            text-align: left;
            font-size: 24px;
        }
        .topDeliveryRow .col-8 p {
            text-align: left;
        }
        .detailedBox {
            padding: 10px 20px;
        }
        .retailerbnametext {
            font-size: 18px;
        }
        span.followers {
            display: none;
        }
        .favBrand.favoriteButton {
            position: absolute;
            top: 29%;
            right: 6%;
        }
        .ctaButtonFirst, .ctaButtonSecond {
            width: 50%;
            border: 1 px solid silver;
        }
    }

    /* INDEX PAGE CONTENT */
        .forMobilePadding .forDesktop img {
            height: 356px;
        }
        .carousel-item img {
            height: 356px;
        }
        .retailerOrderBtn {
            background: transparent;
            border: 1px solid silver;
            border-radius: 30px;
            padding: 6px 15px;
            font-size: 12px;
            color: #606060;
        }
        .retailerOrderBtn:hover {
            color: unset;
        }
        .markerImageIcon {
            position: absolute;
            bottom: 0;
            right: 3%;
            width: 39px !important;
            height: 35px !important;
        }

        .forRating i.fa.fa-star {
            color: #F8971C !important;
            font-size: 18px;
            margin-top: 8px;
        }

        .forMobilePadding{
            padding-left: 0px !important;
            padding-right: 0px !important;
        }
        .forMobile {
            display: none;
        }
        .forDesktop {
            display: block;
        }
        @media(max-width:  980px) {
            img.card-img-top {
                height: 160px !important;
            }
            ul.list-unstyled.d-flex.ratings {
                font-size: 12px;
            }
            .ratings i.far.fa-star {
                font-size: 14px;
                margin-top: 10px;
            }
            .mobileCarasoulTop {
                margin-top: 0 !important;
            }
            .owl-buttons {
                display: none;
            }
            .bg-light.defaultImage {
                height: 150px !important;
            }
            .carousel-item img {
                height: unset;
            }
            .forDesktop {
                display: none;
            }
            .forMobile {
                display: block;
            }
            /*.mainbanner {
                height: 95px;
            }*/
        }
        #news-slider{
            margin-top: 80px;
        }
        .post-slide{
            background: #fff;
            margin: 20px 15px 20px;
            padding-top: 1px;
            border: 1px solid #d5d5d5;
        }
        .post-slide .post-img{
            position: relative;
            overflow: hidden;
            /*border-radius: 10px;
            margin: -12px 15px 8px 15px;
            margin-left: -10px;*/
        }
        .post-slide .post-img img{
            width: 100%;
            height: auto;
            transform: scale(1,1);
            transition:transform 0.2s linear;
        }
        /*.post-slide:hover .post-img img{
            transform: scale(1.1,1.1);
        }*/
        .post-slide .over-layer{
            width:100%;
            height:100%;
            position: absolute;
            top:0;
            left:0;
            /*opacity:0;*/
            /*background: linear-gradient(-45deg, rgba(6,190,244,0.75) 0%, rgba(45,112,253,0.6) 100%);
            transition:all 0.50s linear;*/
        }
        .post-slide:hover .over-layer{
            opacity:1;
            text-decoration:none;
        }
        .post-slide .over-layer i{
            top: 3%;
            text-align: center;
            display: block;
            font-size: 19px;
            background: white;
            color: #adaeb0;
            border-radius: 50%;
            border: 1px solid #adaeb0;
            width: 32px;
            height: 32px;
            padding-top: 6px;
            float: right;
            margin-right: 10px;
            margin-top: 10px;
        }
        .post-slide .post-content{
            background:#fff;
            /*padding: 2px 20px 40px;*/
            /*border-radius: 15px;*/
        }
        .post-slide .post-title a{
            font-size:15px;
            font-weight:bold;
            color:#333;
            display: inline-block;
            text-transform:uppercase;
            transition: all 0.3s ease 0s;
        }
        .post-slide .post-title a:hover{
            text-decoration: none;
            color:#3498db;
        }
        .post-slide .post-description{
            line-height:24px;
            color:#808080;
            margin-bottom:25px;
        }
        .post-slide .post-date{
            color:#a9a9a9;
            font-size: 14px;
        }
        .post-slide .post-date i{
            font-size:20px;
            margin-right:8px;
            color: #CFDACE;
        }
        .post-slide .read-more{
            padding: 7px 20px;
            float: right;
            font-size: 12px;
            background: #2196F3;
            color: #ffffff;
            box-shadow: 0px 10px 20px -10px #1376c5;
            border-radius: 25px;
            text-transform: uppercase;
        }
        .post-slide .read-more:hover{
            background: #3498db;
            text-decoration:none;
            color:#fff;
        }
        .owl-controls .owl-buttons{
            text-align:center;
            margin-top:20px;
        }
        .owl-controls .owl-buttons .owl-prev{
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            position: absolute;
            top: 34%;
            left: 6px;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            transition: background 0.5s ease 0s;
            filter: drop-shadow(rgba(0, 0, 0, 0.14) 0px 0.125rem 0.25rem) drop-shadow(rgba(0, 0, 0, 0.12) 0px 0.25rem 0.3125rem) drop-shadow(rgba(0, 0, 0, 0.2) 0px 0.0625rem 0.625rem);
        }
        .owl-controls .owl-buttons .owl-next{
            display: flex;
            justify-content: center;
            align-items: center;
            background: #fff;
            position: absolute;
            top: 34%;
            right: 6px;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            filter: drop-shadow(rgba(0, 0, 0, 0.14) 0px 0.125rem 0.25rem) drop-shadow(rgba(0, 0, 0, 0.12) 0px 0.25rem 0.3125rem) drop-shadow(rgba(0, 0, 0, 0.2) 0px 0.0625rem 0.625rem);
            transition: background 0.5s ease 0s;
        }
        /* .owl-controls .owl-buttons .owl-prev:after,
        .owl-controls .owl-buttons .owl-next:after{
            content: "";
            font-family: FontAwesome;
            color: #333;
            font-size: 23px;
        }
        .owl-controls .owl-buttons .owl-next:after{
            content:"";
        } */

        .owl-controls .owl-buttons .owl-prev i,
        .owl-controls .owl-buttons .owl-next i {
            color: #000;
            font-weight: bold;
        }

        @media only screen and (max-width:1280px) {
            .post-slide .post-content{
                padding: 0px 15px 25px 15px;
            }
        }

    /* Navigation Content */
    .hambergerSubMenuItems {
        display: none;
    }
    input.form-control.border-0.mobileNavSearchBox:focus {
        border: none !important;
        box-shadow: none !important;
    }

    @media(max-width: 980px) {
        .hambergerSubMenuItems {
            display: block;
        }
        .subMenuRow {
            display: none !important;
        }
        nav#navbar {
            margin-right: 4% !important;
        }

    }
        .sidebar .nav span {
            font-weight: bold !important;
        }
    .panel-title {
       display: inline;
       font-weight: bold;
       }
       .display-table {
       display: table;
       }
       .display-tr {
       display: table-row;
       }
       .display-td {
       display: table-cell;
       vertical-align: middle;
       width: 61%;
       }
        .appointment-btn {
             margin-left: 0px;
            background: #F8971C;
            color: #fff;
            border-radius: 50px;
            padding: 8px 25px;
            white-space: nowrap;
            transition: 0.3s;
            font-size: 14px;
            display: inline-block;
        }
        .label {
            display: inline;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
        .label-danger {
            background-color: #d9534f;
        }
        .label-default {
            background-color: orange;
        }
        .mobile-view{
            position: fixed;
            z-index: 5000;
            width: 100%;
            height: 100vh;
            top: 0;
            bottom: 0;
        }

        @media only screen and (max-width: 600px) {
            .content-main{
                display: none !important;
            }
            .dash-analytics{
                display: none;
            }
            .chart-row{
                display: none;
            }
            .navbar-default{
                display: none !important;
            }
            .brand {
                display: none !important;
            }
            .container-fluid{
                display: none;
            }
            .mobile-view{
                display: block !important;
            }
        }
    </style>

    @yield('styles')

