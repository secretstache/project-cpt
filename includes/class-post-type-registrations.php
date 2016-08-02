<?php
/**
 * SSM Projects
 *
 * @package   SSM_Projects
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package SSM_Projects
 */
class SSM_Projects_Registrations {

	public $post_type = 'project';

	public $taxonomies = array( 'project-category' );

	public function init() {
		// Add the SSM Projects and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses SSM_Projects_Registrations::register_post_type()
	 * @uses SSM_Projects_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Projects', 'ssm-projects' ),
			'singular_name'      => __( 'Project', 'ssm-projects' ),
			'add_new'            => __( 'Add Project', 'ssm-projects' ),
			'add_new_item'       => __( 'Add Project', 'ssm-projects' ),
			'edit_item'          => __( 'Edit Project', 'ssm-projects' ),
			'new_item'           => __( 'New Project', 'ssm-projects' ),
			'view_item'          => __( 'View Project', 'ssm-projects' ),
			'search_items'       => __( 'Search Projects', 'ssm-projects' ),
			'not_found'          => __( 'No projects found', 'ssm-projects' ),
			'not_found_in_trash' => __( 'No projects in the trash', 'ssm-projects' ),
		);

		$supports = array(
			'title',
			'thumbnail',
			'genesis-layouts',
			'genesis-seo'
		);

		$args = array(
			'labels'          => $labels,
			'supports'        => $supports,
			'public'          => true,
			'capability_type' => 'post',
			'rewrite'         => array( 'slug' => 'project', ), // Permalinks format
			'menu_position'   => 30,
			'menu_icon'       => 'dashicons-admin-page',
		);

		$args = apply_filters( 'ssm_projects_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Project Categories', 'ssm-projects' ),
			'singular_name'              => __( 'Project Category', 'ssm-projects' ),
			'menu_name'                  => __( 'Project Categories', 'ssm-projects' ),
			'edit_item'                  => __( 'Edit Project Category', 'ssm-projects' ),
			'update_item'                => __( 'Update Project Category', 'ssm-projects' ),
			'add_new_item'               => __( 'Add New Project Category', 'ssm-projects' ),
			'new_item_name'              => __( 'New Project Category Name', 'ssm-projects' ),
			'parent_item'                => __( 'Parent Project Category', 'ssm-projects' ),
			'parent_item_colon'          => __( 'Parent Project Category:', 'ssm-projects' ),
			'all_items'                  => __( 'All Project Categories', 'ssm-projects' ),
			'search_items'               => __( 'Search Project Categories', 'ssm-projects' ),
			'popular_items'              => __( 'Popular Project Categories', 'ssm-projects' ),
			'separate_items_with_commas' => __( 'Separate project categories with commas', 'ssm-projects' ),
			'add_or_remove_items'        => __( 'Add or remove project categories', 'ssm-projects' ),
			'choose_from_most_used'      => __( 'Choose from the most used project categories', 'ssm-projects' ),
			'not_found'                  => __( 'No project categories found.', 'ssm-projects' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'project-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'ssm_projects_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}