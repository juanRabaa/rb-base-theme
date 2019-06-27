<?php
/*
*  Fallback for pages without template
*
*/
?>
<?php get_header();?>
<body id="gen-landing" class="side-navbar">
    <div class="container-fluid p-0">
        <div class="row no-gutters flex-md-row-reverse">
            <div class="col-12 col-lg-1">
                <?php get_template_part('parts/common', 'navbar'); ?>
            </div>
            <div class="col-12 col-lg-11">
                <div id="gen-sections">
                    <section id="gen-section-intro" class="gen-section">
                        <div class="section-content container gen-layout-1 smaller">
                            <div class="info-box big">
                                <div class="content-header info-header row">
                                    <div class="col-12">
                                        <img class="img-fluid gen-logo d-none d-lg-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/genosha-logo.svg">
                                        <?php $title = get_theme_mod('gen-landing-header-title');
                                        if( $title || rb_is_customization_available()): ?>
                                        <h4 id="landing-header-title" class="title wow slideInUp"><?php rb_default_customizable($title, "Editame!"); ?></h4>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="content-body info-body row">
                                    <div class="col-12">
                                        <?php
                                        $text = get_theme_mod('gen-landing-header-text');
                                        if( $text || rb_is_customization_available()): ?>
                                        <p id="landing-header-text" class="text wow slideInUp">
                                            <?php rb_default_customizable($text, 'Soy un texto <span class="gen-color">editable</span>'); ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="gen-section-projects" class="gen-section">
                        <?php
                        $featured_projects_query = gen_get_featured_projects();
                        if($featured_projects_query && !is_wp_error($featured_projects_query) && $featured_projects_query->have_posts()):
                            while($featured_projects_query->have_posts()): $featured_projects_query->the_post();
                                $project = $featured_projects_query->post;
                                $preview_info = gen_get_project_preview_info($project->ID);
                                $thumbnail_url = get_the_post_thumbnail_url($project, 'full');
                                $data_container_columns = $thumbnail_url ? 'col-md-5' : '';
                                $layout = isset($preview_info['layout']) ? $preview_info['layout'] : 'layout-1';

                                //
                                $preview_box_class = $thumbnail_url ? 'with-image' : '';
                                //
                                $data_container_columns = $thumbnail_url ? 'col-md-5' : '';
                                //
                                $text_align_class = isset($preview_info['text-align']) && $preview_info['text-align'] == 'right' ? 'align-right' : '';
                                //Container que cubre todo el contenido. No corresponde si parte del contenido debe exceder los limites
                                // de un container
                                $preview_container_class = $layout == 'layout-2' ? 'container' : '';
                                //
                                $info_div_class = isset($preview_info['dark-bkg']) && $preview_info['dark-bkg'] ? 'bright' : '';
                                //Corresponde cuando no hay un container sobre el preview
                                $preview_detail_class = $layout == 'layout-2' ? "" : "container max-wd-980";
                                $preview_detail_class .= " $text_align_class";
                                //
                                $row_class = isset($preview_info['text-position']) && $preview_info['text-position'] == 'right' ? '' : 'flex-md-row-reverse';
                                ?>
                                <div class="project-preview <?php echo $preview_box_class; ?>">
                                    <div class="container-background">
                                        <?php if(isset($preview_info['bkg-color']) && is_string($preview_info['bkg-color'])): ?>
                                        <div class="overlay" style="background-color: <?php echo esc_attr($preview_info['bkg-color']); ?>;"></div>
                                        <?php endif; ?>
                                        <?php if(isset($preview_info['bkg-img']) && is_string($preview_info['bkg-img'])): ?>
                                        <div class="background full" style="background-image: url(<?php echo esc_attr($preview_info['bkg-img']); ?>);"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="project-preview-content">
                                        <div class="<?php echo $preview_container_class; ?>">
                                            <div class="row no-gutters align-items-center <?php echo $row_class; ?>">
                                                <?php if($thumbnail_url): ?>
                                                <div class="col-12 col-md-7">
                                                    <div class="project-image-container">
                                                        <img src="<?php echo $thumbnail_url; ?>">
                                                    </div>
                                                </div>
                                                <?php endif ; ?>
                                                <div class="col-12  <?php echo $data_container_columns; ?>">
                                                    <div class="preview-detail <?php echo $preview_detail_class; ?>">
                                                        <div class="project-info <?php echo $info_div_class; ?>">
                                                            <a href="<?php echo get_post_permalink(); ?>" class="title wow slideInUp"><?php echo get_the_title(); ?></a>
                                                            <?php if(isset($preview_info['text']) && is_string($preview_info['text'])): ?>
                                                            <div class="description wow slideInUp"><?php echo $preview_info['text']; ?></div>
                                                            <?php endif; ?>
                                                            <a class="link gen-button d-none" href="<?php echo get_post_permalink(); ?>">Ver más</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php if(wp_query_is_on_last($featured_projects_query)): ?>
                                            <div id="landing-projects-end">
                                                <a class="link gen-button filled big" href="projects.php">Más servicios</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php
                            endwhile;
                            wp_reset_postdata();
                            //endwhile have_posts
                        endif;
                        //end have_posts
                        ?>
                    </section>
                    <section id="gen-section-clients" class="gen-section list-section">
                        <div class="section-content">
                            <div class="container smaller">
                                <div class="row">
                                    <div class="col-12 col-lg-4">
                                        <div class="section-header">
                                            <?php
                                            $title = get_theme_mod('gen-landing-clients-title');
                                            if( $title || rb_is_customization_available()): ?>
                                            <h1 id='landing-clients-title' class="title wow slideInUp"><?php rb_default_customizable($title, 'Título editable'); ?></h1>
                                            <?php endif; ?>
                                            <?php
                                            $text = get_theme_mod('gen-landing-clients-text');
                                            if( $text || rb_is_customization_available()): ?>
                                            <p id='landing-clients-text' class="text wow slideInUp"><?php rb_default_customizable($text, 'Texto editable'); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-8">
                                        <div class="clients-list row">
                                            <?php
                                            $clients_query = new WP_Query(array(
                                                'post_type'         => 'gen-client',
                                                'posts_per_page'    => -1,
                                            ));
                                            if($clients_query->have_posts()):
                                                while($clients_query->have_posts()): $clients_query->the_post();
                                                    $grey_logo = gen_get_client_grey_logo($post->ID);
                                                    if(is_string($grey_logo) && $grey_logo):
                                                ?>
                                                <div class="client-box col-6 col-md-4 col-lg-3">
                                                    <img class="client-logo wow zoomIn" data-wow-duration="1s" src="<?php echo $grey_logo; ?>">
                                                </div>
                                                <?php
                                                    endif;
                                                endwhile; //end while have_posts
                                                wp_reset_postdata();
                                            endif;//end if have_post
                                            ?>
                                        </div>
                                    </div>
                                    <div class="d-none col-12">
                                        <div class="text-center view-more">
                                            <a class="link gen-button filled big" href="">Ver todas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="gen-section-locations" class="gen-section list-section">
                        <div class="section-content">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="section-header container smaller gen-layout-1">
                                            <?php
                                            $title = get_theme_mod('gen-landing-cities-title');
                                            if( $title || rb_is_customization_available()): ?>
                                            <h1 id='landing-cities-title' class="title wow slideInUp"><?php rb_default_customizable($title, 'Título editable'); ?></h1>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="locations-list row">
                                            <?php
                                            $cities_query = new WP_Query(array(
                                                'post_type'         => 'gen-city',
                                                'posts_per_page'    => -1,
                                            ));
                                            if($cities_query->have_posts()):
                                                while($cities_query->have_posts()): $cities_query->the_post();
                                                    $thumbnail_url = get_the_post_thumbnail_url($post->ID);
                                                    if($thumbnail_url):
                                                ?>
                                                <div class="col-6 col-md-4 col-lg-3">
                                                    <div class="location-box wow zoomIn" data-wow-duration="1s" >
                                                        <div class="location-image-holder">
                                                            <div class="overlay"></div>
                                                            <div class="location-image background full full-size" style="background-image: url(<?php echo $thumbnail_url; ?>);"></div>
                                                        </div>
                                                        <div class="location-content">
                                                            <p class="name"><?php echo get_the_title(); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    endif;
                                                endwhile; //end while have_posts
                                                wp_reset_postdata();
                                            endif;//end if have_post
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php get_template_part('parts/common', 'footer'); ?>
            </div>
        </div>
    </div>
</body>
<?php get_footer(); ?>
