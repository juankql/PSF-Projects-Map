<?php

/**
 * Check if Visual composer class is exist
 */
if(class_exists('Vc_Manager')) {

/**
 * Function for Adding Title Component on vc_init hook
 * @param void
 * @return void
 */
function vcas_cupids_events() {
    // Title
    vc_map(
        array(
            'name' => __( 'Plugin Name' ),
            'base' => 'cupids-events',
            'icon' =>  'cupids-events',
            'category' => __( 'PW Widgets' ),

            'params' => array(
                
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Columns' ),
                    'param_name' => 'columns',
                    'value' => array(
                        '1' => 1,
                        '2' => 2,
                    ),
                    'description' => __( 'Display description on 1 or 2 columns' ),
                ),

                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => '',
                    'heading' => __( 'Thumbnails grid' ),
                    'param_name' => 'thumbnails',
                    'value' => array(
                        'none' => 'none',
                        '3 Columns' => 'col-sm-4',
                        '4 Columns' => 'col-sm-3',
                        '6 Columns' => 'col-sm-2'
                    ),
                    'description' => __( 'Display thumbnails grid' ),
                ),

                array(
                    'type'=> 'colorpicker',
                    'holder'=> 'div',
                    'class'=> '',
                    'heading'=> __('Avatar Background'),
                    'param_name'=> 'avatar_bg',
                    'description'=> __( 'Set background color for the avatar' ),
                    'admin_label'=> false
                ),

                array(
                    'type'=> 'colorpicker',
                    'holder'=> 'div',
                    'class'=> '',
                    'heading'=> __('Name text color'),
                    'param_name'=> 'name_color',
                    'description'=> __( 'Set font color for team name' ),
                    'admin_label'=> false
                ),

                array(
                    'type'=> 'colorpicker',
                    'holder'=> 'div',
                    'class'=> '',
                    'heading'=> __('Description text color'),
                    'param_name'=> 'details_color',
                    'description'=> __( 'Set font color for team description' ),
                    'admin_label'=> false
                ),

                array(
                    'type'=> 'colorpicker',
                    'holder'=> 'div',
                    'class'=> '',
                    'heading'=> __('Active thumbnail border'),
                    'param_name'=> 'thumbnail_border',
                    'description'=> __( 'Set border color for active thumbnail' ),
                    'admin_label'=> false
                ),

                array(
                    'type'=> 'dropdown',
                    'holder'=> 'div',
                    'class'=> '',
                    'heading'=> __('Text align'),
                    'param_name'=> 'align',
                    'admin_label'=> false,
                    'value' => array(
                        'Left' => 'pw-txt-left',
                        'Right' => 'pw-txt-right',
                        'Center' => 'pw-txt-center',
                        'Justify' => 'pw-txt-justify'
                    )
                ),
            )
        )
    );
}
add_action( 'vc_before_init', 'vcas_cupids_events' );



}