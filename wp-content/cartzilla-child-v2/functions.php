<?php
/**
 * Cartzilla Child
 *
 * @package cartzilla-child
 */

/**
 * Include all your custom code here
 */

// Register Brand Taxonomy
function brand_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Brands', 'Taxonomy General Name', 'web' ),
		'singular_name'              => _x( 'Brand', 'Taxonomy Singular Name', 'web' ),
		'menu_name'                  => __( 'Brand', 'web' ),
		'all_items'                  => __( 'All Items', 'web' ),
		'parent_item'                => __( 'Parent Item', 'web' ),
		'parent_item_colon'          => __( 'Parent Item:', 'web' ),
		'new_item_name'              => __( 'New Item Name', 'web' ),
		'add_new_item'               => __( 'Add New Item', 'web' ),
		'edit_item'                  => __( 'Edit Item', 'web' ),
		'update_item'                => __( 'Update Item', 'web' ),
		'view_item'                  => __( 'View Item', 'web' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'web' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'web' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'web' ),
		'popular_items'              => __( 'Popular Items', 'web' ),
		'search_items'               => __( 'Search Items', 'web' ),
		'not_found'                  => __( 'Not Found', 'web' ),
		'no_terms'                   => __( 'No items', 'web' ),
		'items_list'                 => __( 'Items list', 'web' ),
		'items_list_navigation'      => __( 'Items list navigation', 'web' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'show_in_rest'       		 => true,
	);
	
	register_taxonomy( 'brand_tax', array( 'product' ), $args );

}
add_action( 'init', 'brand_taxonomy', 0 );


include get_template_directory() . '/../cartzilla-child/armatupcapi/armatupcapi-init.php';


if( ! function_exists( 'cartzilla_navbar_top_bar_brands' ) ) {
	add_action( 'cartzilla_header_before_brands', 'cartzilla_navbar_top_bar_brands' );
	function cartzilla_navbar_top_bar_brands( $query ){
		get_template_part( 'templates/header/header', 'brands' );   
	}    
}

function dmc_add_svg_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'dmc_add_svg_mime_types');

if( function_exists('acf_add_options_page') ) {
	/*
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	*/
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	
}

add_action('wp_enqueue_scripts','Load_Template_Scripts_wpa83855');
function Load_Template_Scripts_wpa83855(){
    if ( is_page_template('PageArmaTuPC.php') ) {		
        wp_enqueue_script('vue', get_template_directory_uri() . '/../cartzilla-child/js/vue.js');
       // wp_enqueue_script('app_armatupc', get_template_directory_uri() . '/../cartzilla-child/js/app_armatupc.js',array('vue'),NULL,false);
       // wp_enqueue_script('app_cpulistmodal', get_template_directory_uri() . '/../cartzilla-child/js/app_cpulistmodal.js',array('app_armatupc'),NULL,false);
    } 
}

function sucursal_custom_post_type() {
	$labels = array(
		'name'                  => 'Sucursal',
		'singular_name'         => 'Sucursal',
		'menu_name'             => 'Sucursal',
		'name_admin_bar'        => 'Sucursal',
		'archives'              => 'Archivos de sucursal',
		'attributes'            => 'Atributos de sucursal',
		'parent_item_colon'     => 'Elemento padre:',
		'all_items'             => 'Todas las sucursales',
		'add_new_item'          => 'Añadir nuevo',
		'add_new'               => 'Añadir nuevo',
		'new_item'              => 'Nuevo',
		'edit_item'             => 'Editar ',
		'update_item'           => 'Actualizar',
		'view_item'             => 'Ver',
		'view_items'            => 'Ver',
		'search_items'          => 'Buscar',
		'not_found'             => 'No Encontrados',
		'not_found_in_trash'    => 'No Encontrados en la Papelera',
		'featured_image'        => 'Imagen destacada',
		'set_featured_image'    => 'Seleccionar imagen destacada',
		'remove_featured_image' => 'Eliminar imagen destacada',
		'use_featured_image'    => 'Usar como imagen destacada',
		'insert_into_item'      => 'Insertar en sucursal',
		'uploaded_to_this_item' => 'Subir a esta actividad',
		'items_list'            => 'Listado de actividades',
		'items_list_navigation' => 'Navegación de sucursal',
		'filter_items_list'     => 'Filstrar listado de actividades',
	);
	$args = array(
		'label'                 => 'sucursal',
		'description'           => 'Contenidos de sucursal',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats', ),
		//'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-store',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => 'sucursales',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'product',
		'show_in_rest'          => true,
	);
	register_post_type( 'sucursal', $args );

}
add_action( 'init', 'sucursal_custom_post_type', 0 );


