<!--non valido per w3c perchè template-->
<header>
    <div class="logo">
        <?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "studente"): ?>
        <a href="paginaPrincipale_studente.php">
            <figure>
                <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
            </figure>
        </a>
        <?php endif; ?>
        <?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "admin"): ?>
        <a href="paginaPrincipale_amministratore.php">
            <figure>
                <img src="upload/uniboLogo.png" alt="Logo Alma Aule">
            </figure>
        </a>
        <?php endif; ?>
    </div>
    <div class="title">
        <h1>Alma Aule</h1>
    </div>
    <?php if(isUserLogged()): ?>
    <div class="menu-container">
        <a href="javascript:void(0);" onclick="openMenu()" class="hamburger-menu" aria-label="Apri menu">
            &#9776;
        </a>
    </div>
    <?php endif; ?>
    <div class="logout-pc">
        <a href="logout.php">Logout</a>
    </div>
</header>
<?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "studente"): ?>
<nav class="menu-pc">
    <ul>
        <li><a href="cercaAula_studente.php">AULE</a></li>
        <li><a href="cercaLaboratorio_studente.php">LABORATORI</a></li>
        <li><a href="polivalente.php">POLIVALENTE</a></li>
        <li><a href="eventi_studente.php">EVENTI</a></li>
        <li><a href="prenotazioni_studente.php">PRENOTAZIONI</a></li>
    </ul>
</nav>
<?php endif; ?>
<?php if(isset($_SESSION['tipo_utente']) && $_SESSION['tipo_utente'] === "admin"): ?>
<nav class="menu-pc">
    <ul>
        <li><a href="listaPrenotazioni_admin.php">PRENOTAZIONI</a></li>
        <li><a href="eventi_admin.php">EVENTI</a></li>
        <li><a href="richieste_admin.php">RICHIESTE IN CORSO</a></li>
    </ul>
</nav>
<?php endif; ?>

<div id="sideMenuMobile" class="side-menu-mobile">
    <header class="header-menu">
        <img src="upload/uniboLogo.png" alt="Logo Università" class="logo-menu">
        <a href="javascript:void(0);" class="btn-chiudi-menu" onclick="closeMenu()">&gt;</a>
    </header>

    <div class="red-bar">
        <div class="spacer"></div>
        <div class="subtitle">
            <h2>MENU</h2>
        </div>
        <div class="spacer"></div>
    </div>

    <?php
    if (isUserLogged()) {
        if (isStudente()) {
            $templateParams["voci_menu"] = [
                ["nome" => "AULE", "url" => "cercaAula_studente.php"],
                ["nome" => "LABORATORI", "url" => "cercaLaboratorio_studente.php"],
                ["nome" => "POLIVALENTE", "url" => "polivalente.php"],
                ["nome" => "EVENTI", "url" => "eventi_studente.php"],
                ["nome" => "PRENOTAZIONI", "url" => "prenotazioni_studente.php"]
            ];
        } elseif (isAdmin()) {
            $templateParams["voci_menu"] = [
                ["nome" => "PRENOTAZIONI", "url" => "listaPrenotazioni_admin.php"],
                ["nome" => "EVENTI", "url" => "eventi_admin.php"],
                ["nome" => "RICHIESTE IN CORSO", "url" => "richieste_admin.php"]
            ];
        }
        require("menu_base.php");
    }
    ?>
</div>

<script src="script/header_pagine_script.js"
    type="text/javascript"></script>