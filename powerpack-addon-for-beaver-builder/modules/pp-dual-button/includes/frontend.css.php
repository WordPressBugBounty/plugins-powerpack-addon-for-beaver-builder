<?php
$spacing = $settings->button_spacing;
$spacing_medium = isset( $settings->button_spacing_medium ) ? $settings->button_spacing_medium : $spacing;
$spacing_responsive = isset( $settings->button_spacing_responsive ) ? $settings->button_spacing_responsive : $spacing_medium;

$custom_breakpoint = isset( $settings->responsive_breakpoint ) && ! empty( $settings->responsive_breakpoint ) ? $settings->responsive_breakpoint : 0;
?>

.fl-node-<?php echo $id; ?> .pp-spacer {
	float: left;
	height: 1px;
	width: <?php echo $spacing; ?>px;
}

<?php
// Button padding.
FLBuilderCSS::dimension_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_padding',
		'selector'     => ".fl-node-$id .pp-dual-button-content a.pp-button",
		'unit'         => 'px',
		'props'        => array(
			'padding-top'    => 'button_padding_top',
			'padding-right'  => 'button_padding_right',
			'padding-bottom' => 'button_padding_bottom',
			'padding-left'   => 'button_padding_left',
		),
	)
);

// Button Typography.
FLBuilderCSS::typography_field_rule(
	array(
		'settings'     => $settings,
		'setting_name' => 'button_typography',
		'selector'     => ".fl-node-$id .pp-dual-button-content a.pp-button",
	)
);

FLBuilderCSS::responsive_rule( array(
	'settings'     => $settings,
	'setting_name' => 'button_width',
	'selector'     => ".fl-node-$id .pp-dual-button-content a.pp-button",
	'prop'         => 'width',
	'unit'         => 'px'
) );
?>
.fl-node-<?php echo $id; ?> .pp-dual-button-content a.pp-button {
	<?php if ( $settings->button_border_width ) { ?>
		border-width: <?php echo $settings->button_border_width; ?>px;
	<?php } ?>
	<?php if ( $settings->button_border_style ) { ?>
		border-style:  <?php echo $settings->button_border_style; ?>;
	<?php } ?>
	<?php if ( $settings->button_border_radius ) { ?>
		border-radius: <?php echo $settings->button_border_radius; ?>px;
	<?php } ?>
	text-decoration: none;
	box-shadow: none;
	display: block;
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 a.pp-button {
	<?php if ( isset( $settings->button_1_bg_color_default ) && ! empty( $settings->button_1_bg_color_default ) ) { ?>
	background-color: <?php echo pp_get_color_value( $settings->button_1_bg_color_default ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_text_color_default ) && ! empty( $settings->button_1_text_color_default ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_1_text_color_default ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_border_color_default ) && ! empty( $settings->button_1_border_color_default ) ) { ?>
	border-color: <?php echo pp_get_color_value( $settings->button_1_border_color_default ); ?>;
	<?php } ?>
	position: relative;
	vertical-align: middle;
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 a.pp-button:hover {
	<?php if ( isset( $settings->button_1_bg_color_hover ) && ! empty( $settings->button_1_bg_color_hover ) ) { ?>
	background-color: <?php echo pp_get_color_value( $settings->button_1_bg_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_text_color_hover ) && ! empty( $settings->button_1_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_1_text_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_border_color_hover ) && ! empty( $settings->button_1_border_color_hover ) ) { ?>
	border-color: <?php echo pp_get_color_value( $settings->button_1_border_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 a.pp-button:hover span {
	<?php if ( isset( $settings->button_1_text_color_hover ) && ! empty( $settings->button_1_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_1_text_color_hover ); ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 a.pp-button {
	<?php if ( isset( $settings->button_2_bg_color_default ) && ! empty( $settings->button_2_bg_color_default ) ) { ?>
	background-color: <?php echo pp_get_color_value( $settings->button_2_bg_color_default ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_2_text_color_default ) && ! empty( $settings->button_2_text_color_default ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_2_text_color_default ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_2_border_color_default ) && ! empty( $settings->button_2_border_color_default ) ) { ?>
	border-color: <?php echo pp_get_color_value( $settings->button_2_border_color_default ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 a.pp-button:hover {
	<?php if ( isset( $settings->button_2_bg_color_hover ) && ! empty( $settings->button_2_bg_color_hover ) ) { ?>
	background-color: <?php echo pp_get_color_value( $settings->button_2_bg_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_2_text_color_hover ) && ! empty( $settings->button_2_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_2_text_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_2_border_color_hover ) && ! empty( $settings->button_2_border_color_hover ) ) { ?>
	border-color: <?php echo pp_get_color_value( $settings->button_2_border_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 a.pp-button:hover span {
	<?php if ( isset( $settings->button_2_text_color_hover ) && ! empty( $settings->button_2_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_2_text_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content a.pp-button .pp-font-icon {
	margin-left: 5px;
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 .pp-font-icon {
	<?php if ( $settings->button_1_font_icon_size ) { ?>
		font-size: <?php echo $settings->button_1_font_icon_size; ?>px;
	<?php } ?>
	<?php if ( isset( $settings->button_1_text_color_default ) && ! empty( $settings->button_1_text_color_default ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_1_text_color_default ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 a.pp-button:hover .pp-font-icon {
	<?php if ( isset( $settings->button_1_text_color_hover ) && ! empty( $settings->button_1_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_1_text_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 .custom_icon {
	<?php if ( $settings->button_1_custom_icon_width ) { ?>
		width:<?php echo $settings->button_1_custom_icon_width; ?>px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 .pp-font-icon {
	<?php if ( $settings->button_2_font_icon_size ) { ?>
		font-size: <?php echo $settings->button_2_font_icon_size; ?>px;
	<?php } ?>
	<?php if ( isset( $settings->button_2_text_color_default ) && ! empty( $settings->button_2_text_color_default ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_2_text_color_default ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 a.pp-button:hover .pp-font-icon {
	<?php if ( isset( $settings->button_2_text_color_hover ) && ! empty( $settings->button_2_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_2_text_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 .custom_icon {
	<?php if ( $settings->button_2_custom_icon_width ) { ?>
		width:<?php echo $settings->button_2_custom_icon_width; ?>px;
	<?php } ?>
}
<?php if ( 'center' === $settings->button_alignment || 'none' === $settings->button_alignment ) { ?>
	.fl-node-<?php echo $id; ?> .pp-dual-button-content {
		text-align: center;
	}
<?php } ?>
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-inner {
	display: inline-block;
	float: <?php echo ( 'center' === $settings->button_alignment ) ? 'none' : $settings->button_alignment; ?>;
}

.fl-node-<?php echo $id; ?> .pp-dual-button-1 .pp-custom-icon {
	<?php if ( $settings->button_1_custom_icon_width ) { ?>
		width: <?php echo $settings->button_1_custom_icon_width; ?>px;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-2 .pp-custom-icon {
	<?php if ( $settings->button_2_custom_icon_width ) { ?>
		width: <?php echo $settings->button_2_custom_icon_width; ?>px;
	<?php } ?>
}

<?php // Button Hover Effects ?>
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1 .pp-button:before {
	<?php if ( $settings->button_1_effect_duration >= 0 ) { ?>
		transition-duration: <?php echo $settings->button_1_effect_duration; ?>ms;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2 .pp-button:before {
	<?php if ( $settings->button_2_effect_duration >= 0 ) { ?>
		transition-duration: <?php echo $settings->button_2_effect_duration; ?>ms;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-sweep_right .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-sweep_left .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-sweep_bottom .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-sweep_top .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-bounce_right .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-bounce_left .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-bounce_bottom .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-bounce_top .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-radial_out .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-radial_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-rectangle_out .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-rectangle_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_in_horizontal .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_out_horizontal .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_in_vertical .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_out_vertical .pp-button:before {
	<?php if ( isset( $settings->button_1_bg_color_hover ) ) { ?>
	background: <?php echo pp_get_color_value( $settings->button_1_bg_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_1_text_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_border_color_hover ) && ! empty( $settings->button_1_border_color_hover ) ) { ?>
	border-color: <?php echo pp_get_color_value( $settings->button_1_border_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-sweep_right .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-sweep_left .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-sweep_bottom .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-sweep_top .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-bounce_right .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-bounce_left .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-bounce_bottom .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-bounce_top .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-radial_out .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-radial_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-rectangle_out .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-rectangle_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_in_horizontal .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_out_horizontal .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_in_vertical .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_out_vertical .pp-button:before {
	<?php if ( isset( $settings->button_2_bg_color_hover ) ) { ?>
	background: <?php echo pp_get_color_value( $settings->button_2_bg_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_2_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_2_text_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_2_border_color_hover ) && ! empty( $settings->button_2_border_color_hover ) ) { ?>
	border-color: <?php echo pp_get_color_value( $settings->button_2_border_color_hover ); ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-radial_in .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-rectangle_in .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_in_horizontal .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_in_vertical .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_in_diagonal .pp-button {
	<?php if ( isset( $settings->button_1_bg_color_hover ) ) { ?>
	background: <?php echo pp_get_color_value( $settings->button_1_bg_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-radial_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-rectangle_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_in_horizontal .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_in_vertical .pp-button:before {
	<?php if ( isset( $settings->button_1_bg_color_default ) ) { ?>
	background: <?php echo pp_get_color_value( $settings->button_1_bg_color_default ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-radial_in .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-rectangle_in .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_in_horizontal .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_in_vertical .pp-button,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_in_diagonal .pp-button {
	<?php if ( isset( $settings->button_2_bg_color_hover ) ) { ?>
	background: <?php echo pp_get_color_value( $settings->button_2_bg_color_hover ); ?>;
	<?php } ?>
}
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-radial_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-rectangle_in .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_in_horizontal .pp-button:before,
.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-2.pp-button-effect-shutter_in_vertical .pp-button:before {
	<?php if ( isset( $settings->button_2_bg_color_default ) ) { ?>
	background: <?php echo pp_get_color_value( $settings->button_2_bg_color_default ); ?>;
	<?php } ?>
}

.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-1.pp-button-effect-shutter_out_diagonal .pp-button:after {
	<?php if ( isset( $settings->button_1_bg_color_hover ) && ! empty( $settings->button_1_bg_color_hover ) ) { ?>
	background: <?php echo pp_get_color_value( $settings->button_1_bg_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_text_color_hover ) && ! empty( $settings->button_1_text_color_hover ) ) { ?>
	color: <?php echo pp_get_color_value( $settings->button_1_text_color_hover ); ?>;
	<?php } ?>
	<?php if ( isset( $settings->button_1_border_color_hover ) && ! empty( $settings->button_1_border_color_hover ) ) { ?>
	border-color: <?php echo pp_get_color_value( $settings->button_1_border_color_hover ); ?>;
	<?php } ?>
	<?php if ( $settings->button_1_effect_duration >= 0 ) { ?>
		transition-duration: <?php echo $settings->button_1_effect_duration; ?>ms;
	<?php } ?>
}

@media only screen and ( max-width: <?php echo $global_settings->medium_breakpoint; ?>px ) {
	<?php if ( isset( $settings->button_alignment_medium ) && ! empty( $settings->button_alignment_medium ) ) { ?>
		<?php if ( 'center' === $settings->button_alignment_medium || 'none' === $settings->button_alignment_medium ) { ?>
			.fl-node-<?php echo $id; ?> .pp-dual-button-content {
				text-align: center;
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-inner {
			float: <?php echo ( 'center' === $settings->button_alignment_medium ) ? 'none' : $settings->button_alignment_medium; ?>;
			text-align: center;
		}
	<?php } ?>
	.fl-node-<?php echo $id; ?> .pp-spacer {
		width: <?php echo '' === $spacing_medium ? 10 : $spacing_medium; ?>px;
		<?php if ( $custom_breakpoint === $global_settings->medium_breakpoint ) { ?>
			height: <?php echo '' === $spacing_medium ? 10 : $spacing_medium; ?>px;
		<?php } ?>
	}
}

@media only screen and ( max-width: <?php echo $global_settings->responsive_breakpoint; ?>px ) {
	<?php if ( isset( $settings->button_alignment_responsive ) && ! empty( $settings->button_alignment_responsive ) ) { ?>
		<?php if ( 'center' === $settings->button_alignment_responsive || 'none' === $settings->button_alignment_responsive ) { ?>
			.fl-node-<?php echo $id; ?> .pp-dual-button-content {
				text-align: center;
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-inner {
			float: <?php echo ( 'center' === $settings->button_alignment_responsive ) ? 'none' : $settings->button_alignment_responsive; ?>;
			text-align: center;
		}
	<?php } ?>
	.fl-node-<?php echo $id; ?> .pp-spacer {
		width: <?php echo '' === $spacing_responsive ? 10 : $spacing_responsive; ?>px;
	}
}

@media only screen and ( max-width: <?php echo $custom_breakpoint; ?>px ) {
	.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-inner {
		float: none;
		text-align: center;
	}
	.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button,
	.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button .pp-button {
		display: block;
		float: none;
		margin: 0 auto;
		max-width: 100%;
	}
	.fl-node-<?php echo $id; ?> .pp-spacer {
		float: none;
		height: <?php echo '' === $spacing_responsive ? 10 : $spacing_responsive; ?>px;
	}
	<?php if ( isset( $settings->button_alignment_responsive ) && ! empty( $settings->button_alignment_responsive ) ) { ?>
		<?php if ( 'center' === $settings->button_alignment_responsive || 'none' === $settings->button_alignment_responsive ) { ?>
			.fl-node-<?php echo $id; ?> .pp-dual-button-content {
				text-align: center;
			}
		<?php } ?>
		.fl-node-<?php echo $id; ?> .pp-dual-button-content .pp-dual-button-inner {
			display: inline-block;
			float: <?php echo ( 'center' === $settings->button_alignment_responsive ) ? 'none' : $settings->button_alignment_responsive; ?>;
		}
	<?php } ?>

}
