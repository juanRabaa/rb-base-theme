<?php
// =============================================================================
// PANEL BUILDER
// =============================================================================
function customizer_api_configuration($customizer_api){
    $customizer_api->add_panel(
		'front_page_panel',
		array(
			'priority'       => 3,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __('Front page', 'genosha-web'),
			'description'    => __('Configuración de la home', 'genosha-web'),
		)
	);

    // =========================================================================
    // LANDING HEADER
    // =========================================================================
    $customizer_api->add_section(
        'gen-landing-header',
        array(
            'title'     => 'Header',
            'priority'  => 1,
            'panel'  	=> 'front_page_panel',
        ),
        array(
            // 'activated' 		=> true,
            // 'selector'			=>	"#main-grid",
        )
    )
    ->add_control(//Control creation
        'gen-landing-header-title',//id
        'RB_Customizer_Field_Control',//control class
        array(//Settings creation
            'gen-landing-header-title' => array(
                'options' => array(
                    'transport' => 'postMessage',
                    'default'	=> '',
                ),
                'selective_refresh' => array(
                    'activated' 			=> true,
                    'selector'  			=> '#landing-header-title',
                    //'container_inclusive'	=>	false,
                ),
            )
        ),
        array(//Control options
            'controls'	=> array(
                'text'	=> array(
                    'input_type'    => 'text',
                ),
            ),
            'title'		    => __( 'Título', 'genosha-web' ),
        )
    )
    ->add_control(//Control creation
        'gen-landing-header-text',//id
        'RB_Customizer_Field_Control',//control class
        array(//Settings creation
            'gen-landing-header-text' => array(
                'options' => array(
                    'transport' => 'postMessage',
                    'default'	=> '',
                ),
                'selective_refresh' => array(
                    'activated' 			=> true,
                    'selector'  			=> '#landing-header-text',
                    //'container_inclusive'	=>	false,
                ),
            )
        ),
        array(//Control options
            'controls'	=> array(
                'text'	=> array(
                    'type'    => 'RB_tinymce_control',
                ),
            ),
            'title'		    => __( 'Texto', 'genosha-web' ),
        )
    );


    // =========================================================================
    // LANDING CLIENTS
    // =========================================================================
    $customizer_api->add_section(
        'gen-landing-clients',
        array(
            'title'     => 'Clientes',
            'priority'  => 1,
            'panel'  	=> 'front_page_panel',
        ),
        array(
            // 'activated' 		=> true,
            // 'selector'			=>	"#main-grid",
        )
    )
    ->add_control(//Control creation
        'gen-landing-clients-title',//id
        'RB_Customizer_Field_Control',//control class
        array(//Settings creation
            'gen-landing-clients-title' => array(
                'options' => array(
                    'transport' => 'postMessage',
                    'default'	=> '',
                ),
                'selective_refresh' => array(
                    'activated' 			=> true,
                    'selector'  			=> '#landing-clients-title',
                    //'container_inclusive'	=>	false,
                ),
            )
        ),
        array(//Control options
            'controls'	=> array(
                'text'	=> array(
                    'input_type'    => 'text',
                ),
            ),
            'title'		    => __( 'Título', 'genosha-web' ),
        )
    )
    ->add_control(//Control creation
        'gen-landing-clients-text',//id
        'RB_Customizer_Field_Control',//control class
        array(//Settings creation
            'gen-landing-clients-text' => array(
                'options' => array(
                    'transport' => 'postMessage',
                    'default'	=> '',
                ),
                'selective_refresh' => array(
                    'activated' 			=> true,
                    'selector'  			=> '#landing-clients-text',
                    //'container_inclusive'	=>	false,
                ),
            )
        ),
        array(//Control options
            'controls'	=> array(
                'text'	=> array(
                    'type'    => 'RB_tinymce_control',
                ),
            ),
            'title'		    => __( 'Texto', 'genosha-web' ),
        )
    );

    // =========================================================================
    // LANDING CITIES
    // =========================================================================
    $customizer_api->add_section(
        'gen-landing-cities',
        array(
            'title'     => 'Clientes',
            'priority'  => 1,
            'panel'  	=> 'front_page_panel',
        ),
        array(
            // 'activated' 		=> true,
            // 'selector'			=>	"#main-grid",
        )
    )
    ->add_control(//Control creation
        'gen-landing-cities-title',//id
        'RB_Customizer_Field_Control',//control class
        array(//Settings creation
            'gen-landing-cities-title' => array(
                'options' => array(
                    'transport' => 'postMessage',
                    'default'	=> '',
                ),
                'selective_refresh' => array(
                    'activated' 			=> true,
                    'selector'  			=> '#landing-cities-title',
                    //'container_inclusive'	=>	false,
                ),
            )
        ),
        array(//Control options
            'controls'	=> array(
                'text'	=> array(
                    'input_type'    => 'text',
                ),
            ),
            'title'		    => __( 'Título', 'genosha-web' ),
        )
    );

    // =========================================================================
    // LANDING PROJECTOS
    // =========================================================================
	$customizer_api->add_section(
		'gen-proyects',
		array(
	        'title'     => 'Proyectos',
	        'priority'  => 1,
			'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'			=>	"#main-grid",
		)
	)
	->add_control(//Control creation
		'gen-proyects-posts',//id
		'RB_Customizer_Field_Control',//control class
		array(//Settings creation
			'gen-proyects-posts' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> '',
				),
			)
		),
		array(//Control options
			'controls'	=> array(
				'images'	=> array(
					'type'			=> 'RB_Post_Selector',
                    'query_args'    => array(
                        'post_type'     =>  'gen-project',
                    ),
                    'option_none'   => 'Ninguno',
				),
			),
			'title'		    => __( 'Proyectos destacados', 'genosha-web' ),
			'description'   => __( 'Proyectos a mostrar en la lading. La forma en la que se muestran se modifica en cada proyecto', 'genosha-web' ),
			'repeater'      => array(
				'collapsible'  => false,
			),
			'collapsible'   => true,
			//'collapsible_open'		=> true,
		)
	);

    // =========================================================================
    // REDES
    // =========================================================================
    $customizer_api->add_section(
        'gen-social',
        array(
            'title'     => 'Redes Sociales',
            'priority'  => 1,
        ),
        array(
            // 'activated' 		=> true,
            // 'selector'			=>	"#main-grid",
        )
    )
    ->add_control(//Control creation
        'gen-social-data',//id
        'RB_Customizer_Field_Control',//control class
        array(//Settings creation
            'gen-social-data' => array(
                'options' => array(
                    'transport' => 'postMessage',
                    'default'	=> '',
                ),
                'selective_refresh' => array(
                    'activated' 			=> true,
                    'selector'  			=> '#navbar-social-menu',
                    'container_inclusive'	=>	true,
                    'render_callback'       => function(){
                        get_template_part('parts/navbar', 'social');
                    },
                ),
            )
        ),
        array(//Control options
            'controls'	=> array(
                'name'	=> array(
                    'input_type'    => 'text',
                    'label'         => 'Nombre',
                ),
                'url'	=> array(
                    'input_type'    => 'text',
                    'label'         => 'Link',
                ),
                'fa'	=> array(
                    'type'      => 'RB_Fontawesome_Control',
                    'label'     => 'Icono',
                ),
            ),
            'title'		    => __( 'Título', 'genosha-web' ),
            'repeater'      => array(
                'collapsible'   => true,
                'accordion'     => true,
            ),
            'inputs_title'			=> "Red Social",
            'dinamic_label'			=> 'name',
        )
    );
}

// =============================================================================
// REGISTER
// =============================================================================
$customizer_api = new RB_Customizer_API($wp_customize, 'customizer_api_configuration');
$customizer_api->initialize();
