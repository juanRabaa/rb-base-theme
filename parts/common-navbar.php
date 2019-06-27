<?php
/*
*   Regular header
*
*/
?>
<div id="gen-navbar-container">
    <div id="gen-navbar">
        <div class="container navbar-content">
            <div class="row navbar-row align-items-center">
                <div class="col-9 d-lg-none gen-logo">
                    <a href="index.php"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/genosha-logo.png" class="img-fluid"></a>
                </div>
                <div class="col-3 col-lg-12 d-flex justify-content-end justify-content-lg-center">
                    <div id="gen-navbar-trigger">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="gen-navbar-menu" class="menu-container">
        <div class="menu-content">
            <div class="desktop-menu-background"></div>

            <ul class="gen-menu">
                <li class="menu-item" data-wow-duration="0.4s" data-wow-delay="0s">
                    <a href="about-us.php">About us</a>
                </li>
                <li class="menu-item" data-wow-duration="0.4s" data-wow-delay="0.2s">
                    <a href="">Servicios</a>
                </li>
                <li class="menu-item" data-wow-duration="0.4s" data-wow-delay="0.4s">
                    <a href="projects.php">projectos</a>
                </li>
                <li class="menu-item" data-wow-duration="0.4s" data-wow-delay="0.6s">
                    <a href="">Lab</a>
                </li>
                <li class="menu-item" data-wow-duration="0.4s" data-wow-delay="0.8s">
                    <a href="contact.php">Contacto</a>
                </li>
            </ul>
            <?php get_template_part('parts/navbar', 'social'); ?>
            <div id="gen-nav-buttons" class="d-none">
                <div class="nav-button button-down fa-stack">
                    <div class="icon-bkg "></div>
                    <i class="icon-fa fas fa-caret-up"></i>
                </div>
                <div class="nav-button button-down fa-stack">
                    <div class="icon-bkg "></div>
                    <i class="icon-fa fas fa-caret-down"></i>
                </div>
            </div>
        </div>
    </div>
</div>
