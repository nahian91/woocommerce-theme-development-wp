<?php
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    $opt_name = 'redux_demo';

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_title'           => esc_html__( 'Ekomart Options', 'your-textdomain-here' ),
        'customizer'           => false,
    );

    Redux::set_args( $opt_name, $args );

    Redux::set_section( 
        $opt_name, 
        array(
            'title'  => esc_html__( 'General', 'your-textdomain-here' ),
            'id'     => 'general',
            'icon'   => 'el el-home',
            'fields' => array(
                array(
                    'id'       => 'opt-text1',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Example Text', 'your-textdomain-here' ),
                    'desc'     => esc_html__( 'Example description.', 'your-textdomain-here' ),
                    'subtitle' => esc_html__( 'Example subtitle.', 'your-textdomain-here' ),
                    'hint'     => array(
                        'content' => 'This is a <b>hint</b> tool-tip for the text field.<br/><br/>Add any HTML based text you like here.',
                    )
                )
            )
        ) 
    );

    Redux::set_section( 
        $opt_name, 
        array(
            'title'  => esc_html__( 'Header', 'your-textdomain-here' ),
            'id'     => 'header',
            'icon'   => 'el el-home',
            'fields' => array(
                array(
                    'id'       => 'header-msg-1',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Header Top Message 1', 'your-textdomain-here' ),
                ),
                array(
                    'id'       => 'header-msg-2',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Header Top Message 2', 'your-textdomain-here' ),
                ),
                array(
                    'id'       => 'logo',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Logo', 'your-textdomain-here' ),
                )
            )
        ) 
    );

    Redux::set_section( 
        $opt_name, 
        array(
            'title'  => esc_html__( 'Footer', 'your-textdomain-here' ),
            'id'     => 'footer',
            'icon'   => 'el el-home',
            'fields' => array(
            array(
                'id'             => 'footer-top',
                'type'           => 'repeater',
                'title'          => esc_html__( 'Footer Top', 'your-textdomain-here' ),
                //'group_values' => true, // Group all fields below within the repeater ID
                //'item_name'    => '', // Add a repeater block name to the Add and Delete buttons
                //'bind_title'   => '', // Bind the repeater block title to this field ID
                //'static'       => 2, // Set the number of repeater blocks to be output
                //'limit'        => 2, // Limit the number of repeater blocks a user can create
                //'sortable'     => false, // Allow the users to sort the repeater blocks or not
                'fields'         => array(
                    array(
                        'id'          => 'footer-top-icon',
                        'type'        => 'icon_select',
                        'placeholder' => esc_html__( 'Select Icon', 'your-textdomain-here' ),

                        // Enable/disable auto-enqueue of stylesheet in the admin panel.
                        'enqueue'          => true,

                        // Enable/disable auto-enqueue of stylesheet on the front end.
                        'enqueue_frontend' => false,

                        // Stylesheet data.
                        'stylesheet'       => array(
                            array(
                                'url'    => 'https://icons.getbootstrap.com/assets/font/bootstrap-icons.min.css',
                                'title'  => 'Bootstrap',
                                'prefix' => 'bi',
                            ),
                        ),
                    ),
                    array(
                        'id'          => 'footer-top-title',
                        'type'        => 'text',
                    ),
                    array(
                        'id'          => 'footer-top-desc',
                        'type'        => 'textarea',
                    ),
                ),
            )
        )
    ) 
);
