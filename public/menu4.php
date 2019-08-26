<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
   
    <style>

        .wrapper {position:relative}
        /* Custom styles */
        .sidebar-toggle {
            background-color: yellow;
            border: 1px solid red;
            display: inline-block;
            float: none;
        }
        .sidebar-toggle .icon-bar {
            background-color: red;
        }

        #sidebar {
            left: -250px;
            width: 250px;
        }
        #sidebar, #main {
            transition-duration: 200ms;
            transition-property: left, margin-left;
        }

        .sidebar-open #sidebar {
            left: 0;
        }
        .sidebar-open #main {
            margin-left: 250px;
        }



        /* Dashboard */
        /*
        * Base structure
        */

        /* Move down content because we have a fixed navbar that is 50px tall */
        body {
        padding-top: 50px;
        }


        /*
        * Global add-ons
        */

        .sub-header {
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
        }

        /*
        * Top navigation
        * Hide default border to remove 1px line.
        */
        .navbar-fixed-top {
        border: 0;
        }

        /*
        * Sidebar
        */

        /* Hide for mobile, show later */
        .sidebar {
        display: none;
        }
        @media (min-width: 768px) {
        .sidebar {
            position:absolute;
            /*
            position: fixed;
            top: 51px;
            bottom: 0;
            left: 0;
            */
            z-index: 1000;
            display: block;
            padding: 20px;
            overflow-x: hidden;
            overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
            background-color: #f5f5f5;
            border-right: 1px solid #eee;
        }
        }

        /* Sidebar navigation */
        .nav-sidebar {
        margin-right: -21px; /* 20px padding + 1px border */
        margin-bottom: 20px;
        margin-left: -20px;
        }
        .nav-sidebar > li > a {
        padding-right: 20px;
        padding-left: 20px;
        }
        .nav-sidebar > .active > a,
        .nav-sidebar > .active > a:hover,
        .nav-sidebar > .active > a:focus {
        color: #fff;
        background-color: #428bca;
        }


        /*
        * Main content
        */

        .main {
        padding: 20px;
        }
        @media (min-width: 768px) {
        .main {
            padding-right: 40px;
            padding-left: 40px;
        }
        }
        .main .page-header {
        margin-top: 0;
        }


        /*
        * Placeholder dashboard ideas
        */

        .placeholders {
        margin-bottom: 30px;
        text-align: center;
        }
        .placeholders h4 {
        margin-bottom: 0;
        }
        .placeholder {
        margin-bottom: 20px;
        }
        .placeholder img {
        display: inline-block;
        border-radius: 50%;
        }
    </style>
</head>
<body class="sidebar-open">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Curieux.net</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Accueil</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Agenda</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Lieux</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Festivals</span></a>
                </li>

            </ul>
            <ul class="navbar-nav ml-auto">
                
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="accountDropdownLink">
                            <img src="#" class="avatar avatar-mini" alt="Avatar de Bruno ">
                            test
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdownLink">
                            <a class="dropdown-item" href="#">Annoncer un évènement</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Mon compte</a>
                            <a class="dropdown-item" href="#">Modifier mon profil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Déconnexion</a>
                        </div>
                        
                    </li>

            </ul>
        </div>
    </nav>

    <div class="wrapper">
    <div id="sidebar" class="sidebar">
    
        <ul class="sidebar-nav">
        <li class="sidebar-brand">
            <a href="#">Start Bootstrap</a>
        </li>
        <li>
            <a href="#">Dashboard</a>
        </li>
        <li>
            <a href="#">Shortcuts</a>
        </li>
        <li>
            <a href="#">Overview</a>
        </li>
        <li>
            <a href="#">Events</a>
        </li>
        <li>
            <a href="#">About</a>
        </li>
        <li>
            <a href="#">Services</a>
        </li>
        <li>
            <a href="#">Contact</a>
        </li>
        </ul>

    </div>
    <div id="main" class="main">
    <h1 class="page-header">Dashboard</h1>

    <i class="fa fa-bars fa-2x toggle-btn navbar-toggle sidebar-toggle" data-toggle="collapse" data-target="#menu-content" aria-expanded="false"></i>

    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quibusdam quas pariatur eius nisi minus ducimus! Neque quae, explicabo magni qui recusandae dicta beatae nulla veniam est illum exercitationem modi ea itaque mollitia esse possimus perferendis, corrupti voluptates blanditiis quasi? Temporibus maxime quos, harum ducimus cumque minima quo, necessitatibus numquam ullam hic quas? Numquam repudiandae corporis iste esse, expedita dolorum quasi, obcaecati rerum repellendus illum saepe accusamus autem impedit sapiente omnis in quia quidem unde aspernatur! Neque rerum saepe quaerat repudiandae cumque, placeat porro at sit nam! Praesentium minus alias ipsam deserunt aliquid a dolorum voluptatem incidunt autem? Dolorem, nobis veritatis.
    </div>
</div>

<script>
    var $body = $('body');

    $('.sidebar-toggle').on('click', function () {
        $body.toggleClass('sidebar-open');
    });
</script>

</body>
</html>