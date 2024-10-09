<?php

echo 'ТАМ ДОЛЖНО ЧТО-ТО ИЗМЕНИТЬСЯ';

function tsite_debug( $data ) {
	echo '<pre>' . print_r( $data, TRUE ) . '</pre>';
}

function tsite_scripts() {
	wp_enqueue_style( 'tsite-bootstrap',
		get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
//    wp_enqueue_style('tsite-main', get_template_directory_uri() . '/assets/css/main.css');
	wp_enqueue_style( 'tsite-style', get_stylesheet_uri(), array(),
		wp_get_theme()->get( 'Version' ) );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tsite-main',
		get_template_directory_uri() . '/assets/js/main.js', array(), '1.0',
		TRUE );
	wp_enqueue_script( 'tsite-bootstrap',
		get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js',
		array(), 0, 1 );
}

add_action( 'wp_enqueue_scripts', 'tsite_scripts' );
add_filter( 'excerpt_more', function ( $more ) {
	return '...';
} );
function tsite_get_human_time() {
	$time_diff = human_time_diff( get_post_time( 'U' ),
		current_time( 'timestamp' ) );
	echo "Опубликовано $time_diff назад.";
}

function tsite_setup() {
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'image', 'video' ) );
}

add_action( 'after_setup_theme', 'tsite_setup' );


add_image_size( 'tsite_post_image', 470, 280, TRUE );

function tsite_post_thumb(
	$id,
	$size = 'full',
	$wrapper_class = 'card-thumb'
) {
	$html = '<div class="' . $wrapper_class . '">';
	if ( has_post_thumbnail() ) {
		$html .= get_the_post_thumbnail( $id, $id );
	} else {
		$html .= '<img src="http://dummyimage.com/480x240/333/ccc&text=МЕСТО ДЛЯ ВАШЕЙ РЕКЛАМЫ" alt="Избражение поста" width="1200" height="900">';
	}
	$html .= '</div>';

	return $html;
}

function tsite_get_media( $types = array() ) {
	$content = apply_filters( 'the_content', get_the_content() );
	$items   = get_media_embedded_in_content( $content,
		$types );

	return $items[0] ?? $items;
}

//tsite_debug(wp_get_theme());