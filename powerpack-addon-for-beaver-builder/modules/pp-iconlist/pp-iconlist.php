<?php

/**
 * @class PPIconListModule
 */
class PPIconListModule extends FLBuilderModule {

    /**
     * Constructor function for the module.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Icon / Number List', 'bb-powerpack'),
            'description'   => __('Addon to display icon/number list.', 'bb-powerpack'),
            'group'         => pp_get_modules_group(),
            'category'		=> pp_get_modules_cat( 'content' ),
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-iconlist/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-iconlist/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh'   => true,
        ));
    }

	public function enqueue_icon_styles() {
		$enqueue = false;
		$settings = $this->settings;

		if ( isset( $settings->list_type ) && 'icon' === $settings->list_type && ! empty( $settings->list_icon ) ) {
			$enqueue = true;
		}

		if ( $enqueue && is_callable( 'parent::enqueue_icon_styles' ) ) {
			parent::enqueue_icon_styles();
		}
	}

	public function filter_settings( $settings, $helper )
	{
		// Handle text's old typography fields.
		$settings = PP_Module_Fields::handle_typography_field( $settings, array(
			'text_font'	=> array(
				'type'			=> 'font'
			),
			'text_size'	=> array(
				'type'			=> 'font_size',
			),
			'text_line_height'	=> array(
				'type'			=> 'line_height',
			),
		), 'text_typography' );

		// Handle old icon border and radius fields.
		$settings = PP_Module_Fields::handle_border_field( $settings, array(
			'icon_border_type'	=> array(
				'type'				=> 'style'
			),
			'icon_border_width'	=> array(
				'type'				=> 'width'
			),
			'icon_border_color'	=> array(
				'type'				=> 'color'
			),
			'icon_border_radius'	=> array(
				'type'				=> 'radius'
			),
		), 'icon_border' );

		return $settings;
	}

}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPIconListModule', array(
    'general'   => array(
        'title'     => __('General', 'bb-powerpack'),
        'sections'  => array(
            'general'   => array(
                'title'     => '',
                'fields'    => array(
                    'list_type' => array(
                        'type'      => 'pp-switch',
                        'label'     => __('List Type', 'bb-powerpack'),
                        'default'   => 'icon',
                        'options'   => array(
                            'icon'      => __('Icon', 'bb-powerpack'),
                            'number'    => __('Number', 'bb-powerpack')
                        ),
                        'toggle'    => array(
                            'icon'      => array(
                                'fields'    => array('list_icon'),
                            )
                        )
                    ),
                    'list_icon' => array(
                        'type'      => 'icon',
                        'label'     => __('Choose Icon', 'bb-powerpack')
                    ),
                )
            ),
            'list_items'    => array(
                'title'         => __('List Items', 'bb-powerpack'),
                'fields'        => array(
                    'list_items'    => array(
                        'type'          => 'text',
                        'label'         => __('Item', 'bb-powerpack'),
                        'default'       => '',
                        'multiple'      => true
                    )
                )
            )
        )
    ),
    'style' => array(
        'title' => __('Style', 'bb-powerpack'),
        'sections'  => array(
            'general'   => array(
                'title'     => __('General', 'bb-powerpack'),
                'fields'    => array(
                    'item_margin'   => array(
                        'type'          => 'unit',
                        'label'         => __('Space b/w each item', 'bb-powerpack'),
                        'default'       => 20,
						'units'			=> array( 'px' ),
						'slider'		=> true,	
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'margin-bottom',
                            'selector'      => '.pp-icon-list .pp-icon-list-items .pp-icon-list-item',
                            'unit'          => 'px'
                        )
                    ),
                    'icon_space'    => array(
                        'type'          => 'unit',
                        'label'         => __('Space b/w Icon and Text', 'bb-powerpack'),
                        'default'       => 10,
                       	'units'			=> array( 'px' ),
						'slider'		=> true,	
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'margin-right',
                            'selector'      => '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-icon',
                            'unit'          => 'px'
                        )
                    ),
                )
            ),
            'icon_style'    => array(
                'title'         => __('Icon', 'bb-powerpack'),
                'fields'        => array(
                    'icon_bg'       => array(
                        'type'          => 'color',
                        'label'         => __('Background Color', 'bb-powerpack'),
                        'default'       => '',
                        'show_reset'    => true,
						'show_alpha'	=> true,
						'connections'	=> array('color'),
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'background-color',
                            'selector'      => '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-icon',
                        )
                    ),
                    'icon_bg_hover' => array(
                        'type'          => 'color',
                        'label'         => __('Background Hover Color', 'bb-powerpack'),
                        'default'       => '',
                        'show_reset'    => true,
						'show_alpha'	=> true,
						'connections'	=> array('color'),
                    ),
                    'icon_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
						'default'       => '444444',
						'show_reset'	=> true,
						'connections'	=> array('color'),
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'color',
                            'selector'      => '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-icon',
                        )
                    ),
                    'icon_color_hover'  => array(
                        'type'              => 'color',
                        'label'             => __('Hover Color', 'bb-powerpack'),
						'default'           => '111111',
						'show_reset'		=> true,
						'connections'		=> array('color'),
                    ),
                    'field_separator_0' => array(
                        'type'              => 'pp-separator',
                        'color'             => 'eeeeee'
                    ),
                    'icon_border'	=> array(
						'type'          => 'border',
						'label'         => __( 'Border', 'bb-powerpack' ),
						'responsive'	=> true,
						'preview'   	=> array(
                            'type'  		=> 'css',
                            'selector'  	=> '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-icon',
                            'property'  	=> 'border',
                        ),
					),
                    'icon_border_color_hover'   => array(
                        'type'                      => 'color',
                        'label'                     => __('Border Hover Color', 'bb-powerpack'),
						'default'                   => '',
						'show_reset'				=> true,
						'connections'				=> array('color'),
                    ),
                    'field_separator_1' => array(
                        'type'              => 'pp-separator',
                        'color'             => 'eeeeee'
                    ),
                    'icon_size'     => array(
                        'type'          => 'unit',
                        'label'         => __('Size', 'bb-powerpack'),
                        'default'       => 20,
                        'units'			=> array( 'px' ),
						'slider'		=> true,
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'font-size',
                            'selector'      => '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-icon',
                            'unit'          => 'px'
                        )
                    ),
                    'icon_padding'  => array(
                        'type'          => 'unit',
                        'label'         => __('Padding', 'bb-powerpack'),
                        'default'       => 0,
                        'units'			=> array( 'px' ),
						'slider'		=> true,
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'padding',
                            'selector'      => '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-icon',
                            'unit'          => 'px'
                        )
                    ),
                )
            ),
            'text_style'    => array(
                'title'         => __('Text', 'bb-powerpack'),
                'fields'        => array(
                    'text_typography'	=> array(
						'type'			=> 'typography',
						'label'			=> __('Typography', 'bb-powerpack'),
						'responsive'  	=> true,
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-text',
						),
					),
                    'text_color'    => array(
                        'type'          => 'color',
                        'label'         => __('Color', 'bb-powerpack'),
                        'default'       => '',
						'show_reset'    => true,
						'connections'	=> array('color'),
                        'preview'       => array(
                            'type'          => 'css',
                            'property'      => 'color',
                            'selector'      => '.pp-icon-list .pp-icon-list-items .pp-icon-list-item .pp-list-item-text'
                        )
                    )
                )
            )
        )
    )
));
