<?php

function gen_get_featured_projects(){
    $featured_projects = get_theme_mod('gen-proyects-posts', null);
    $posts_query = null;
    if(is_array($featured_projects) && !empty($featured_projects)){
        $posts_query = new WP_Query(array(
            'post_type'         => 'gen-project',
            'post__in'          =>  $featured_projects,
            'posts_per_page'    => -1,
            'orderby'           => 'post__in',
        ));
    }
    return $posts_query;
}

function gen_get_project_preview_info($project_id){
    return get_post_meta($project_id, 'gen-project-preview', true );
}
