<?php include('controler.php'); ?>
<header class="headerbar">
    <img class="logo" src="assets/img/logo.png" alt="logo">
    <div class="btn-group-action">
        <a href="shop-cage.php?action=shop-cage">
            <button class="btn btn-dark">Mon panier</button>
        </a>
        <?php
            if ($_SESSION['connected']) {
                ?>
                <span>Bienvenue <?php echo $_SESSION['second_name']; ?> !</span>
                <a href="dashboard.php?action=dashboard">
                    <button class="btn btn-outline-dark">Dashboard</button>
                </a>
                <a href="controler.php?action=disconnect">
                    <button class="btn btn-danger">Se déconnecter</button>
                </a>
                <?php
            } else {
                ?>
                <a href="login.php">
                    <button class="btn btn-dark">Se connecter</button>
                </a>
                <a href="signin.php">
                    <button class="btn btn-outline-dark">S'inscrire</button>
                </a>
                <?php
            }
        ?>
    </div>
</header>
<div class="wrapper active">
    <div class="sidebar-wrapper">
        <ul class="sidebar-nav">
            <li class="nav-item menu">
                <a id="menu-toggle" href="#">Menu<span id="main_icon" class="fa fa-align-justify"></span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./?action=home">Accueil</a>
            </li>
            <?= $data_marks ?>
            <li class="nav-item">
                <a class="nav-link" href="forum.php?action=forum">Forum</a>
            </li>
        </ul>
        <div class="logo-container">
            <img src="assets/img/bmw.png" alt="bmw">
            <img src="assets/img/citroen.png" alt="citroen">
            <img src="assets/img/mercedes.jfif" alt="mercedes">
            <img src="assets/img/renault.jfif" alt="renault">
            <img src="assets/img/peugeot.png" alt="peugeot">
        </div>
    </div>
</div>