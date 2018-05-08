<?php
        if(!function_exists( 'parallaxsome_register_fonts' ) ) {

                function parallaxsome_register_fonts () {
                        $typos = array(
                            'p' => 'Roboto Slab',
                            'h1' => 'Lato',
                            'h2' => 'BenchNine',
                            'h3' => 'Source Sans Pro',
                            'h4' => 'Lato',
                            'h5' => 'Lato',
                            'h6' => 'Lato',
                            'hm_sec_title' => 'BenchNine',
                            'hm_sec_subtitle' => 'BenchNine',
                        );

                        foreach( $typos as $initial => $default_font ) {
                                $font_family = array();
                                $font_family[$initial] = get_theme_mod($initial.'_font_family', $default_font);

                                wp_register_style( 'parallaxsome-'.esc_attr($initial).'-font', '//fonts.googleapis.com/css?family='.$font_family[$initial] );
                                wp_enqueue_style( 'parallaxsome-'.esc_attr($initial).'-font');
                        }
                }

                add_action( 'wp_head', 'parallaxsome_register_fonts' );

        }


        function parallaxsome_dynamic_styles() {

                /** Template Color Styles **/
                $tpl_color = sanitize_hex_color(get_theme_mod( 'parallaxsome_tpl_color', '#e23815' ));
                $lite_tpl_color = parallaxsome_colour_brightness($tpl_color, 0.8);
                $custom_css = "
                        .main-navigation ul.menu > li > a:after,
                        .single-slide-wrap .slider-title:before,
                        .single-slide-wrap .slider-title:after,
                        .ps-front-slider-wrapper .bx-wrapper .bx-pager.bx-default-pager a:hover,
                        .ps-front-slider-wrapper .bx-wrapper .bx-pager.bx-default-pager a.active,
                        .service-tab-content .content-right .ps-btn,
                        .service-tab-content .tab-pane .ps-btn,
                        .ps-home-section#section-fact .ps-fact-icon,
                        #section-portfolio .project-icons a,
                        .ps-protfolio-wrapper ul#psProjects li:hover .project-info-wrap,
                        #section-blog .ps-section-viewall a:hover,
                        #section-contact input[type=submit],
                        .footer-social-wrap .ps-social-icons-wrapper a:hover,
                        #scroll-up,
                        .ps-section-viewall a:hover,
                        .widget_search input[type=submit], .archive #primary .search-submit,
                        .comments-area .form-submit input[type=submit],
                        .nav-links .page-numbers.current,
                        .nav-links a.page-numbers:hover,
                        .nav-links .page-numbers.current,
                        .nav-links a.page-numbers:hover,
                        .comments-area .reply .comment-reply-link:hover{
                                background-color: {$tpl_color};
                        }";

                /** Lite Background **/
                        $custom_css .= "
                                #section-blog .ps-section-viewall a{
                                        background: {$lite_tpl_color};
                                }";
                        

                $custom_css .= "
                        .ps-head-search .ps-search-icon:before,
                        .ps-section-viewall a,
                        .service-nav-tab li a:hover,
                        .service-nav-tab li.active a,
                        .service-tab-content .content-right .ps-btn:hover,
                        .service-tab-content .tab-pane .ps-btn:hover,
                        a:hover, a:focus, a:active,
                        .ps-blog-poston a:hover,
                        #primary .blog-content-wrap a:hover,
                        a.ps-more-button:hover,
                        #section-contact .ps-num-label:before,
                        #section-contact .ps-mag-caption:hover,
                        #section-portfolio .project-icons a:hover,
                        #section-contact input[type=submit]:hover,
                        #section-contact .ps-add-label:before,
                        .ps-innerpages-header-wrapper #crumbs a,
                        .widget-title,
                        .widget-area .widget a:hover,
                        #primary .blog-content-wrap .cat-links a,
                        #primary article.post .entry-meta a:hover,
                        .comment-navigation a:hover:before,
                        .posts-navigation a:hover:before,
                        .post-navigation a:hover:before,
                        .comments-area .comments-title,
                        .comments-area .comment-reply-title,
                        .arcitle-more-btn a:hover,
                        .arcitle-more-btn a:hover:after,
                        .comments-area a:hover,
                        .comments-area .comment-author .fn a:hover,
                        .comments-area .reply .comment-reply-link,
                        .edit-link a:hover:before{
                                color: {$tpl_color};
                        }";

                $custom_css .= "
                        .ps-section-viewall a,
                        #section-portfolio .project-icons a,
                        a.ps-more-button:before,
                        a.ps-more-button:after,
                        #section-contact input[type=submit],
                        .footer-social-wrap .ps-social-icons-wrapper a:hover,
                        #section-blog .ps-section-viewall a,
                        .widget_search input[type=submit], .archive #primary .search-submit,
                        .comments-area .form-submit input[type=submit],
                        .nav-links .page-numbers.current,
                        nav-links a.page-numbers:hover,
                        .nav-links .page-numbers.current,
                        .nav-links a.page-numbers:hover,
                        .comments-area .reply .comment-reply-link:hover{
                                border-color: {$tpl_color};
                        }";

                $custom_css .= "
                        .ps-home-section#section-fact .ps-fact-icon:after{
                                border-color: transparent transparent transparent {$tpl_color};
                        }";

                /** Dynamic Typography Styles **/
                        $typos = array(
                                'p' => array(
                                        'apply_to' => 'body, body p',
                                        'font_family' => 'Roboto Slab', // font family
                                        'font_style' => '400', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'none',
                                        'font_size' => '16', // px
                                        'line_height' => '1.5', // em
                                        'color' => '#666666',
                                ),
                                'h1' => array(
                                        'apply_to' => 'H1',
                                        'font_family' => 'Lato', // font family
                                        'font_style' => '700', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'none',
                                        'font_size' => '32', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),
                                'h2' => array(
                                        'apply_to' => 'H2',
                                        'font_family' => 'BenchNine', // font family
                                        'font_style' => '700', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'none',
                                        'font_size' => '28', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),
                                'h3' => array(
                                        'apply_to' => 'H3',
                                        'font_family' => 'Source Sans Pro', // font family
                                        'font_style' => '700', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'none',
                                        'font_size' => '24', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),
                                'h4' => array(
                                        'apply_to' => 'H4',
                                        'font_family' => 'Lato', // font family
                                        'font_style' => '700', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'none',
                                        'font_size' => '20', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),
                                'h5' => array(
                                        'apply_to' => 'H5',
                                        'font_family' => 'Lato', // font family
                                        'font_style' => '700', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'none',
                                        'font_size' => '18', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),
                                'h6' => array(
                                        'apply_to' => 'H6',
                                        'font_family' => 'Lato', // font family
                                        'font_style' => '700', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'none',
                                        'font_size' => '16', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),
                                'hm_sec_title' => array(
                                        'apply_to' => '.ps-home-section .section-title',
                                        'font_family' => 'BenchNine', // font family
                                        'font_style' => '300', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'uppercase',
                                        'font_size' => '74', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),
                                'hm_sec_subtitle' => array(
                                        'apply_to' => '.section-sub-title',
                                        'font_family' => 'BenchNine', // font family
                                        'font_style' => '20', // font weight
                                        'text_decoration' => 'none',
                                        'text_transform' => 'uppercase',
                                        'font_size' => '16', // px
                                        'line_height' => '1', // em
                                        'color' => '#666666',
                                ),

                        );

                        foreach( $typos as $initial => $typo ) {
                                $apply_to = $typo['apply_to'];
                                $font_family = get_theme_mod( $initial . '_font_family', $typo['font_family'] );
                                $font_style = get_theme_mod( $initial . 'font_style', $typo['font_style'] );
                                $text_decoration = get_theme_mod( $initial . '_text_decoration', $typo['text_decoration'] );
                                $text_transform = get_theme_mod( $initial . '_text_transform', $typo['text_transform'] );
                                $font_size = get_theme_mod( $initial . '_font_size', $typo['font_size'] );
                                $line_height = get_theme_mod( $initial . '_line_height', $typo['line_height'] );
                                $color = get_theme_mod( $initial . '_color', $typo['color'] );
                                
                                $custom_css .= "
                                        {$apply_to}{
                                                font-family: {$font_family};
                                                font-weight: {$font_style};
                                                text-decoration: {$text_decoration};
                                                text-transform: {$text_transform};
                                                font-size: {$font_size}px;
                                                line-height: {$line_height}em;
                                                color: {$color};
                                        }";
                        }


                wp_add_inline_style( 'parallaxsome-style', $custom_css );
        }

        add_action( 'wp_enqueue_scripts', 'parallaxsome_dynamic_styles' );

        function parallaxsome_colour_brightness($hex, $percent) {
            // Work out if hash given
            $hash = '';
            if (stristr($hex, '#')) {
                $hex = str_replace('#', '', $hex);
                $hash = '#';
            }
            /// HEX TO RGB
            $rgb = array(hexdec(substr($hex, 0, 2)), hexdec(substr($hex, 2, 2)), hexdec(substr($hex, 4, 2)));
            //// CALCULATE 
            for ($i = 0; $i < 3; $i++) {
                // See if brighter or darker
                if ($percent > 0) {
                    // Lighter
                    $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
                } else {
                    // Darker
                    $positivePercent = $percent - ($percent * 2);
                    $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
                }
                // In case rounding up causes us to go to 256
                if ($rgb[$i] > 255) {
                    $rgb[$i] = 255;
                }
            }
            //// RBG to Hex
            $hex = '';
            for ($i = 0; $i < 3; $i++) {
                // Convert the decimal digit to hex
                $hexDigit = dechex($rgb[$i]);
                // Add a leading zero if necessary
                if (strlen($hexDigit) == 1) {
                    $hexDigit = "0" . $hexDigit;
                }
                // Append to the hex string
                $hex .= $hexDigit;
            }
            return $hash . $hex;
        }