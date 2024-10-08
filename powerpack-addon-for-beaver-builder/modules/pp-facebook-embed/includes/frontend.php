<?php

$attrs = array(
	'data-href' => '',
);
$attr = ' ';
$style = 'min-height:1px;';
$class = array( 'pp-facebook-widget' );

if ( 'comment' == $settings->embed_type ) {
	$class[] 						= 'fb-comment-embed';
	$attrs['data-href'] 			= esc_url( do_shortcode( $settings->comment_url ) );
	$attrs['data-include-parent'] 	= ( 'yes' == $settings->include_parent ) ? 'true' : 'false';
}

if ( 'post' == $settings->embed_type ) {
	$class[] 						= 'fb-post';
	$attrs['data-href'] 			= esc_url( do_shortcode( $settings->post_url ) );
	$attrs['data-show-text'] 		= ( 'yes' == $settings->show_text ) ? 'true' : 'false';
}

if ( 'video' == $settings->embed_type ) {
	$class[] 						= 'fb-video';
	$attrs['data-href'] 			= esc_url( do_shortcode( $settings->video_url ) );
	$attrs['data-show-text'] 		= ( 'yes' == $settings->show_text ) ? 'true' : 'false';
	$attrs['data-allowfullscreen'] 	= ( 'yes' == $settings->video_allowfullscreen ) ? 'true' : 'false';
	$attrs['data-autoplay'] 		= ( 'yes' == $settings->video_autoplay ) ? 'true' : 'false';
	$attrs['data-show-captions'] 	= ( 'yes' == $settings->show_captions ) ? 'true' : 'false';
}

if ( '' != $settings->width ) {
	$attrs['data-width'] 	= esc_attr( $settings->width );
}

foreach ( $attrs as $key => $value ) {
	$attr .= $key;
	if ( ! empty( $value ) ) {
		$attr .= '=' . $value;
	}

	$attr .= ' ';
}

?>

<div class="<?php echo implode( ' ', $class ); ?>" <?php echo $attr; ?> style="<?php echo $style; ?>">
	<blockquote cite="<?php echo $attrs['data-href']; ?>" class="fb-xfbml-parse-ignore"></blockquote>
</div>
