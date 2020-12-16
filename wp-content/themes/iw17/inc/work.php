<?php
/**
 * Custom post type for this theme
 *
 * @package Interactive_Workshops_2017
 */
function work_post_type() {

	$labels = array(
		'name'                  => _x( 'Work', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Work', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Work', 'text_domain' ),
		'name_admin_bar'        => __( 'Work', 'text_domain' ),
		'archives'              => __( 'Work Archives', 'text_domain' ),
		'attributes'            => __( 'Work Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'Parent Work:', 'text_domain' ),
		'all_items'             => __( 'All Work', 'text_domain' ),
		'add_new_item'          => __( 'Add New Item', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New Item', 'text_domain' ),
		'edit_item'             => __( 'Edit Item', 'text_domain' ),
		'update_item'           => __( 'Update Item', 'text_domain' ),
		'view_item'             => __( 'View Item', 'text_domain' ),
		'view_items'            => __( 'View Items', 'text_domain' ),
		'search_items'          => __( 'Search Item', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
		'items_list'            => __( 'Items list', 'text_domain' ),
		'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
	);
	$args = array(
		'label'                 => __( 'Work', 'text_domain' ),
		'description'           => __( 'Used for any portfolio items', 'text_domain' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'custom-fields', 'page-attributes', ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-lightbulb',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'work', $args );

}
add_action( 'init', 'work_post_type', 0 );

/**
 * Add industry taxonomy
 */
function iw17_register_work_taxonomies() {

	register_taxonomy( 'industry', array( 'post', 'work' ), array(
		'labels' => array(
			'name'                       => _x( 'Industries', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Industry', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Industries', 'text_domain' ),
			'all_items'                  => __( 'All Industries', 'text_domain' ),
			'parent_item'                => __( 'Parent Industry', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Industry:', 'text_domain' ),
			'new_item_name'              => __( 'New Industry Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Industry', 'text_domain' ),
			'edit_item'                  => __( 'Edit Industry', 'text_domain' ),
			'update_item'                => __( 'Update Industry', 'text_domain' ),
			'view_item'                  => __( 'View Industry', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate industries with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove industries', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Industries', 'text_domain' ),
			'search_items'               => __( 'Search Industries', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No industries', 'text_domain' ),
			'items_list'                 => __( 'Industries list', 'text_domain' ),
			'items_list_navigation'      => __( 'Industries list navigation', 'text_domain' ),
		),
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
	) );

	register_taxonomy( 'work_type', array( 'work' ), array(
		'labels' => array(
			'name'                       => _x( 'Skills Deployed', 'Taxonomy General Name', 'text_domain' ),
			'singular_name'              => _x( 'Skill', 'Taxonomy Singular Name', 'text_domain' ),
			'menu_name'                  => __( 'Skills Deployed', 'text_domain' ),
			'all_items'                  => __( 'All Skills', 'text_domain' ),
			'parent_item'                => __( 'Parent Skill', 'text_domain' ),
			'parent_item_colon'          => __( 'Parent Skill:', 'text_domain' ),
			'new_item_name'              => __( 'New Skill Name', 'text_domain' ),
			'add_new_item'               => __( 'Add New Skill', 'text_domain' ),
			'edit_item'                  => __( 'Edit Skill', 'text_domain' ),
			'update_item'                => __( 'Update Skill', 'text_domain' ),
			'view_item'                  => __( 'View Skill', 'text_domain' ),
			'separate_items_with_commas' => __( 'Separate skills with commas', 'text_domain' ),
			'add_or_remove_items'        => __( 'Add or remove skills', 'text_domain' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'text_domain' ),
			'popular_items'              => __( 'Popular Skills', 'text_domain' ),
			'search_items'               => __( 'Search Skills', 'text_domain' ),
			'not_found'                  => __( 'Not Found', 'text_domain' ),
			'no_terms'                   => __( 'No skills', 'text_domain' ),
			'items_list'                 => __( 'Skills list', 'text_domain' ),
			'items_list_navigation'      => __( 'Skills list navigation', 'text_domain' ),
		),
		'hierarchical'               => false,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => false,
		'show_in_nav_menus'          => false,
		'show_tagcloud'              => false,
	) );

}
add_action( 'init', 'iw17_register_work_taxonomies', 0 );

/**
 * Add Company column and reorder columns
 */
function iw17_set_custom_edit_work_columns( $columns ) {
	$new_columns = array();

    foreach( $columns as $key => $title ) {
    	if ( $key == 'title' ) {
			$new_columns['company'] = __( 'Company', 'iw17' );
		}

    	$new_columns[$key] = $title;
    }

	unset( $new_columns['tags'] );

    return $new_columns;
}
add_filter( 'manage_posts_columns', 'iw17_set_custom_edit_work_columns' );

/**
 * Add custom column contents
 */
function iw17_custom_work_column( $column, $post_id ) {

	switch( $column ) {

		case 'company' :

			if ( $company = get_field( 'company', $post_id ) ){
				echo '<span class="row-title">', $company, '</span>';
			} else {
				echo '&ndash;';
			}

			break;

	}
}
add_action( 'manage_posts_custom_column', 'iw17_custom_work_column', 10, 2 );

/**
 * Style custom columns
 */
function iw17_company_column_width() {
    echo '<style type="text/css">';
    echo '.column-company { width: 100px !important; }';
    echo '</style>';
}
add_action('admin_head', 'iw17_company_column_width');
