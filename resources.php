<?php
/**
 * Example post type
 */

// Define our post type names
$resource_names = [
	'name'                  => 'vtl_resource',
	'menu_name'             => 'Resources',
	'singular'              => 'Resource',
	'plural'                => 'Resources',
	'all_items'             => 'All Resources',
	'slug'                  => 'resource',
	'featured_image'        => 'Resource Diagram',
	'set_featured_image'    => 'Set resource diagram',
	'remove_featured_image' => 'Remove resource diagram',
	'use_featured_image'    => 'Use as resource diagram',
];

// Define our options
$resource_options = [
	'exclude_from_search' => false,
	'hierarchical'        => false,
	'menu_position'       => 20,
	'has_archive'         => true,
	'rewrite'             => array('with_front' => false),
	'show_in_admin_bar'   => true,
	'show_in_menu'        => true,
	'show_in_nav_menus'   => true,
	'show_in_rest'        => false,
	'show_ui'             => true,
	'supports'            => array('title', 'page-attributes'),
];

// Create post type
$resource = new PostType($resource_names, $resource_options);

// Set the menu icon
$resource->icon('dashicons-star-filled');

// Set the title placeholder text
$resource->placeholder('Enter resource name');

// Hide admin columns
$resource->columns()->hide(['wpseo-score', 'wpseo-score-readability']);

// Set all columns
$resource->columns()->set([
	'cb'          => '<input type="checkbox" />',
	'feat_img'    => 'Thumb',
	'title'       => __('Title'),
	'resource_type' => __('Group'),
]);

// Add custom admin columns to default array
$resource->columns()->add([
	'resource_color' => 'Color',
]);

// Populate custom admin columns
$resource->columns()->populate('resource_color', function($column, $post_id) {
	echo get_post_meta($post_id, 'resource_color');
});

// Add CSS to style columns
add_action('admin_head', function() {
	$screen = get_current_screen();
	if ($screen && ($screen->base === 'edit') && ($screen->id === 'edit-vtl_resource')) {
		echo '<style>
		th[id=feat_img] {
			width: 42px;
		}
		</style>';
	}
});

// Make custom admin columns sortable
$resource->columns()->sortable([
	'resource_color' => ['resource_color', true]
]);
