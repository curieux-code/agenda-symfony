<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Bootstrap Collapsible Left SideBar</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   
  <style id="compiled-css" type="text/css">
      .nav-side-menu {
        overflow: auto;
        font-family: verdana;
        font-size: 12px;
        font-weight: 200;
        background-color: #2e353d;
        /* position: fixed; */
        position:absolute;
        top: 0px;
        width: 300px;
        /* height: 100%; */
        color: #e1ffff;
        }

        .nav-side-menu .brand {
        background-color: #23282e;
        line-height: 70px;
        display: block;
        text-align: center;
        font-size: 14px;
        }

        #main .inbox {
        background-color: #9fc163;
        line-height: 70px;
        display: block;
        text-align: center;
        font-size: 14px;
        font-weight: 600;
        }

        .nav-side-menu .toggle-btn {
        display: none;
        }

        .nav-side-menu ul,
        .nav-side-menu li {
        list-style: none;
        padding: 0px;
        margin: 0px;
        line-height: 35px;
        cursor: pointer;
        /*    
            .collapsed{
            .arrow:before{
                        font-family: FontAwesome;
                        content: "\f053";
                        display: inline-block;
                        padding-left:10px;
                        padding-right: 10px;
                        vertical-align: middle;
                        float:right;
                    }
            }
        */
        }

        .nav-side-menu ul:not(collapsed) .arrow:before,
        .nav-side-menu li:not(collapsed) .arrow:before {
        font-family: FontAwesome;
        content: "\f078";
        display: inline-block;
        padding-left: 10px;
        padding-right: 10px;
        vertical-align: middle;
        float: right;
        }

        .nav-side-menu ul .active,
        .nav-side-menu li .active {
        border-left: 3px solid #d19b3d;
        background-color: #4f5b69;
        }

        .nav-side-menu ul .sub-menu li.active,
        .nav-side-menu li .sub-menu li.active {
        color: #d19b3d;
        }

        .nav-side-menu ul .sub-menu li.active a,
        .nav-side-menu li .sub-menu li.active a {
        color: #d19b3d;
        }

        .nav-side-menu ul .sub-menu li,
        .nav-side-menu li .sub-menu li {
        background-color: #181c20;
        border: none;
        line-height: 28px;
        border-bottom: 1px solid #23282e;
        margin-left: 0px;
        }

        .nav-side-menu ul .sub-menu li:hover,
        .nav-side-menu li .sub-menu li:hover {
        background-color: #020203;
        }

        .nav-side-menu ul .sub-menu li:before,
        .nav-side-menu li .sub-menu li:before {
        font-family: FontAwesome;
        content: "\f105";
        display: inline-block;
        padding-left: 10px;
        padding-right: 10px;
        vertical-align: middle;
        }

        .nav-side-menu li {
        padding-left: 0px;
        border-left: 3px solid #2e353d;
        border-bottom: 1px solid #23282e;
        }

        .nav-side-menu li a {
        text-decoration: none;
        color: #e1ffff;
        }

        .nav-side-menu li a i {
        padding-left: 10px;
        width: 20px;
        padding-right: 20px;
        }

        .nav-side-menu li:hover {
        border-left: 3px solid #d19b3d;
        background-color: #4f5b69;
        -webkit-transition: all 1s ease;
        -moz-transition: all 1s ease;
        -o-transition: all 1s ease;
        -ms-transition: all 1s ease;
        transition: all 1s ease;
        }

        @media (max-width: 767px) {
        .nav-side-menu {
            position: relative;
            width: 100%;
            margin-bottom: 10px;
        }
        .nav-side-menu .toggle-btn {
            display: block;
            cursor: pointer;
            position: absolute;
            right: 10px;
            top: 10px;
            z-index: 10 !important;
            padding: 3px;
            background-color: #ffffff;
            color: #000;
            width: 40px;
            text-align: center;
        }
        .brand {
            text-align: left !important;
            font-size: 22px;
            padding-left: 20px;
            line-height: 50px !important;
        }
        }

        @media (min-width: 767px) {
        .nav-side-menu .menu-list .menu-content {
            display: block;
        }
        .wrapper {
            width: calc(100% - 300px);
            float: right;
        }
        }

        body {
        margin: 0px;
        padding: 0px;
        }

    </style>



</head>
<body>

<div class="container-fluid" id="main">
    <div class="inbox">
    HEADER
    </div>
    <div class="row">
        <div class="col-lg-12">



           

        <div class="nav-side-menu">

            <div class="brand">Rechercher par rubrique</div>
            <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

            <div class="menu-list">
                <ul id="menu-content" class="menu-content collapse out">
                <li>
                    <a href="#">
                    <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </a>
                </li>
                <li data-toggle="collapse" data-target="#products" class="collapsed active">
                    <a href="#"><i class="fa fa-gift fa-lg"></i> UI Elements <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li class="active"><a href="#">CSS3 Animation</a></li>
                    <li><a href="#">General</a></li>
                    <li><a href="#">Buttons</a></li>
                    <li><a href="#">Tabs &amp; Accordions</a></li>
                    <li><a href="#">Typography</a></li>
                    <li><a href="#">FontAwesome</a></li>
                    <li><a href="#">Slider</a></li>
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Widgets</a></li>
                    <li><a href="#">Bootstrap Model</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#service" class="collapsed">
                    <a href="#"><i class="fa fa-globe fa-lg"></i> Services <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="service">
                    <li>New Service 1</li>
                    <li>New Service 2</li>
                    <li>New Service 3</li>
                </ul>


                <li data-toggle="collapse" data-target="#new" class="collapsed">
                    <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                    <li>New New 1</li>
                    <li>New New 2</li>
                    <li>New New 3</li>
                </ul>
                <li>
                    <a href="#">
                    <i class="fa fa-user fa-lg"></i> Profile
                    </a>
                </li>
                <li>
                    <a href="#">
                    <i class="fa fa-users fa-lg"></i> Users
                    </a>
                </li>
                </ul>
            </div>
        </div>

        <div class="wrapper">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Provident quibusdam, unde saepe eligendi rem dignissimos nulla impedit facere quas ab modi cupiditate dolores aliquam iste tempore minima non exercitationem optio placeat consequatur commodi aperiam dicta iusto! Eaque nulla ratione in beatae laboriosam, tenetur fugit quos, sapiente quidem dicta quia aspernatur amet, assumenda aperiam similique officia!
      </div>
    </div>

  </div>
</div>
</div>


</body>
</html>