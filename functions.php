<?php
// Add custom Theme Functions here

//require get_template_directory() . '/inc/shortcodes/share_follow.php';

//require get_template_directory() . '/woocommerce/checkout/thankyou.php';

/*
 * Provjera mailova da li su od Sindikata Policije (SPH)
 * Ukoliko je mail od njih primjeni popust od 20% automatski za plaćanje kešom i 10% za kartice
 */ 
add_action( 'user_register', 'maskice_set_role_by_email' );
function maskice_set_role_by_email( $user_id ){
    $user = get_user_by( 'id', $user_id );
    $domain = substr(
        strrchr(
            $user->data->user_email, 
            "@"
        ), 1
    ); //Get Domain

    $customer_domains = array( 'sindikatpolicije.hr' );
    if( in_array( $domain, $customer_domains ) ){
        foreach( $user->roles as $role )
            $user->remove_role( $role ); //Remove existing Roles
        $user->add_role( 'sph' ); //Add role
    }
}


function mytheme_wp_get_attachment_image_attributes( $attr ) {
 
unset($attr['title']);
 
 return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mytheme_wp_get_attachment_image_attributes' );

function mytheme_wp_get_attachment_image_attributes_alts( $attr ) {
 
unset($attr['alt']);
 
 return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mytheme_wp_get_attachment_image_attributes_alts' );


// Remove login shake
function my_login_head() {
    remove_action('login_head', 'wp_shake_js', 12);
}
add_action('login_head', 'my_login_head');

// Remove WP logo in admin bar
function annointed_admin_bar_remove() {
        global $wp_admin_bar;

        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);

// Empty cart thank you page fix

function maskice_empty_cart_fix() {
	return get_site_url();
	//Can use any page instead, like return '/sample-page/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'maskice_empty_cart_fix' );


/* 
 * Remove jquery migrate for enhanced performance
 */
function remove_jquery_migrate_maskice($scripts) {
   if ( is_admin() ) return;
   $scripts->remove( 'jquery' );
   $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
}
add_action( 'wp_default_scripts', 'remove_jquery_migrate_maskice' );


/*
 *  Remove Query Strings from JS and CSS
 */
function maskice_remove_query_strings( $src ) {
  if( strpos( $src, '?ver=' ) )
    $src = remove_query_arg( 'ver', $src );
    return $src;
  }
add_filter( 'style_loader_src', 'maskice_remove_query_strings', 10, 2 );
add_filter( 'script_loader_src', 'maskice_remove_query_strings', 10, 2 );


function maskice_remove_script_version( $src ){
  $parts = explode( '?ver', $src );
  return $parts[0];
}
add_filter( 'script_loader_src', 'maskice_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'maskice_remove_script_version', 15, 1 );

/*
 *  Multple article with usage of same SKU
 */ 

add_filter( 'wc_product_has_unique_sku', '__return_false' ); 