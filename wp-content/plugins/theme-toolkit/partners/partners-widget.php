<?php 

if ( ! function_exists( 'theme_toolkit_partners_widget' ) ) :

    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function theme_toolkit_partners_widget() {

        register_widget( 'Theme_Toolkit_Partners_Widget' );

    }

endif;

add_action( 'widgets_init', 'theme_toolkit_partners_widget' );

if ( ! class_exists( 'Theme_Toolkit_Partners_Widget' ) ) :

    /**
     * Partners widget class.
     *
     * @since 1.0.0
     */
    class Theme_Toolkit_Partners_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                'classname'   => 'theme_toolkit_partners',
                'description' => __( 'Widget to display partner logos', 'theme-toolkit' ),
            );

            parent::__construct( 'theme-toolkit-partners', esc_html__( 'TT: Partners', 'theme-toolkit' ), $opts );
        }


        function widget( $args, $instance ) {

            $title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $sub_title         = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
            $featured_image    = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'full';
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 4;

            echo $args['before_widget']; ?>

                <div class="tt-partners-wrap">

                    <?php
                    if ( !empty( $title ) || !empty( $sub_title ) ){ ?>

                        <div class="section-title">

                            <?php 

                            if ( $title ) {

                                echo $args['before_title'] . esc_html( $title ) . $args['after_title'];

                            }

                            if ( $sub_title ) { ?>

                                <p><?php echo esc_html( $sub_title ); ?></p>

                                <?php 
                                
                            } ?>

                        </div>
                        <?php 
                    }

                    theme_toolkit_partners_widget_call( $post_number, $featured_image ); ?>
                
                </div>

                <?php

            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']          = sanitize_text_field( $new_instance['title'] );
            $instance['sub_title']      = sanitize_text_field( $new_instance['sub_title'] );
            $instance['post_number']    = absint( $new_instance['post_number'] );
            $instance['featured_image'] = sanitize_text_field( $new_instance['featured_image'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'          => '',
                'sub_title'      => '',
                'featured_image' => 'full',
                'post_number'    => 12,
            ) ); 
            ?>

            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php _e( 'Title:', 'theme-toolkit' ); ?></strong></label>
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
            </p>
            
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'theme-toolkit' ); ?></strong></label>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
            </p>
            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>"><strong><?php _e( 'Number of Posts:', 'theme-toolkit' ); ?></strong></label>
              <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_number' ) ); ?>" name="<?php echo  esc_attr( $this->get_field_name( 'post_number' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['post_number'] ); ?>" min="1" />
            </p>
            <p>
              <label for="<?php echo esc_attr( $this->get_field_id( 'featured_image' ) ); ?>"><strong><?php _e( 'Select Image Size:', 'theme-toolkit' ); ?></strong></label>
                <?php
                $this->dropdown_image_sizes( array(
                    'id'       => $this->get_field_id( 'featured_image' ),
                    'name'     => $this->get_field_name( 'featured_image' ),
                    'selected' => esc_attr( $instance['featured_image'] ),
                    )
                );
                ?>
            </p>
            <?php
        }

        function dropdown_image_sizes( $args ) {

            $defaults = array(
                'id'       => '',
                'class'    => 'widefat',
                'name'     => '',
                'selected' => 'full',
            );

            $r = wp_parse_args( $args, $defaults );
            
            $output = '';

            global $_wp_additional_image_sizes;

            $get_intermediate_image_sizes = get_intermediate_image_sizes();
            
            $choices = array();

            $choices['thumbnail'] = esc_html__( 'Thumbnail', 'theme-toolkit' );
            $choices['medium']    = esc_html__( 'Medium', 'theme-toolkit' );
            $choices['large']     = esc_html__( 'Large', 'theme-toolkit' );
            $choices['full']      = esc_html__( 'Full (Original)', 'theme-toolkit' );

            $show_dimension = true;

            if ( true === $show_dimension ) {
                foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
                    $choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
                }
            }

            if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
                foreach ( $_wp_additional_image_sizes as $key => $size ) {
                    $choices[ $key ] = $key;
                    if ( true === $show_dimension ) {
                        $choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
                    }
                }
            }

            if ( ! empty( $allowed ) ) {
                foreach ( $choices as $key => $value ) {
                    if ( ! in_array( $key, $allowed ) ) {
                        unset( $choices[ $key ] );
                    }
                }
            }

            if ( ! empty( $choices ) ) {

                $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "' class='" . esc_attr( $r['class'] ) . "'>\n";
                foreach ( $choices as $key => $choices ) {
                    $output .= '<option value="' . esc_attr( $key ) . '" ';
                    $output .= selected( $r['selected'], $key, false );
                    $output .= '>' . esc_html( $choices ) . '</option>\n';
                }
                $output .= "</select>\n";
            }

            echo $output;
        }
    }

endif;

function theme_toolkit_partners_widget_call( $post_number, $featured_image ){

    $partners_args = array(
        'post_type'      => 'tt-partners',
        'posts_per_page' => esc_attr( $post_number ),
        'no_found_rows'  => true,
        'meta_query'     => array(
                            array( 'key' => '_thumbnail_id' ),
                        ),
        );
  
    $partners_query = new WP_Query( $partners_args );

    if ( $partners_query->have_posts() ) : ?>

      <div class="tt-partners">

        <div class="inner-wrapper">

            <div class="tt-partners-main">

                <?php 
                while ( $partners_query->have_posts() ) :

                    $partners_query->the_post(); ?>

                    <div class="tt-partners-item">
                    
                        <div class="tt-partners-thumb">
                            <?php 

                            $post_id    = get_the_ID();

                            $link       = get_post_meta( absint( $post_id ), 'link', true );

                            if( !empty( $link ) ){ ?>

                                <a href="<?php echo esc_url( $link ); ?>" target="_blank">

                                    <?php 

                                    if ( has_post_thumbnail() ){ 

                                        the_post_thumbnail( esc_attr( $featured_image ) );

                                    } ?>
                                </a>
                                <?php
                            }else{

                                if ( has_post_thumbnail() ){ 

                                    the_post_thumbnail( esc_attr( $featured_image ) );

                                } 

                            } ?>
                        </div>
                        
                    </div>

                    <?php 
                endwhile; 

                wp_reset_postdata(); ?>

            </div>

        </div><!-- .inner-wrapper -->

      </div><!-- .tt-partners-widget -->

    <?php endif; 

}

function theme_toolkit_show_partners( $atts ) {

    extract( shortcode_atts( 
        array( 
            'post_number'  => 40,
            'image_size'   => 'full',
        ), 
        $atts 
    ));

    ob_start();

    theme_toolkit_partners_widget_call( $post_number, $image_size );

    return ob_get_clean();
}

add_shortcode( 'tt-partners', 'theme_toolkit_show_partners' );