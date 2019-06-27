<?php
/*
*   Navbar social links
*/

$navbar_items = get_theme_mod('gen-social-data', null);
$d_class = $navbar_items ? '' : 'd-none';
?>
<div id="navbar-social-menu" class="gen-social-menu <?php echo $d_class; ?>">
    <?php
    if(is_array($navbar_items) && !empty($navbar_items)):
        $wow_delay = 0;
        foreach($navbar_items as $social_data):
            $name = isset($social_data['name']) ? $social_data['name'] : '';
            $url = isset($social_data['url']) ? $social_data['url'] : '';
            $fa = isset($social_data['fa']) ? $social_data['fa'] : '';
            if($url && $fa):
                ?>
                <a title="<?php echo $name; ?>" class="social-link fa-stack wo zoomIn" data-wow-duration="0.4s" data-wow-delay="<?php echo $wow_delay; ?>s" href="<?php echo esc_attr($url); ?>" target="_blank">
                    <div class="icon-bkg"></div>
                    <i class="icon-fa <?php echo esc_attr($fa); ?>"></i>
                </a>
                <?php
                $wow_delay += 0.1;
            endif;//end show item
        endforeach;//end show all items
    endif;//end if there are items
    ?>
</div>
