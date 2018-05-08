<?php 

if ( ! function_exists( 'theme_toolkit_portfolio_widget' ) ) :

    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function theme_toolkit_portfolio_widget() {

        register_widget( 'Theme_Toolkit_Portfolio_Widget' );

    }

endif;

add_action( 'widgets_init', 'theme_toolkit_portfolio_widget' );

if ( ! class_exists( 'Theme_Toolkit_Portfolio_Widget' ) ) :

    /**
     * Portfolio widget class.
     *
     * @since 1.0.0
     */
    class Theme_Toolkit_Portfolio_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                'classname'   => 'theme_toolkit_portfolio',
                'description' => __( 'Widget to display portfolio with filter', 'theme-toolkit' ),
            );

            parent::__construct( 'theme-toolkit-portfolio', esc_html__( 'TT: Portfolio', 'theme-toolkit' ), $opts );
        }


        function widget( $args, $instance ) {

            $title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $section_icon      = !empty( $instance['section_icon'] ) ? $instance['section_icon'] : '';

            $sub_title         = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
            $post_column       = ! empty( $instance['post_column'] ) ? $instance['post_column'] : 4;
            $featured_image    = ! empty( $instance['featured_image'] ) ? $instance['featured_image'] : 'full';
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 40;

            echo $args['before_widget']; ?>

                <div class="tt-portfolio-wrap">

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

                    theme_toolkit_portfolio_widget_call( $post_number, $post_column, $featured_image ); ?>
                
                </div>
                <?php

            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {

            $instance = $old_instance;

            $instance['title']          = sanitize_text_field( $new_instance['title'] );
            $instance['sub_title']      = sanitize_text_field( $new_instance['sub_title'] );
            $instance['post_number']    = absint( $new_instance['post_number'] );
            $instance['post_column']    = absint( $new_instance['post_column'] );
            $instance['featured_image'] = sanitize_text_field( $new_instance['featured_image'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'          => '',
                'sub_title'      => '',
                'post_column'    => 4,
                'featured_image' => 'full',
                'post_number'    => 4,
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
              <label for="<?php echo esc_attr( $this->get_field_id( 'post_column' ) ); ?>"><strong><?php _e( 'Number of Columns:', 'theme-toolkit' ); ?></strong></label>
                <?php
                $this->dropdown_post_columns( array(
                    'id'       => $this->get_field_id( 'post_column' ),
                    'name'     => $this->get_field_name( 'post_column' ),
                    'selected' => absint( $instance['post_column'] ),
                    )
                );
                ?>
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

        function dropdown_post_columns( $args ) {
            $defaults = array(
                'id'       => '',
                'name'     => '',
                'selected' => 0,
            );

            $r = wp_parse_args( $args, $defaults );
            $output = '';

            $choices = array(
                '2' => 2,
                '3' => 3,
                '4' => 4,
            );

            if ( ! empty( $choices ) ) {

                $output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "'>\n";
                foreach ( $choices as $key => $choice ) {
                    $output .= '<option value="' . esc_attr( $key ) . '" ';
                    $output .= selected( $r['selected'], $key, false );
                    $output .= '>' . esc_html( $choice ) . '</option>\n';
                }
                $output .= "</select>\n";
            }

            echo $output;
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

function theme_toolkit_portfolio_widget_call( $post_number, $post_column, $featured_image ){

    $portfolio_args = array(
                        'post_type'      => 'tt-portfolio',
                        'posts_per_page' => esc_attr( $post_number ),
                        'no_found_rows'  => true,
                        'meta_query'     => array(
                            array( 'key' => '_thumbnail_id' ),
                        ),
                    );

    $portfolio_query = new WP_Query( $portfolio_args );
    
    if ( $portfolio_query->have_posts() ) : ?>

        <div class="tt-portfolio tt-portfolio-col-<?php echo esc_attr( $post_column ); ?>">

            <?php

            $taxonomy = 'tt-categories';
            $terms = get_terms($taxonomy); // Get all terms of a taxonomy

            if ( $terms && !is_wp_error( $terms ) ) :
            ?>
                <ul class="filter-list">
                     <li class="filter" data-filter="all"><?php echo esc_html__( 'All', 'theme-toolkit' ); ?></li>
                    <?php foreach ( $terms as $term ) { ?>
                       <li class="filter" data-filter="<?php echo $term->slug; ?>"><?php echo $term->name; ?></li>
                    <?php } ?>
                </ul>
            <?php endif;?>
            <div class="tt-portfolio-item-main">
                <?php 
                while ( $portfolio_query->have_posts() ) :

                    $portfolio_query->the_post();

                    $post_id    = get_the_ID();

                    $terms      = wp_get_post_terms( absint($post_id), 'tt-categories');

                    $portfolio_terms = '';

                    foreach ($terms as $term) {

                        $portfolio_terms .= $term->slug.' ';
                       
                    } ?>
                    <div class="tt-portfolio-item <?php echo esc_html( $portfolio_terms ); ?>">
                        <div class="tt-portfolio-wrapper">
                        
                            <div class="tt-portfolio-thumb">
                                <?php 
                                if ( has_post_thumbnail() ){ 
                                    the_post_thumbnail( esc_attr( $featured_image ) );
                                }?>
                            </div>

                            <div class="tt-portfolio-text-wrap">
                                  <h3 class="tt-portfolio-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                  </h3>
                            </div>
                        </div>
                    </div> 

                    <?php 
                endwhile; 

                wp_reset_postdata(); ?>

            </div><!-- #portfolio -->

        </div><!-- .portfolio-widget -->

    <?php endif;

}

function theme_toolkit_show_portfolio( $atts ) {

    extract( shortcode_atts( 
        array( 
            'post_number'  => 40,
            'column'       => 4,
            'image_size'   => 'full',
        ), 
        $atts 
    ));

    ob_start();

    theme_toolkit_portfolio_widget_call( $post_number, $column, $image_size );

    return ob_get_clean();
}

add_shortcode( 'tt-portfolio', 'theme_toolkit_show_portfolio' );