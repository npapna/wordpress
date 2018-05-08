<?php
/**
 * Custom widgets.
 *
 * @package Business_Kit
 */

if ( ! function_exists( 'business_kit_load_widgets' ) ) :

	/**
	 * Load widgets.
	 *
	 * @since 1.0.0
	 */
	function business_kit_load_widgets() {

		// Social.
		register_widget( 'Business_Kit_Social_Widget' );

		// Latest news.
		register_widget( 'Business_Kit_Latest_News_Widget' );

		// CTA widget.
		register_widget( 'Business_Kit_CTA_Widget' );

		// Services widget.
		register_widget( 'Business_Kit_Services_Widget' );

		// About Us widget.
		register_widget( 'Business_Kit_About_Widget' );

		// Features widget.
		register_widget( 'Business_Kit_Features_Widget' );

	}

endif;

add_action( 'widgets_init', 'business_kit_load_widgets' );

if ( ! class_exists( 'Business_Kit_Social_Widget' ) ) :

	/**
	 * Social widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Kit_Social_Widget extends WP_Widget {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'   => 'business-kit-social social-widgets',
				'description' => esc_html__( 'Widget to display social links with icon', 'business-kit' ),
			);
			parent::__construct( 'business-kit-social', esc_html__( 'BK: Social', 'business-kit' ), $opts );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			if ( ! empty( $title ) ) {
				echo $args['before_title'] . esc_html( $title ). $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            {@see WP_Widget::form()}.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] = sanitize_text_field( $new_instance['title'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 * @return void
		 */
		function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, array(
				'title' => '',
			) );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'business-kit' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<?php if ( ! has_nav_menu( 'social' ) ) : ?>
	        <p>
				<?php esc_html_e( 'Social menu is not set. Please create menu and assign it to Social Link Location.', 'business-kit' ); ?>
	        </p>
	        <?php endif; ?>
			<?php
		}
	}

endif;


if ( ! class_exists( 'Business_Kit_Latest_News_Widget' ) ) :

	/**
	 * Latest News widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Kit_Latest_News_Widget extends WP_Widget {

	    function __construct() {
	    	$opts = array(
				'classname'   => 'business-kit-latest-news blog-section grey-bg',
				'description' => esc_html__( 'Latest News Widget', 'business-kit' ),
    		);

			parent::__construct( 'business-kit-latest-news', esc_html__( 'BK: Latest News', 'business-kit' ), $opts );
	    }


	    function widget( $args, $instance ) {

			$title             	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$sub_title 	 		= !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';

			$post_category     	= ! empty( $instance['post_category'] ) ? $instance['post_category'] : 0;

			$exclude_categories = !empty( $instance[ 'exclude_categories' ] ) ? esc_attr( $instance[ 'exclude_categories' ] ) : '';

			$excerpt_length 	= !empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : '';

			$disable_author  	= ! empty( $instance['disable_author'] ) ? $instance['disable_author'] : 0;


			$disable_date   	= ! empty( $instance['disable_date'] ) ? $instance['disable_date'] : 0;

	        echo $args['before_widget']; 

    		if ( !empty( $title ) || !empty( $sub_title ) ){ ?>

    			<div class="section-title">

    		        <?php 

    		        if ( $title ) { ?>

    		        	<p><?php echo esc_html( $title ); ?></p>

    		        	<?php 
    		        	
    		        }

    		        if ( $sub_title ) { 

    		        	echo $args['before_title'] . esc_html( $sub_title ) . $args['after_title'];
    		        	
    		        } ?>

    	        </div>
            	<?php 
            } ?>

	        <div id="blogs" class="blog-wrapper blog-col-3">

		        <?php

		        $query_args = array(
					        	'posts_per_page' 		=> 3,
					        	'no_found_rows'  		=> true,
					        	'post__not_in'          => get_option( 'sticky_posts' ),
					        	'ignore_sticky_posts'   => true,
				        	);

		        if ( absint( $post_category ) > 0 ) {

		        	$query_args['cat'] = absint( $post_category );
		        	
		        }

		        if ( !empty( $exclude_categories ) ) {

		        	$exclude_ids = explode(',', $exclude_categories);

		        	$query_args['category__not_in'] = $exclude_ids;

		        }

		        $all_posts = new WP_Query( $query_args );

		        if ( $all_posts->have_posts() ) :?>

			        <div class="inner-wrapper">

						<?php 

						while ( $all_posts->have_posts() ) :

                            $all_posts->the_post(); ?>

                            	<div class="blog-item">
                            	     <div class="blog-inner">
                            	     	 <?php if ( has_post_thumbnail() ) :  ?>
	                            	         <div class="blog-thumb">
	                            	            <?php the_post_thumbnail( 'business-kit-news' ); ?>
	                            	         </div>
                            	         <?php endif; ?>

                            	         <div class="blog-text-wrap">
                            	            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                            	            <?php 

                            	            $blog_content = business_kit_get_the_excerpt( absint($excerpt_length) );
                            	             
                            	            echo wp_kses_post($blog_content) ? wpautop( wp_kses_post($blog_content) ) : '';

                            	            if( 1 != $disable_author ){ ?>

                            	            	<span class="byline"><?php the_author(); ?></span>

                            	            	<?php 
                            	            } 

                            	            if( 1 != $disable_date ){ ?>
                            	            	<span class="posted-on"><?php echo esc_html( get_the_date() ); ?></span>
                            	            	<?php 
                            	           	} ?>
                            	         </div>
                            	     </div> <!-- .blog-inner -->
                            	</div> <!-- .blog-item -->

			                <?php 

						endwhile; 

                        wp_reset_postdata(); ?>

                    </div>

		        <?php endif; ?>

	        </div><!-- .latest-news-widget -->

	        <?php
	        echo $args['after_widget'];

	    }

	    function update( $new_instance, $old_instance ) {
	        $instance = $old_instance;
			$instance['title']          	= sanitize_text_field( $new_instance['title'] );
			$instance['sub_title'] 		    = sanitize_text_field( $new_instance['sub_title'] );
			$instance['post_category']  	= absint( $new_instance['post_category'] );
			$instance['exclude_categories'] = sanitize_text_field( $new_instance['exclude_categories'] );
			$instance['excerpt_length']  	= absint( $new_instance['excerpt_length'] );
			$instance['disable_author']    	= (bool) $new_instance['disable_author'] ? 1 : 0;
			$instance['disable_date']    	= (bool) $new_instance['disable_date'] ? 1 : 0;

	        return $instance;
	    }

	    function form( $instance ) {

	        $instance = wp_parse_args( (array) $instance, array(
				'title'          		=> '',
				'sub_title' 			=> '',
				'post_category'  		=> '',
				'exclude_categories' 	=> '',
				'excerpt_length'  		=> 15,
				'disable_author'   		=> 0,
				'disable_date'   		=> 0,
	        ) );
	        ?>
	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'business-kit' ); ?></strong></label>
	          <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	        </p>
	        <p>
	        	<label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'business-kit' ); ?></strong></label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
	        </p>
	        <p>
	          <label for="<?php echo  esc_attr( $this->get_field_id( 'post_category' ) ); ?>"><strong><?php esc_html_e( 'Select Category:', 'business-kit' ); ?></strong></label>
				<?php
	            $cat_args = array(
	                'orderby'         => 'name',
	                'hide_empty'      => 0,
	                'class' 		  => 'widefat',
	                'taxonomy'        => 'category',
	                'name'            => $this->get_field_name( 'post_category' ),
	                'id'              => $this->get_field_id( 'post_category' ),
	                'selected'        => absint( $instance['post_category'] ),
	                'show_option_all' => esc_html__( 'All Categories','business-kit' ),
	              );
	            wp_dropdown_categories( $cat_args );
				?>
	        </p>
            <p>
            	<label for="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>"><strong><?php esc_html_e( 'Exclude Categories:', 'business-kit' ); ?></strong></label>
            	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_categories' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['exclude_categories'] ); ?>" />
    	        <small>
    	        	<?php esc_html_e('Enter category id seperated with comma. Posts from these categories will be excluded from latest post listing.', 'business-kit'); ?>
    	        </small>
            </p>
            <p>
            	<label for="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>"><strong><?php esc_html_e( 'Excerpt Length:', 'business-kit' ); ?></strong></label>
            	<input class="small" id="<?php echo esc_attr( $this->get_field_id( 'excerpt_length' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'excerpt_length' ) ); ?>" type="number" value="<?php echo esc_attr( $instance['excerpt_length'] ); ?>" />
            </p>
	        <p>
	            <input class="checkbox" type="checkbox" <?php checked( $instance['disable_author'] ); ?> id="<?php echo $this->get_field_id( 'disable_author' ); ?>" name="<?php echo $this->get_field_name( 'disable_author' ); ?>" />
	            <label for="<?php echo $this->get_field_id( 'disable_author' ); ?>"><?php esc_html_e( 'Hide Post Author', 'business-kit' ); ?></label>
	        </p>
	        <p>
	            <input class="checkbox" type="checkbox" <?php checked( $instance['disable_date'] ); ?> id="<?php echo $this->get_field_id( 'disable_date' ); ?>" name="<?php echo $this->get_field_name( 'disable_date' ); ?>" />
	            <label for="<?php echo $this->get_field_id( 'disable_date' ); ?>"><?php esc_html_e( 'Hide Posted Date', 'business-kit' ); ?></label>
	        </p>
	        <?php
	    }

	}

endif;

if ( ! class_exists( 'Business_Kit_CTA_Widget' ) ) :

	/**
	 * CTA widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Kit_CTA_Widget extends WP_Widget {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'   => 'business-kit-cta advanced-cta-section overlay-dark',
				'description' => esc_html__( 'Call To Action Widget', 'business-kit' ),
			);
			parent::__construct( 'business-kit-cta', esc_html__( 'BK: CTA', 'business-kit' ), $opts );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			$title       = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
			$sub_title 	 = !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';
			$cta_page    = !empty( $instance['cta_page'] ) ? $instance['cta_page'] : ''; 
			$button_text = ! empty( $instance['button_text'] ) ? esc_html( $instance['button_text'] ) : '';
			$button_url  = ! empty( $instance['button_url'] ) ? esc_url( $instance['button_url'] ) : '';
			$bg_pic  	 = ! empty( $instance['bg_pic'] ) ? esc_url( $instance['bg_pic'] ) : '';

			// Add background image.
			if ( ! empty( $bg_pic ) ) {
				$background_style = '';
				$background_style .= ' style="background-image:url(' . esc_url( $bg_pic ) . ');" ';
				$args['before_widget'] = implode( $background_style . ' ' . 'class="bg_enabled ', explode( 'class="', $args['before_widget'], 2 ) );
			}

			echo $args['before_widget']; 

			if ( $cta_page ) { 

				$cta_args = array(
								'posts_per_page' => 1,
								'page_id'	     => absint( $cta_page ),
								'post_type'      => 'page',
								'post_status'  	 => 'publish',
							);

				$cta_query = new WP_Query( $cta_args );	

				if( $cta_query->have_posts()){

					while( $cta_query->have_posts()){

						$cta_query->the_post(); ?>

						<div class="cta-content">
							<?php 
							if ( ! empty( $title ) ) { ?>
								<h3><?php echo esc_html( $title ); ?></h3>
								<?php
							}

							if ( $sub_title ) { 

								echo $args['before_title'] . esc_html( $sub_title ) . $args['after_title'];
								
							} 

							the_content(); 
							
							if ( ! empty( $button_text ) ) : ?>
								<a href="<?php echo esc_url( $button_url ); ?>" class="button cta-button cta-button-primary"><?php echo esc_html( $button_text ); ?></a>
							<?php endif; ?>
						</div>

						<?php

					}

					wp_reset_postdata();

				} 
			} 

			echo $args['after_widget'];

		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            {@see WP_Widget::form()}.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title'] 			= sanitize_text_field( $new_instance['title'] );

			$instance['sub_title'] 		= sanitize_text_field( $new_instance['sub_title'] );

			$instance['cta_page'] 	 	= absint( $new_instance['cta_page'] );

			$instance['button_text'] 	= sanitize_text_field( $new_instance['button_text'] );
			$instance['button_url']  	= esc_url_raw( $new_instance['button_url'] );

			$instance['bg_pic']  	 	= esc_url_raw( $new_instance['bg_pic'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 */
		function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, array(
				'title'       			=> '',
				'sub_title' 			=> '',
				'cta_page'    			=> '',
				'button_text' 			=> esc_html__( 'Find More', 'business-kit' ),
				'button_url'  			=> '',
				'bg_pic'      			=> '',
			) );

			$bg_pic = '';

            if ( ! empty( $instance['bg_pic'] ) ) {

                $bg_pic = $instance['bg_pic'];

            }

            $wrap_style = '';

            if ( empty( $bg_pic ) ) {

                $wrap_style = ' style="display:none;" ';
            }

            $image_status = false;

            if ( ! empty( $bg_pic ) ) {
                $image_status = true;
            }

            $delete_button = 'display:none;';

            if ( true === $image_status ) {
                $delete_button = 'display:inline-block;';
            }
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<p>
	        	<label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'business-kit' ); ?></strong></label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
	        </p>
	        
			<p>
				<label for="<?php echo $this->get_field_id( 'cta_page' ); ?>">
					<strong><?php esc_html_e( 'CTA Page:', 'business-kit' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'cta_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'cta_page' ),
					'selected'         => esc_attr( $instance[ 'cta_page' ] ),
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'business-kit' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Content of this page will be used as content of CTA', 'business-kit'); ?>
		        </small>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>"><strong><?php esc_html_e( 'Button Text:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_text' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['button_text'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>"><strong><?php esc_html_e( 'Button URL:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'button_url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'button_url' ) ); ?>" type="text" value="<?php echo esc_url( $instance['button_url'] ); ?>" />
			</p>

			<div class="cover-image">
                <label for="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>">
                    <strong><?php esc_html_e( 'Background Image:', 'business-kit' ); ?></strong>
                </label>
                <input type="text" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'bg_pic' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'bg_pic' ) ); ?>" value="<?php echo esc_url( $instance['bg_pic'] ); ?>" />
                <div class="rtam-preview-wrap" <?php echo $wrap_style; ?>>
                    <img src="<?php echo esc_url( $bg_pic ); ?>" alt="<?php esc_attr_e( 'Preview', 'business-kit' ); ?>" />
                </div><!-- .rtam-preview-wrap -->
                <input type="button" class="select-img button button-primary" value="<?php esc_attr_e( 'Upload', 'business-kit' ); ?>" data-uploader_title="<?php esc_attr_e( 'Select Background Image', 'business-kit' ); ?>" data-uploader_button_text="<?php esc_attr_e( 'Choose Image', 'business-kit' ); ?>" />
                <input type="button" value="<?php echo esc_attr_x( 'X', 'Remove Button', 'business-kit' ); ?>" class="button button-secondary btn-image-remove" style="<?php echo esc_attr( $delete_button ); ?>" />
            </div>
		<?php
		} 
	
	}

endif;

if ( ! class_exists( 'Business_Kit_Services_Widget' ) ) :

	/**
	 * Service widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Kit_Services_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'business-kit-services services-section',
					'description' => esc_html__( 'Widget to display services with image, title and short description.', 'business-kit' ),
			);
			parent::__construct( 'business-kit-services', esc_html__( 'BK: Services', 'business-kit' ), $opts );
		}

		function widget( $args, $instance ) {

			$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$sub_title 	 	= !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';

			$disable_link  	= ! empty( $instance['disable_link'] ) ? $instance['disable_link'] : 0;

			$services_ids 	= array();

			$item_number 	= 9;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				if ( ! empty( $instance["item_id_$i"] ) && absint( $instance["item_id_$i"] ) > 0 ) {
					$id = absint( $instance["item_id_$i"] );
					$services_ids[ $id ]['id']   = $id;
					$services_ids[ $id ]['desc'] = $instance["item_desc_$i"];
				}
			}

			echo $args['before_widget'];

			if ( !empty( $title ) || !empty( $sub_title ) ){ ?>

				<div class="section-title">

			        <?php 

			        if ( $title ) { ?>

			        	<p><?php echo esc_html( $title ); ?></p>

			        	<?php 
			        	
			        }

			        if ( $sub_title ) { 

			        	echo $args['before_title'] . esc_html( $sub_title ) . $args['after_title'];
			        	
			        } ?>

		        </div>
	        	<?php 
	        } ?>

			<div id="service" class="services-wrapper service-col-3">

				<?php

				if ( ! empty( $services_ids ) ) {
					$query_args = array(
						'posts_per_page' => count( $services_ids ),
						'post__in'       => wp_list_pluck( $services_ids, 'id' ),
						'orderby'        => 'post__in',
						'post_type'      => 'page',
						'no_found_rows'  => true,
					);
					$all_services = get_posts( $query_args ); ?>

					<?php if ( ! empty( $all_services ) ) : ?>
						<?php global $post; ?>
						
							<div class="inner-wrapper">

								<?php foreach ( $all_services as $post ) : ?>
									<?php setup_postdata( $post ); ?>
									<div class="service-item">
									  <div class="service-inner">
									  	<?php if ( has_post_thumbnail() ) :  ?>
	                            	         <div class="service-thumb">
	                            	            <?php the_post_thumbnail( 'business-kit-services' ); ?>
	                            	         </div>
                            	         <?php endif; ?>
									      

									      <div class="service-text-wrap">
									      	<?php

									      	if( 1 === $disable_link){ ?>

									      		<h2><?php the_title(); ?></h2>

									      		<?php

									      	}else{ ?>

									        	<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

									        	<?php 
									        } 

									        if( !empty( $services_ids[ $post->ID ]['desc'] ) ){ ?>

									        	<p><?php echo esc_html( $services_ids[ $post->ID ]['desc'] ); ?></p>

									          	<?php 
									        } ?>
									      </div> <!-- .service-text-wrap -->
									  </div>
									</div> <!-- .service-item -->
								<?php endforeach; ?>

							</div><!-- .inner-wrapper -->

						<?php wp_reset_postdata(); ?>

					<?php endif;
				} ?>

			</div><!-- .services-list -->

			<?php

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] 			= sanitize_text_field( $new_instance['title'] );

			$instance['sub_title'] 		= sanitize_text_field( $new_instance['sub_title'] );

			$instance['disable_link']   = (bool) $new_instance['disable_link'] ? 1 : 0;

			$item_number = 9;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$instance["item_id_$i"]   = absint( $new_instance["item_id_$i"] );
				$instance["item_desc_$i"] = sanitize_text_field( $new_instance["item_desc_$i"] );
			}

			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
							'title' 			=> '',
							'sub_title' 		=> '',
							'disable_link'   	=> 0,
						);

			$item_number = 9;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$defaults["item_id_$i"]   = '';
				$defaults["item_desc_$i"] = '';
			}

			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
			</p>

			<p>
			    <input class="checkbox" type="checkbox" <?php checked( $instance['disable_link'] ); ?> id="<?php echo $this->get_field_id( 'disable_link' ); ?>" name="<?php echo $this->get_field_name( 'disable_link' ); ?>" />
			    <label for="<?php echo $this->get_field_id( 'disable_link' ); ?>"><?php esc_html_e( 'Disable link to detail page', 'business-kit' ); ?></label>
			</p>
			
			<?php
				for ( $i = 1; $i <= $item_number; $i++ ) {
					?>
					<hr>
					<p>
						<label for="<?php echo $this->get_field_id( "item_id_$i" ); ?>"><strong><?php esc_html_e( 'Page:', 'business-kit' ); ?>&nbsp;<?php echo $i; ?></strong></label>
						<?php
						wp_dropdown_pages( array(
							'id'               => $this->get_field_id( "item_id_$i" ),
							'class'            => 'widefat',
							'name'             => $this->get_field_name( "item_id_$i" ),
							'selected'         => esc_attr( $instance["item_id_$i"] ),
							'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'business-kit' ),
							)
						);
						?>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( "item_desc_$i" ) ); ?>"><strong><?php esc_html_e( 'Short Description:', 'business-kit' ); ?></strong></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "item_desc_$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "item_desc_$i" ) ); ?>" type="text" value="<?php echo esc_attr( $instance["item_desc_$i"] ); ?>" />
					</p>
					<?php 
				}
		}
	}

endif;

if ( ! class_exists( 'Business_Kit_About_Widget' ) ) :

	/**
	 * About Us widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Kit_About_Widget extends WP_Widget {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$opts = array(
				'classname'   => 'business-kit-about about-us-section',
				'description' => esc_html__( 'Widget to display about us section', 'business-kit' ),
			);
			parent::__construct( 'business-kit-about', esc_html__( 'BK: About Us', 'business-kit' ), $opts );

		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {
			$title       	= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$sub_title 	 	= !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';

			
			$about_page  	= !empty( $instance['about_page'] ) ? $instance['about_page'] : ''; 

			$image_alignment = !empty( $instance['image_alignment'] ) ? $instance['image_alignment'] : '';

			$excerpt_length	= !empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;

			$read_more_text	= !empty( $instance['read_more_text'] ) ? $instance['read_more_text'] : '';


			echo $args['before_widget']; ?>

			<div class="about-us-wrapper">
				
				<?php 

				$about_img = get_the_post_thumbnail_url( $about_page, 'full' );

				if( !empty( $about_img ) ){ ?>

					<div class="image-holder">

						<img src="<?php echo esc_url( $about_img ); ?>">

					</div><!-- .skill-image -->

					<?php

				} ?>

				<div class="description-holder">

					
					<?php

					if ( $title ) { ?>

						<h3><?php echo esc_html( $title ); ?></h3>

						<?php 
						
					}

					if ( $sub_title ) { ?>

						<h2><?php echo esc_html( $sub_title ); ?></h2>

						<?php 
					} 

					if ( $about_page ) { 

						$about_args = array(
										'posts_per_page' => 1,
										'page_id'	     => absint( $about_page ),
										'post_type'      => 'page',
										'post_status'  	 => 'publish',
									);

						$about_query = new WP_Query( $about_args );	

						if( $about_query->have_posts()){

							while( $about_query->have_posts()){

								$about_query->the_post(); ?>

								<div class="about-text">
									<?php 
									$content = business_kit_get_the_excerpt( absint( $excerpt_length ) );
									
									echo $content ? wpautop( wp_kses_post( $content ) ) : '';

									if ( ! empty( $read_more_text ) ) {

										echo '<a href="' . esc_url( get_permalink() ) . '" class="button">' . esc_html( $read_more_text ) . '</a>';

									} ?>
									
								</div>

								<?php

							}

							wp_reset_postdata();

						} 

					} ?>

				</div>
			</div><!-- .about-widget -->

			<?php
			echo $args['after_widget'];

		}

		/**
		 * Update widget instance.
		 *
		 * @since 1.0.0
		 *
		 * @param array $new_instance New settings for this instance as input by the user via
		 *                            {@see WP_Widget::form()}.
		 * @param array $old_instance Old settings for this instance.
		 * @return array Settings to save or bool false to cancel saving.
		 */
		function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			$instance['title'] 				= sanitize_text_field( $new_instance['title'] );

			$instance['sub_title'] 			= sanitize_text_field( $new_instance['sub_title'] );

			$instance['about_page'] 		= absint( $new_instance['about_page'] );

			$instance['image_alignment'] 	= $new_instance['image_alignment'];

			$instance['excerpt_length'] 	= absint( $new_instance['excerpt_length'] );

			$instance['read_more_text'] 	= sanitize_text_field( $new_instance['read_more_text'] );

			return $instance;
		}

		/**
		 * Output the settings update form.
		 *
		 * @since 1.0.0
		 *
		 * @param array $instance Current settings.
		 */
		function form( $instance ) {

			$instance = wp_parse_args( (array) $instance, array(
				'title'       			=> '',
				'sub_title' 			=> '',
				'about_page'    		=> '',
				'image_alignment'   	=> 'right',
				'excerpt_length'		=> 45,
				'read_more_text'		=> esc_html__( 'Read More', 'business-kit' ),
			) );

			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'about_page' ); ?>">
					<strong><?php esc_html_e( 'Select Page:', 'business-kit' ); ?></strong>
				</label>
				<?php
				wp_dropdown_pages( array(
					'id'               => $this->get_field_id( 'about_page' ),
					'class'            => 'widefat',
					'name'             => $this->get_field_name( 'about_page' ),
					'selected'         => esc_attr( $instance[ 'about_page' ] ),
					'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'business-kit' ),
					)
				);
				?>
				<small>
		        	<?php esc_html_e('Content and featured image of this page will be used as content of about us section', 'business-kit'); ?>	
		        </small>
			</p>

	        <p>
	          <label for="<?php echo esc_attr( $this->get_field_id( 'image_alignment' ) ); ?>"><strong><?php _e( 'Image Position:', 'business-kit' ); ?></strong></label>
				<?php
	            $this->dropdown_image_alignment( array(
					'id'       => $this->get_field_id( 'image_alignment' ),
					'name'     => $this->get_field_name( 'image_alignment' ),
					'selected' => esc_attr( $instance['image_alignment'] ),
					)
	            );
				?>
	        </p>

	        <p>
	        	<label for="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>">
	        		<?php esc_html_e('Excerpt Length:', 'business-kit'); ?>
	        	</label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('excerpt_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>" type="number" value="<?php echo absint( $instance['excerpt_length'] ); ?>" />
	        </p>

	        <p>
	        	<label for="<?php echo esc_attr( $this->get_field_id( 'read_more_text' ) ); ?>"><strong><?php esc_html_e( 'Read More Text:', 'business-kit' ); ?></strong></label>
	        	<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'read_more_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'read_more_text' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['read_more_text'] ); ?>" />
	        	<small>
	        		<?php esc_html_e('Leave this field empty if you want to hide read more button', 'business-kit'); ?>	
	        	</small>
	        </p>

	        
		<?php
		}

	    function dropdown_image_alignment( $args ) {
			$defaults = array(
		        'id'       => '',
		        'class'    => 'widefat',
		        'name'     => '',
		        'selected' => 'right',
			);

			$r = wp_parse_args( $args, $defaults );
			$output = '';

			$choices = array(
				'left' 		=> esc_html__( 'Left', 'business-kit' ),
				'right' 	=> esc_html__( 'Right', 'business-kit' ),
			);

			if ( ! empty( $choices ) ) {

				$output = "<select name='" . esc_attr( $r['name'] ) . "' id='" . esc_attr( $r['id'] ) . "' class='" . esc_attr( $r['class'] ) . "'>\n";
				foreach ( $choices as $key => $choice ) {
					$output .= '<option value="' . esc_attr( $key ) . '" ';
					$output .= selected( $r['selected'], $key, false );
					$output .= '>' . esc_html( $choice ) . '</option>\n';
				}
				$output .= "</select>\n";
			}

			echo $output;
	    } 
	
	}

endif;

if ( ! class_exists( 'Business_Kit_Features_Widget' ) ) :

	/**
	 * Features widget class.
	 *
	 * @since 1.0.0
	 */
	class Business_Kit_Features_Widget extends WP_Widget {

		function __construct() {
			$opts = array(
					'classname'   => 'business-kit-features features-section',
					'description' => esc_html__( 'Widget to display features with icon', 'business-kit' ),
			);
			parent::__construct( 'business-kit-features', esc_html__( 'BK: Features', 'business-kit' ), $opts );
		}

		function widget( $args, $instance ) {

			$title 			= apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			$sub_title 	 	= !empty( $instance['sub_title'] ) ? $instance['sub_title'] : '';

			$excerpt_length	= !empty( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 20;

			$disable_link  	= ! empty( $instance['disable_link'] ) ? $instance['disable_link'] : 0;

			$features_ids 	= array();

			$item_number 	= 9;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				if ( ! empty( $instance["item_id_$i"] ) && absint( $instance["item_id_$i"] ) > 0 ) {
					$id = absint( $instance["item_id_$i"] );
					$features_ids[ $id ]['id']   = $id;
					$features_ids[ $id ]['icon'] = $instance["item_icon_$i"];
				}
			}

			echo $args['before_widget']; ?>

			<div class="features-holder">

				<?php

				if ( !empty( $title ) || !empty( $sub_title ) ){ ?>

					<div class="section-title">

				        <?php 

				        if ( $title ) { ?>

				        	<p><?php echo esc_html( $title ); ?></p>

				        	<?php 
				        	
				        }

				        if ( $sub_title ) { 

				        	echo $args['before_title'] . esc_html( $sub_title ) . $args['after_title'];
				        	
				        } ?>

			        </div>
		        	<?php 
		        } ?>
	        
				<div class="features-wrapper">
					
					<?php

					if ( ! empty( $features_ids ) ) {
						$query_args = array(
							'posts_per_page' => count( $features_ids ),
							'post__in'       => wp_list_pluck( $features_ids, 'id' ),
							'orderby'        => 'post__in',
							'post_type'      => 'page',
							'no_found_rows'  => true,
						);
						$all_features = get_posts( $query_args ); ?>

						<?php if ( ! empty( $all_features ) ) : ?>
							<?php global $post; ?>
							
								<div class="inner-wrapper">

									<?php foreach ( $all_features as $post ) : ?>
										<?php setup_postdata( $post ); ?>

										<div class="features-item">

										    <div class="features-inner">

										        <div class="feature-icon">
										            <span class="<?php echo esc_attr( $features_ids[ $post->ID ]['icon'] ); ?>"></span>
										        </div> <!-- .feature-icon -->

										        <div class="features-text-wrap">
										            
									            	<?php

									            	if( 1 === $disable_link){ ?>

									            		<h2><?php the_title(); ?></h2>

									            		<?php

									            	}else{ ?>

										            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

										              	<?php 
										            } 
										            
										            $content = business_kit_get_the_excerpt( absint( $excerpt_length ), $post );
										            
										            echo $content ? wpautop( wp_kses_post( $content ) ) : ''; 
										            ?>
										        </div>

										    </div> <!-- .features-inner -->

										</div> <!-- .features-item -->

									<?php endforeach; ?>

								</div><!-- .inner-wrapper -->

							<?php wp_reset_postdata(); ?>

						<?php endif;
					} ?>

				</div><!-- .features-wrapper -->

			</div>

			<?php

			echo $args['after_widget'];

		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['title'] 			= sanitize_text_field( $new_instance['title'] );

			$instance['sub_title'] 		= sanitize_text_field( $new_instance['sub_title'] );

			$instance['excerpt_length'] = absint( $new_instance['excerpt_length'] );

			$instance['disable_link']   = (bool) $new_instance['disable_link'] ? 1 : 0;

			$item_number = 9;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$instance["item_id_$i"]   = absint( $new_instance["item_id_$i"] );
				$instance["item_icon_$i"] = sanitize_text_field( $new_instance["item_icon_$i"] );
			}

			return $instance;
		}

		function form( $instance ) {

			// Defaults.
			$defaults = array(
							'title' 			=> '',
							'sub_title' 		=> '',
							'excerpt_length'	=> 20,
							'disable_link'   	=> 1,
						);

			$item_number = 9;

			for ( $i = 1; $i <= $item_number; $i++ ) {
				$defaults["item_id_$i"]   = '';
				$defaults["item_icon_$i"] = 'icon-pencil';
			}

			$instance = wp_parse_args( (array) $instance, $defaults );
			?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><strong><?php esc_html_e( 'Title:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>"><strong><?php esc_html_e( 'Sub Title:', 'business-kit' ); ?></strong></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sub_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sub_title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['sub_title'] ); ?>" />
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>">
					<?php esc_html_e('Excerpt Length:', 'business-kit'); ?>
				</label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('excerpt_length') ); ?>" name="<?php echo esc_attr( $this->get_field_name('excerpt_length') ); ?>" type="number" value="<?php echo absint( $instance['excerpt_length'] ); ?>" />
			</p>

			<p>
			    <input class="checkbox" type="checkbox" <?php checked( $instance['disable_link'] ); ?> id="<?php echo $this->get_field_id( 'disable_link' ); ?>" name="<?php echo $this->get_field_name( 'disable_link' ); ?>" />
			    <label for="<?php echo $this->get_field_id( 'disable_link' ); ?>"><?php esc_html_e( 'Disable link to detail page', 'business-kit' ); ?></label>
			</p>

	        <p>
		        <small>
		        	
		        	<?php printf( esc_html__( '%1$s %2$s', 'business-kit' ), 'ICONS ET-LINE is used for icon of each feature. You can find icon code', '<a href="http://rhythm.nikadevs.com/content/icons-et-line" target="_blank">here</a>' ); ?>
		        </small>
	        </p>

			<?php
				for ( $i = 1; $i <= $item_number; $i++ ) {
					?>
					<hr>
					<p>
						<label for="<?php echo $this->get_field_id( "item_id_$i" ); ?>"><strong><?php esc_html_e( 'Page:', 'business-kit' ); ?>&nbsp;<?php echo $i; ?></strong></label>
						<?php
						wp_dropdown_pages( array(
							'id'               => $this->get_field_id( "item_id_$i" ),
							'class'            => 'widefat',
							'name'             => $this->get_field_name( "item_id_$i" ),
							'selected'         => esc_attr( $instance["item_id_$i"] ),
							'show_option_none' => esc_html__( '&mdash; Select &mdash;', 'business-kit' ),
							)
						);
						?>
					</p>
					<p>
						<label for="<?php echo esc_attr( $this->get_field_id( "item_icon_$i" ) ); ?>"><strong><?php esc_html_e( 'Icon:', 'business-kit' ); ?>&nbsp;<?php echo $i; ?></strong></label>
						<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "item_icon_$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "item_icon_$i" ) ); ?>" type="text" value="<?php echo esc_attr( $instance["item_icon_$i"] ); ?>" />
					</p>
					<?php 
				}
		}
	}

endif;