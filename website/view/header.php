<!--
	ETML
	Auteur : Serghei Diulgherov
	Date : 06.05.2022
	Description : Header
-->

<?php 
    function setActive($page)
    {
        if (strpos(parse_url($_SERVER['REQUEST_URI'])['query'], $page))
        {
            print '<li class="active">';
        }
        else
        {
            print '<li>';
        }
    }        
?>

<!-- Preloader -->
<div id="preloader">
    <i class="circle-preloader"></i>
    <img src="resources/bootstrap/img/core-img/salad.png" alt="">
</div>

<!-- Search Wrapper -->
<div class="search-wrapper">
    <!-- Close Btn -->
    <div class="close-btn"><i class="fa fa-times" aria-hidden="true"></i></div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#" method="post">
                    <input type="search" name="search" placeholder="Type any keywords...">
                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ##### Header Area Start ##### -->
<header class="header-area">

    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-between">
                <!-- Breaking News -->
                <div class="col-12 col-sm-6">
                    <div class="breaking-news">
                        <div id="breakingNewsTicker" class="ticker">
                            <ul>
                                <li><a href="#">ETML</a></li>
                                <li><a href="#">P_WEB2 Recettes</a></li>
                                <li><a href="#">Bienvenue!</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="delicious-main-menu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="deliciousNav">

                    <!-- Logo -->
                    <a class="nav-brand" href="index.php?controller=home&action=index"><img src="resources/image/logos/logo.png" alt=""></a>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <?php if (isset(parse_url($_SERVER['REQUEST_URI'])['query'])): ?>
                                    <?php setActive("index"); ?><a href="index.php?controller=home&action=index">Accueil</a></li>
                                    <?php setActive("recipe"); ?><a href="index.php?controller=recipe&action=list">Recettes</a></li>
                                    <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) : ?>
                                        <?php setActive("add"); ?><a href="index.php?controller=recipe&action=add">Ajouter une recette</a></li>
                                    <?php endif ?>
                                    <?php setActive("contact"); ?><a href="index.php?controller=home&action=contact">Contact</a></li>
                                    <?php setActive("connect"); ?><a href="index.php?controller=home&action=connect">Connexion</a></li>
                                <?php else: ?>
                                    <li class="active"><a href="index.php?controller=home&action=index">Accueil</a></li>
                                    <li><a href="index.php?controller=recipe&action=list">Recettes</a></li>
                                    <li><a href="index.php?controller=home&action=contact">Contact</a></li>
                                <?php endif ?>
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->