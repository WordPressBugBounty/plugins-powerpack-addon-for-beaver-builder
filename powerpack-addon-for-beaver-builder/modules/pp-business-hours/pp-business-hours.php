<?php

/**
 * @class PPBusinessHoursModule
 */
class PPBusinessHoursModule extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('Business Hours', 'bb-powerpack'),
            'description'   => __('A module to display business hours.', 'bb-powerpack'),
            'group'         => pp_get_modules_group(),
            'category'		=> pp_get_modules_cat( 'content' ),
            'dir'           => BB_POWERPACK_DIR . 'modules/pp-business-hours/',
            'url'           => BB_POWERPACK_URL . 'modules/pp-business-hours/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
			'partial_refresh'	=> true,
        ));
	}
	
	public function filter_settings( $settings, $helper )
	{
		// Handle title's old typography fields.
		$settings = PP_Module_Fields::handle_typography_field( $settings, array(
			'title_font'	=> array(
				'type'			=> 'font'
			),
			'title_custom_font_size'	=> array(
				'type'			=> 'font_size',
				'condition'		=> ( isset( $settings->title_font_size ) && 'custom' == $settings->title_font_size )
			),
			'title_custom_line_height'	=> array(
				'type'			=> 'line_height',
				'condition'		=> ( isset( $settings->title_line_height ) && 'custom'	== $settings->title_line_height )
			),
			'title_text_transform'	=> array(
				'type'			=> 'text_transform',
				'condition'		=> ( isset( $settings->title_text_transform ) && 'default' != $settings->title_text_transform )
			)
		), 'title_typography' );

		// Handle timing's old typography fields.
		$settings = PP_Module_Fields::handle_typography_field( $settings, array(
			'timing_font'	=> array(
				'type'			=> 'font'
			),
			'timing_custom_font_size'	=> array(
				'type'			=> 'font_size',
				'condition'		=> ( isset( $settings->timing_font_size ) && 'custom' == $settings->timing_font_size )
			),
			'timing_custom_line_height'	=> array(
				'type'			=> 'line_height',
				'condition'		=> ( isset( $settings->timing_line_height ) && 'custom' == $settings->timing_line_height )
			),
			'timing_text_transform'	=> array(
				'type'			=> 'text_transform',
				'condition'		=> ( isset( $settings->timing_text_transform ) && 'default' != $settings->timing_text_transform )
			)
		), 'timing_typography' );

		// Handle old border and shadow fields.
		$settings = PP_Module_Fields::handle_border_field( $settings, array(
			'box_border'		=> array(
				'type'				=> 'style'
			),
			'box_border_width'	=> array(
				'type'				=> 'width'
			),
			'box_border_color'	=> array(
				'type'				=> 'color'
			),
			'box_shadow'		=> array(
				'type'				=> 'shadow',
				'condition'			=> ( isset( $settings->box_shadow_display ) && 'yes' == $settings->box_shadow_display )
			),
			'box_shadow_color'	=> array(
				'type'				=> 'shadow_color',
				'condition'			=> ( isset( $settings->box_shadow_display ) && 'yes' == $settings->box_shadow_display ),
				'opacity'			=> isset( $settings->box_shadow_opacity ) ? $settings->box_shadow_opacity : 1
			),
			'box_border_radius'	=> array(
				'type'				=> 'radius'
			)
		), 'box_border_setting' );
		
		return $settings;
	}

	public static function get_translation_fields() {
		$days = pp_long_day_format();
		$field_keys = array(
			'str_sunday'    => $days['Sunday'],
			'str_monday'    => $days['Monday'],
			'str_tuesday'   => $days['Tuesday'],
			'str_wednesday' => $days['Wednesday'],
			'str_thursday'  => $days['Thursday'],
			'str_friday'    => $days['Friday'],
			'str_saturday'  => $days['Saturday'],
		);

		$fields = array();

		foreach ( $field_keys as $field_key => $field_label ) {
			$fields[ $field_key ] = array(
				'type' => 'text',
				'label' => $field_label,
				'placeholder' => $field_label,
			);
		}

		return $fields;
	}

	public function get_day_translation( $day, $format ) {
		$day_lower = strtolower( $day );
		$key = "str_$day_lower";

		if ( isset( $this->settings->{ $key } ) && ! empty( $this->settings->{ $key } ) ) {
			return $this->settings->{ $key };
		}

		if ( 'short' === $format ) {
			return pp_short_day_format( $day ) . '.';
		}

		return pp_long_day_format( $day );
	}

	public function get_timing( $value ) {
		$hours = null;

		if ( is_object( $value ) ) {
			$hours = $value->hours . ':' . $value->minutes . ' ' . $value->day_period;
		}
		if ( is_array( $value ) ) {
			$hours = $value['hours'] . ':' . $value['minutes'] . '&nbsp;' . $value['day_period'];
		}

		if ( isset( $this->settings->hours_24_format ) && 'yes' === $this->settings->hours_24_format ) {
			$hours = date( "G:i", strtotime( $hours ) );
		} else {
			$hours = date( "g:i A", strtotime( $hours ) );
		}

		return $hours;
	}

	public function render_time_title( $timing ) {
		$title = $this->get_day_translation( $timing->title, $timing->day_format );

		if ( $timing->hours_type == 'range' ) {
			$title = $this->get_day_translation( $timing->start_day, $timing->day_format );
			$title .= ' - ';
			$title .= $this->get_day_translation( $timing->end_day, $timing->day_format );
		}

		if ( $timing->hours_type == 'day' ) { ?>
			<link itemprop="dayOfWeek" href="http://schema.org/<?php echo $timing->title; ?>" /><?php echo $title; ?>
		<?php } else { ?>
			<?php echo $title; ?>
		<?php }
	}
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('PPBusinessHoursModule', array(
    'general'       => array( // Tab
        'title'         => __('General', 'bb-powerpack'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'         => '', // Section Title
                'fields'        => array( // Section Fields
                    'business_hours_rows'     => array(
                        'type'          => 'form',
                        'label'         => __( 'Timing', 'bb-powerpack' ),
                        'form'          => 'bh_settings_form', // ID from registered form below
                        'preview_text'  => 'title', // Name of a field to use for the preview text
						'multiple'		=> true,
                    ),
                )
            )
        )
    ),
	'style'	=> array(
		'title'	=> __( 'Style', 'bb-powerpack' ),
		'sections'	=> array(
			'general_style' => array(
				'title' => '',
				'fields' => array(
					'hours_24_format'    => array(
						'type'          => 'pp-switch',
						'label'         => __( '24-hour Format', 'bb-powerpack' ),
						'default'       => 'no',
					),
				),
			),
			'layout'	=> array(
				'title'	=> __( 'Timing', 'bb-powerpack' ),
				'fields'	=> array(
                    'spacing'   => array(
                        'type'      => 'unit',
                        'label'     => __('Spacing', 'bb-powerpack'),
                        'default'   => 10,
                        'units'      => array('px'),
                        'slider'   => true,
                        'preview'   => array(
                            'type'      => 'css',
                            'rules'     => array(
                                array(
                                    'selector'  => '.pp-business-hours-content .pp-bh-row',
                                    'property'  => 'padding-top',
                                    'unit'      => 'px'
                                ),
                                array(
                                    'selector'  => '.pp-business-hours-content .pp-bh-row',
                                    'property'  => 'padding-bottom',
                                    'unit'      => 'px'
                                ),
                            )
                        )
                    ),
					'zebra_pattern'   => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Striped Effect', 'bb-powerpack'),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'           => __('Yes', 'bb-powerpack'),
                            'no'            => __('No', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'yes'	=> array(
								'fields'	=> array('row_bg_color_1', 'row_bg_color_2', 'title_color_2', 'timing_color_2')
							)
						)
                    ),
					'row_bg_color_1'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Background Color 1', 'bb-powerpack' ),
						'show_reset'		=> true,
						'show_alpha'		=> true,
						'connections'		=> array('color'),
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-business-hours-content .pp-bh-row:nth-of-type(odd):not(.pp-highlight-row)',
							'property'			=> 'background-color',
						)
					),
					'row_bg_color_2'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Background Color 2', 'bb-powerpack' ),
						'show_reset'		=> true,
						'show_alpha'		=> true,
						'connections'		=> array('color'),
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-business-hours-content .pp-bh-row:nth-of-type(even):not(.pp-highlight-row)',
							'property'			=> 'background-color',
						)
					),
					'separator'   => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Separator', 'bb-powerpack'),
                        'default'       => 'no',
                        'options'       => array(
                            'yes'      => __('Yes', 'bb-powerpack'),
                            'no'      => __('No', 'bb-powerpack'),
                        ),
						'toggle'	=> array(
							'yes'	=> array(
								'fields'	=> array('separator_style', 'separator_width', 'separator_color')
							)
						)
                    ),
					'separator_style'   => array(
                        'type'          => 'pp-switch',
                        'label'         => __('Separator Style', 'bb-powerpack'),
                        'default'       => 'solid',
                        'options'       => array(
                            'solid'      => __('Solid', 'bb-powerpack'),
                            'dashed'      => __('Dashed', 'bb-powerpack'),
                            'dotted'      => __('Dotted', 'bb-powerpack'),
                        ),
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-business-hours-content .pp-bh-row',
							'property'			=> 'border-bottom-style',
						)
                    ),
					'separator_width'       => array(
						'type'          => 'text',
						'label'         => __( 'Separator Width', 'bb-powerpack' ),
						'description'	=> 'px',
						'default'       => 1,
						'size'			=> 5,
						'maxlength'		=> 10,
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-business-hours-content .pp-bh-row',
							'property'			=> 'border-bottom-width',
							'unit'				=> 'px'
						)
					),
					'separator_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Separator Color', 'bb-powerpack' ),
						'show_reset'		=> true,
						'connections'		=> array('color'),
						'preview'              => array(
							'type'				=> 'css',
							'selector'			=> '.pp-business-hours-content .pp-bh-row',
							'property'			=> 'border-bottom-color',
						)
					),
				)
			),
			'box'	=> array(
				'title'	=> __( 'Box', 'bb-powerpack' ),
				'fields'	=> array(
					'box_bg_color'      => array(
						'type'      		=> 'color',
						'label'     		=> __('Background Color', 'bb-powerpack'),
						'default'			=> 'f5f5f5',
						'show_reset'   		=> true,
						'show_alpha'   		=> true,
						'connections'		=> array('color'),
						'preview'           => array(
							'type'				=> 'css',
							'selector'			=> '.pp-business-hours-content',
							'property'			=> 'background-color',
						)
					),
					'box_border_setting'	=> array(
						'type'					=> 'border',
						'label'					=> __('Border', 'bb-powerpack'),
						'preview'				=> array(
							'type'					=> 'css',
							'selector'				=> '.pp-business-hours-content',
							'important'				=> true
						)
					),
				)
			)
		)
	),
	'typography'	=> array(
		'title'	=> __( 'Typography', 'bb-powerpack' ),
		'sections'	=> array(
			'day_typography'	=> array(
				'title'	=> __( 'Day', 'bb-powerpack' ),
				'fields'	=> array(
					'title_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Color', 'bb-powerpack' ),
						'show_reset'		=> true,
						'connections'		=> array('color'),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-business-hours-content .pp-bh-row .pp-bh-title',
							'property'	=> 'color'
						)
					),
					'title_color_2'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Color 2 (stripped effect enabled)', 'bb-powerpack' ),
						'show_reset'		=> true,
						'connections'		=> array('color'),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-business-hours-content .pp-bh-row:nth-of-type(even) .pp-bh-title',
							'property'	=> 'color'
						)
					),
					'title_typography'	=> array(
						'type'			=> 'typography',
						'label'			=> __('Typography', 'bb-powerpack'),
						'responsive'  	=> true,
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-business-hours-content .pp-bh-row .pp-bh-title',
						),
					),
				)
			),
			'timing_typography'	=> array(
				'title'	=> __( 'Timing', 'bb-powerpack' ),
				'fields'	=> array(
					'timing_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Color', 'bb-powerpack' ),
						'show_reset'		=> true,
						'connections'		=> array('color'),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-business-hours-content .pp-bh-row .pp-bh-timing',
							'property'	=> 'color'
						)
					),
					'timing_color_2'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Color 2 (stripped effect enabled)', 'bb-powerpack' ),
						'show_reset'		=> true,
						'connections'		=> array('color'),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-business-hours-content .pp-bh-row:nth-of-type(even) .pp-bh-timing',
							'property'	=> 'color'
						)
					),
					'status_color'  => array(
						'type'          => 'color',
						'default'       => '',
						'label'         => __( 'Status Text Color', 'bb-powerpack' ),
						'show_reset'		=> true,
						'connections'		=> array('color'),
						'preview'	=> array(
							'type'		=> 'css',
							'selector'	=> '.pp-business-hours-content .pp-bh-row.pp-closed .pp-bh-timing',
							'property'	=> 'color'
						)
					),
					'timing_typography'	=> array(
						'type'			=> 'typography',
						'label'			=> __('Typography', 'bb-powerpack'),
						'responsive'  	=> true,
						'preview'		=> array(
							'type'			=> 'css',
							'selector'		=> '.pp-business-hours-content .pp-bh-row .pp-bh-timing',
						),
					),
				)
			)
		)
	),
	'translations' => array(
		'title' => __( 'Translations', 'bb-powerpack' ),
		'sections' => array(
			'translations' => array(
				'title' => '',
				'fields' => PPBusinessHoursModule::get_translation_fields(),
			),
		),
	),
));

/**
 * Register a settings form to use in the "form" field type above.
 */
FLBuilder::register_settings_form('bh_settings_form', array(
    'title' => __('Timing Settings', 'bb-powerpack'),
    'tabs'  => array(
        'general'      => array( // Tab
            'title'         => __('General', 'bb-powerpack'), // Tab title
            'sections'      => array( // Tab Sections
                'general'       => array( // Section
                    'title'         => '', // Section Title
                    'fields'        => array( // Section Fields
						'highlight'   => array(
	                        'type'          => 'pp-switch',
	                        'label'         => __('Highlight this', 'bb-powerpack'),
	                        'default'       => 'no',
	                        'options'       => array(
	                            'yes'      => __('Yes', 'bb-powerpack'),
	                            'no'      => __('No', 'bb-powerpack'),
	                        ),
							'toggle'	=> array(
								'yes'	=> array(
									'tabs'	=> array('higlight_row_style')
								)
							)
						),
						'hours_type'	=> array(
							'type'			=> 'pp-switch',
							'label'			=> __('Type', 'bb-powerpack'),
							'default'		=> 'day',
							'options'		=> array(
								'day'			=> __('Day', 'bb-powerpack'),
								'range'			=> __('Range', 'bb-powerpack')
							),
							'toggle'		=> array(
								'day'			=> array(
									'fields'		=> array('title')
								),
								'range'			=> array(
									'fields'		=> array('start_day', 'end_day')
								)
							)
						),
                        'title'       => array(
                            'type'          => 'select',
                            'label'         => __( 'Day', 'bb-powerpack' ),
                            'default'       => 'Monday',
                            'options'       => pp_long_day_format()
						),
						'start_day'	=> array(
							'type'          => 'select',
                            'label'         => __( 'Start Day', 'bb-powerpack' ),
                            'default'       => 'Monday',
                            'options'       => pp_long_day_format()
						),
						'end_day'	=> array(
							'type'          => 'select',
                            'label'         => __( 'End Day', 'bb-powerpack' ),
                            'default'       => 'Saturday',
                            'options'       => pp_long_day_format()
						),
                        'day_format'    => array(
                            'type'          => 'pp-switch',
                            'label'         => __( 'Day Format', 'bb-powerpack' ),
                            'default'       => 'long',
                            'options'       => array(
                                'long'          => __('Long', 'bb-powerpack'),
                                'short'         => __('Short', 'bb-powerpack'),
                            )
                        ),
						'status'   => array(
	                        'type'          => 'pp-switch',
	                        'label'         => __('Status', 'bb-powerpack'),
	                        'default'       => 'open',
	                        'options'       => array(
	                            'open'      => __('Open', 'bb-powerpack'),
	                            'close'      => __('Close', 'bb-powerpack'),
	                        ),
							'toggle'	=> array(
								'open'	=> array(
									'fields'	=> array( 'start_time', 'end_time')
								),
								'close'	=> array(
									'fields'	=> array('status_text', 'hl_status_color')
								)
							)
	                    ),
						'start_time' => array(
							'type'       => 'time',
							'label'      => __( 'Start Time', 'bb-powerpack' ),
							'default'		=>array(
								'hours'			=> '01',
								'minutes'		=> '00',
								'day_period'	=> __('am', 'bb-powerpack')
							)
						),
						'end_time' => array(
							'type'       => 'time',
							'label'      => __( 'End Time', 'bb-powerpack' ),
							'default'		=>array(
								'hours'			=> '01',
								'minutes'		=> '00',
								'day_period'	=> __('am', 'bb-powerpack')
							)
						),
						'status_text'       => array(
                            'type'          => 'text',
                            'label'         => __( 'Status Text', 'bb-powerpack' ),
                            'default'       => __( 'Closed', 'bb-powerpack' )
                        ),
                    )
                )
            )
        ),
		'higlight_row_style'	=> array(
			'title'	=> __( 'Style', 'bb-powerpack' ),
			'sections'	=> array(
				'general'	=> array(
					'title'	=> '',
					'fields'	=> array(
						'hl_row_bg_color'  => array(
							'type'          => 'color',
							'default'       => '',
							'label'         => __( 'Background Color', 'bb-powerpack' ),
							'show_reset'		=> true,
							'show_alpha'		=> true,
						),
						'hl_title_color'  => array(
							'type'          => 'color',
							'default'       => '',
							'label'         => __( 'Day Color', 'bb-powerpack' ),
							'show_reset'		=> true,
						),
						'hl_timing_color'  => array(
							'type'          => 'color',
							'default'       => '',
							'label'         => __( 'Timing Color', 'bb-powerpack' ),
							'show_reset'		=> true,
						),
						'hl_status_color'  => array(
							'type'          => 'color',
							'default'       => '',
							'label'         => __( 'Status Color', 'bb-powerpack' ),
							'show_reset'		=> true,
						),
					)
				)
			)
		)
    )
));
