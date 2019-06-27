<?php
/*
*  Fallback for pages without template
*
*/
?>
<?php get_header();?>
<body id="gen-project" class="side-navbar light">
    <div class="container-fluid p-0">
        <div class="row no-gutters flex-md-row-reverse">
            <div class="col-12 col-lg-1">
                <?php get_template_part('parts/common', 'navbar'); ?>
            </div>
            <div class="col-12 col-lg-11">
                <div id="page-content">
                    <?php if( have_posts() ): the_post();?>
                    <div id="project-header" class="post-header first-section">
                        <div class="gen-logo-holder d-none d-lg-block">
                            <div class="container smaller gen-layout-1">
                                <div class="gen-logo">
                                    <div class="logo-holder">
                                        <div class="gen-logo-background"></div>
                                        <a href="index.php"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/genosha-logo.png" class="img-fluid"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container smaller gen-layout-1">
                            <div class="post-info">
                                <h6 class="name"><?php echo get_the_title(); ?></h6>
                                <?php if(has_excerpt()): ?>
                                <h1 class="description"><?php echo get_the_excerpt(); ?></h1>
                                <?php endif; ?>
                            </div>
                            <div class="gen-separator big"></div>
                        </div>
                    </div>
                    <div id="project-body" class="">
                        <?php the_content(); ?>
                    </div>

                    <?php if(false): ?>
                    <div id="project-body">
                        <div class="post-info-box caracteristicas gen-pink-bkg dual-text">
                            <div class="container gen-layout-1 smaller">
                                <div class="row align-items-center">
                                    <div class="col-12 col-md-7">
                                        <div class="gen-info-box items">
                                            <p class="item">Offlinet First</p>
                                            <p class="item">Cache Imagenes</p>
                                            <p class="item">Facil Administracion</p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5 ">
                                        <div class="gen-info-box mb-0">
                                            <p class="text mb-0">Para esto creamos Catálogos, una plataforma digital de productos que permite el funcionamiento offline, control de usuarios y manejo de pedidos y carritos de compra.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="project-process post-info-box">
                            <div class="process-info-header">
                                <div class="container smaller gen-layout-1">
                                    <div class="gen-info-box process-header-info">
                                        <h1 class="title">El Proceso</h1>
                                        <p class="text">Para esto creamos Catálogos, una plataforma digital de productos que permite el funcionamiento offline, control de usuarios y manejo de pedidos y carritos de compra.
                                        </p>
                                        <a class="link gen-button" href="" target="_blank">Ver más</a>
                                    </div>
                                </div>
                            </div>
                            <div class="container smaller ">
                                <div class="row m-0 align-items-center process-info-body">
                                    <div class="col-12 col-md-7 col-lg-8 mb-5">
                                        <div class="image-holder">
                                            <div class="process-image background full" style="background-image: url(<?php echo get_template_directory_uri(); ?>/assets/img/cat-1.jpg);"></div>
                                            <p class="caption">Este texto es para poner abajo de la imagen, por si se quiere explicar algo de la imagen.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-5 col-lg-4 pl-md-0">
                                        <div class="gen-info-box ">
                                            <h1 class="title tiny gen-color-pink">Titular increible </h1>
                                            <p class="text">Para esto creamos Catálogos, una plataforma digital de productos que permite el funcionamiento offline, control de usuarios y manejo de pedidos y carritos de compra.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;//deleted static markup ?>
                    <?php endif; //end have_posts ?>
                </div>
                <?php get_template_part('parts/common', 'footer'); ?>
            </div>
        </div>
    </div>
</body>
<?php get_footer(); ?>
