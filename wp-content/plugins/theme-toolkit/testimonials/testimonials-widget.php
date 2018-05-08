<?php 

if ( ! function_exists( 'theme_toolkit_testimonials_widget' ) ) :

    /**
     * Load widget.
     *
     * @since 1.0.0
     */
    function theme_toolkit_testimonials_widget() {

        register_widget( 'Theme_Toolkit_Testimonials_Widget' );

    }

endif;

add_action( 'widgets_init', 'theme_toolkit_testimonials_widget' );

if ( ! class_exists( 'Theme_Toolkit_Testimonials_Widget' ) ) :

    /**
     * Our Team widget class.
     *
     * @since 1.0.0
     */
    class Theme_Toolkit_Testimonials_Widget extends WP_Widget {

        function __construct() {
            $opts = array(
                'classname'   => 'theme_toolkit_testimonials',
                'description' => __( 'Widget to display testimonials', 'theme-toolkit' ),
            );

            parent::__construct( 'theme-toolkit-testimonials', esc_html__( 'TT: Testimonials', 'theme-toolkit' ), $opts );
        }


        function widget( $args, $instance ) {

            $title             = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
            $sub_title         = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
            $post_number       = ! empty( $instance['post_number'] ) ? $instance['post_number'] : 5;

            echo $args['before_widget']; ?>

                <div class="tt-testimonials-wrap">

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

                    theme_toolkit_testimonials_widget_call( $post_number ); ?>
                
                </div>

                <?php
           
            echo $args['after_widget'];

        }

        function update( $new_instance, $old_instance ) {
            
            $instance = $old_instance;

            $instance['title']              = sanitize_text_field( $new_instance['title'] );
            $instance['sub_title']          = sanitize_text_field( $new_instance['sub_title'] );
            $instance['post_number']        = absint( $new_instance['post_number'] );

            return $instance;
        }

        function form( $instance ) {

            $instance = wp_parse_args( (array) $instance, array(
                'title'                 => '',
                'sub_title'             => '',
                'post_number'           => 4,
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

            <?php
        }

    }

endif;

function theme_toolkit_testimonials_widget_call( $post_number ){

    $testimonials_args = array(
                            'post_type'      => 'tt-testimonials',
                            'posts_per_page' => esc_attr( $post_number ),
                            'no_found_rows'  => true,
                        );

    $testimonials_query = new WP_Query( $testimonials_args );
     
    if ( $testimonials_query->have_posts() ) : ?>

      <div class="tt-testimonials">

        <div class="tt-testimonial-item-main">
       
            <?php while ( $testimonials_query->have_posts() ) : 

                    $testimonials_query->the_post(); ?>

                    <div class="tt-testimonial-item">

                        <div class="tt-testimonial-inner">

                            <?php

                            if( has_post_thumbnail() ){ ?>
                                <figure>
                                  <?php the_post_thumbnail( 'thumbnail' ); ?>  
                                </figure>
                            <?php } ?>
                            
                            <div class="tt-testimonial-caption">
                                <?php the_content(); ?>
                            </div> 

                            <div class="tt-testimonial-meta">
                                <span class="tt-testimonial-title"><?php the_title(); ?></span>
                            </div>

                        </div>

                    </div>

            <?php endwhile; 

            wp_reset_postdata(); ?>

        </div>

      </div><!-- .testimonials-widget -->

    <?php endif; 
}


function theme_toolkit_show_testimonials( $atts ) {

    extract( shortcode_atts( 
        array( 
            'post_number'   => 5,
        ), 
        $atts 
    ));

    ob_start();

    theme_toolkit_testimonials_widget_call( $post_number );

    return ob_get_clean();
}

add_shortcode( 'tt-testimonials', 'theme_toolkit_show_testimonials' );