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

        /*
         if edit page enqueue my styles
         */
        global $pagenow;

        if( 'edit.php' == $pagenow ) {
            wp_enqueue_style('em-quick-trash-deletion-admin', $this->assets_url . 'css/em-quick-trash-deletion-admin.css', array(), '1.0.0');
        }

    }

    /**
     * Display permanent delete button on row action links of post manage column edit screen
     */
    public function add_permanent_delete_row_action($actions, $post)
    {
        global $typenow;
        $title  = _draft_or_post_title();
        // Don't show if current user is not allowed to edit other's posts for this post type
        if ( ! current_user_can( get_post_type_object( $typenow )->cap->edit_others_posts ) ) return;

        if ($post->post_type=='post')
        {
            $actions['delete'] = sprintf(
                '<a href="%s" class="submitdelete" aria-label="%s">%s</a>',
                get_delete_post_link( $post->ID, '', true ),
                /* translators: %s: Post title. */
                esc_attr( sprintf( __( 'Delete &#8220;%s&#8221; permanently' ), $title ) ),
                __( 'Delete Permanently' )
            );
        }
        return $actions;
    }

    /**
     * Display empty trash button on list tables
     * @return void
     */
    public function add_empty_trash_button() {
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

}
