<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://esmondmccain.com/
 * @since      1.0.0
 *
 * @package    Em_Quick_Trash_Deletion
 * @subpackage Em_Quick_Trash_Deletion/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Em_Quick_Trash_Deletion
 * @subpackage Em_Quick_Trash_Deletion/admin
 * @author     Esmond Mccain <esmondmccain@gmail.com>
 */
class Em_Quick_Trash_Deletion_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Em_Quick_Trash_Deletion_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Em_Quick_Trash_Deletion_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        global $pagenow;

        if( 'edit.php' == $pagenow ) {
            wp_enqueue_style('em-quick-trash-deletion-admin', $this->assets_url . 'css/em-quick-trash-deletion-admin.css', array(), '1.0.0');
        }

    }

    /**
     * Display empty trash button on list tables
     * @return void
     */
    public function add_button() {
        global $typenow, $pagenow;

        // Don't show on comments list table
        if( 'edit-comments.php' == $pagenow ) return;

        // Don't show on trash page
        if( isset( $_REQUEST['post_status'] ) && $_REQUEST['post_status'] == 'trash' ) return;

        // Don't show if current user is not allowed to edit other's posts for this post type
        if ( ! current_user_can( get_post_type_object( $typenow )->cap->edit_others_posts ) ) return;

        // Don't show if there are no items in the trash for this post type
        if( 0 == intval( wp_count_posts( $typenow, 'readable' )->trash ) ) return;

        ?>
        <div class="alignleft empty_trash">
            <input type="hidden" name="post_status" value="trash" />
            <?php submit_button( __( 'Empty Trash' ), 'apply', 'delete_all', false ); ?>
        </div>
        <?php
    }

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Em_Quick_Trash_Deletion_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Em_Quick_Trash_Deletion_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/em-quick-trash-deletion-admin.js', array( 'jquery' ), $this->version, false );

	}

}
