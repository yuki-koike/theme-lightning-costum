<?php 

//bodyタグにクラス付与
function my_add_body_class( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'my-costum-theme-lightning';
    }
    return $classes;
}
add_filter( 'body_class', 'my_add_body_class' );


// クレジット表記無効化
function my_remove_lightning_powered( $powered ) {
	return '';
}
add_filter( 'lightning_footerPoweredCustom', 'my_remove_lightning_powered' );

function my_remove_vk_plugin_filter() {
	remove_filter(
		'lightning_footerPoweredCustom',
		'vkExUnit_lightning_footerPoweredCustom'
	);
}
add_action( 'init', 'my_remove_vk_plugin_filter', 20 );

?>