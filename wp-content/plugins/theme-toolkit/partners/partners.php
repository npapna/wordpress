<?php 
if ( ! function_exists('theme_toolkit_partners') ) {

	// Register Custom Post Type
	function theme_toolkit_partners() {

		$labels = array(
			'name'                  => _x( 'Partners', 'Post Type General Name', 'theme-toolkit' ),
			'singular_name'         => _x( 'Partner', 'Post Type Singular Name', 'theme-toolkit' ),
			'menu_name'             => __( 'Partners', 'theme-toolkit' ),
			'name_admin_bar'        => __( 'Partners', 'theme-toolkit' ),
			'archives'              => __( 'Item Archives', 'theme-toolkit' ),
			'attributes'            => __( 'Item Attributes', 'theme-toolkit' ),
			'parent_item_colon'     => __( 'Parent Item:', 'theme-toolkit' ),
			'all_items'             => __( 'All Items', 'theme-toolkit' ),
			'add_new_item'          => __( 'Add New Item', 'theme-toolkit' ),
			'add_new'               => __( 'Add New', 'theme-toolkit' ),
			'new_item'              => __( 'New Item', 'theme-toolkit' ),
			'edit_item'             => __( 'Edit Item', 'theme-toolkit' ),
			'update_item'           => __( 'Update Item', 'theme-toolkit' ),
			'view_item'             => __( 'View Item', 'theme-toolkit' ),
			'view_items'            => __( 'View Items', 'theme-toolkit' ),
			'search_items'          => __( 'Search Item', 'theme-toolkit' ),
			'not_found'             => __( 'Not found', 'theme-toolkit' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'theme-toolkit' ),
			'featured_image'        => __( 'Featured Image', 'theme-toolkit' ),
			'set_featured_image'    => __( 'Set featured image', 'theme-toolkit' ),
			'remove_featured_image' => __( 'Remove featured image', 'theme-toolkit' ),
			'use_featured_image'    => __( 'Use as featured image', 'theme-toolkit' ),
			'insert_into_item'      => __( 'Insert into item', 'theme-toolkit' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'theme-toolkit' ),
			'items_list'            => __( 'Items list', 'theme-toolkit' ),
			'items_list_navigation' => __( 'Items list navigation', 'theme-toolkit' ),
			'filter_items_list'     => __( 'Filter items list', 'theme-toolkit' ),
		);
		$args = array(
			'label'                 => __( 'Partners', 'theme-toolkit' ),
			'description'           => __( 'Post type to create partners', 'theme-toolkit' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'thumbnail', ),
			'hierarchical'          => false,
			'public'                => false,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 30,
			'menu_icon'             => 'dashicons-slides',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,		
			'exclude_from_search'   => true,
			'publicly_queryable'    => false,
			'capability_type'       => 'page',
		);
		register_post_type( 'tt-partners', $args );

	}

}

add_action( 'init', 'theme_toolkit_partners', 0 );


/**********************************************************
* Add Extra Custom Fields to the Post Type Add / Edit screen
* Plus Update Method
**********************************************************/

add_action( 'admin_init', 'theme_toolkit_partners_meta_init' );
add_action( 'save_post', 'theme_toolkit_partners_meta_save' );

function theme_toolkit_partners_meta_init() {

    add_meta_box("partners-information", __( 'Additional Information', 'theme-toolkit' ), "theme_toolkit_partners_meta_options", "tt-partners", "normal", "high");      
}

function theme_toolkit_partners_meta_options( $post ) {

    $values 	= get_post_custom( $post->ID );

    $link  	    = isset( $values['link'] ) ? esc_html( $values['link'][0] ) : '';

    wp_nonce_field( 'theme_toolkit_meta_box_nonce', 'meta_box_nonce' );

    ?>

    <table id="tt-partners-options" width="100%" border="0" class="options" cellspacing="5" cellpadding="5">
          
        <tr>
            <td width="1%">
                <label for="link"><?php _e('Link', 'theme-toolkit'); ?></label>
            </td>
            <td width="10%">
                <input type="text" id="link" class="widefat" name="link" value="<?php echo esc_url( $link ); ?>" placeholder="<?php esc_attr_e('Enter link or leave empty if not required', 'theme-toolkit'); ?>"/>
            </td>          
        </tr>  
       
    </table>   
    <?php   
}


function theme_toolkit_partners_meta_save( $post_id )
{
    global $post;  

    $custom_meta_fields = array( 'link' );

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'theme_toolkit_meta_box_nonce' ) ) return;
    
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
    
    // now we can actually save the data
    $allowed = '';    
 
    foreach( $custom_meta_fields as $custom_meta_field ){

        if( isset( $_POST[$custom_meta_field] ) )           

            update_post_meta($post->ID, $custom_meta_field, esc_url_raw( $_POST[$custom_meta_field], $allowed) );      
    }
        
   
}