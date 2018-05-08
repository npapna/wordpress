<?php
    /**
     * Typography control class.
     *
     * @since  1.0.0
     * @access public
     */
    class Parallaxsome_Typo_Control_Typography extends WP_Customize_Control { 
        /**
         * The type of customize control being rendered.
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $type = 'typography';
        /**
         * Array 
         *
         * @since  1.0.0
         * @access public
         * @var    string
         */
        public $l10n = array();
        /**
         * Set up our control.
         *
         * @since  1.0.0
         * @access public
         * @param  object  $manager
         * @param  string  $id
         * @param  array   $args
         * @return void
         */
        public function __construct( $manager, $id, $args = array() ) {
            // Let the parent class do its thing.
            parent::__construct( $manager, $id, $args );
            // Make sure we have labels.
            $this->l10n = wp_parse_args(
                $this->l10n,
                array(
                    'family'      => esc_html__( 'Font Family', 'parallaxsome' ),
                    'size'        => esc_html__( 'Font Size',   'parallaxsome' ),
                    'style'      => esc_html__( 'Font Weight/Style', 'parallaxsome' ),
                    'line_height' => esc_html__( 'Line Height', 'parallaxsome' ),
                    'text_decoration' => esc_html__( 'Text Decoration', 'parallaxsome' ),
                    'text_transform' => esc_html__( 'Text Transform', 'parallaxsome' ),
                    'typocolor' => esc_html__( 'Font Color label', 'parallaxsome' ),
                )
            );
        }
        /**
         * Enqueue scripts/styles.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function enqueue() {
            wp_enqueue_script( 'parallaxsome-customize-controls' );
            wp_enqueue_style(  'parallaxsome-customize-controls' );
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_style( 'wp-color-picker' );
        }
        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function to_json() {
            parent::to_json();
            // Loop through each of the settings and set up the data for it.
            foreach ( $this->settings as $setting_key => $setting_id ) {
                $this->json[ $setting_key ] = array(
                    'link'  => $this->get_link( $setting_key ),
                    'value' => $this->value( $setting_key ),
                    'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
                );

                if ( 'family' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_font_families();

                elseif ( 'style' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

                elseif ( 'text_transform' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_text_transform_choices();

                elseif ( 'text_decoration' === $setting_key )
                    $this->json[ $setting_key ]['choices'] = $this->get_text_decoration_choices();
            }
        }
        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.0.0
         * @access public
         * @return void
         */
        public function content_template() { 
            ?>
            <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
            <# } #>

            <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
            <# } #>
            <ul>
            <# if ( data.family && data.family.choices ) { #>
                <li class="typography-font-family">
                    <# if ( data.family.label ) { #>
                        <span class="customize-control-title">{{ data.family.label }}</span>
                    <# } #>
                    <select {{{ data.family.link }}} id="{{ data.section }}" class="typography_face">
                        <# _.each( data.family.choices, function( label, choice ) { #>
                            <option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
            <# } #>
            <# if ( data.style && data.style.choices ) { #>
                <li class="typography-font-style">
                    <# if ( data.style.label ) { #>
                        <span class="customize-control-title">{{ data.style.label }}</span>
                    <# } #>
                    <select {{{ data.style.link }}}>
                        <# _.each( data.style.choices, function( label, choice ) { #>
                            <option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>
                        <# } ) #>
                    </select>
                </li>
            <# } #>

            <# if ( data.text_transform && data.text_transform.choices ) { #>

                <li class="typography-text-transform">

                    <# if ( data.text_transform.label ) { #>
                        <span class="customize-control-title">{{ data.text_transform.label }}</span>
                    <# } #>

                    <select {{{ data.text_transform.link }}} class="typography_text_transform">

                        <# _.each( data.text_transform.choices, function( label, choice ) { #>

                            <option value="{{ choice }}" <# if ( choice === data.text_transform.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                        <# } ) #>

                    </select>
                </li>
            <# } #>

            <# if ( data.text_decoration && data.text_decoration.choices ) { #>

                <li class="typography-text-decoration">

                    <# if ( data.text_decoration.label ) { #>
                        <span class="customize-control-title">{{ data.text_decoration.label }}</span>
                    <# } #>

                    <select {{{ data.text_decoration.link }}} class="typography_text_decoration">

                        <# _.each( data.text_decoration.choices, function( label, choice ) { #>

                            <option value="{{ choice }}" <# if ( choice === data.text_decoration.value ) { #> selected="selected" <# } #>>{{ label }}</option>

                        <# } ) #>

                    </select>
                </li>
            <# } #>

            <# if ( data.size ) { #>

                <li class="typography-font-size">

                    <# if ( data.size.label ) { #>
                        <span class="customize-control-title">{{ data.size.label }} </span>
                    <# } #>

                    <span class="slider-value-size"></span>px
                    <div class="slider-range-size" ></div>
                    <input type="hidden" {{{ data.size.link }}} value="{{ data.size.value }}" >
                </li>
            <# } #>

            <# if ( data.line_height ) { #>

                <li class="typography-line-height">

                    <# if ( data.line_height.label ) { #>
                        <span class="customize-control-title">{{ data.line_height.label }} (px)</span>
                    <# } #>

                    <span class="slider-value-line-height"></span>
                    <div class="slider-range-line-height" ></div>
                    <input type="hidden" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" >
                </li>
            <# } #>

            <# if ( data.typocolor ) { #>

                <li class="typography-color">
                    <# if ( data.typocolor.label ) { #>
                        <span class="customize-control-title">{{{ data.typocolor.label }}}</span>
                    <# } #>

                    <div class="customize-control-content">
                        <input class="color-picker-hex" type="text" maxlength="7" placeholder="<?php esc_attr_e( 'Hex Value', 'parallaxsome' ); ?>" {{{ data.typocolor.link }}} value="{{ data.typocolor.value }}"  />
                    </div>
                </li>
            <# } #>

            </ul>
        <?php }

        /**
         * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
         *
         * @todo Integrate with Google fonts.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_fonts() { return array(); }

        /**
         * Returns the available font families.
         *
         * @todo Pull families from `get_fonts()`.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        function get_font_families() {

            $font_array = $this->get_google_fonts();
            $parallaxsome_google_font = get_option('parallaxsome_google_font');


            if (empty($parallaxsome_google_font)) {
                update_option('parallaxsome_google_font', $font_array);
                $parallaxsome_google_font = get_option('parallaxsome_google_font');
            }
            foreach ($parallaxsome_google_font as $key => $value) {
                $ap_fonts[$value['family']] =  $value['family'] ;
            }
            return $ap_fonts;
            
        }

        public function get_google_fonts() {
            $encoded = 'a:9:{i:0;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:9:"BenchNine";s:8:"category";s:10:"sans-serif";s:8:"variants";a:3:{i:0;s:3:"300";i:1;s:7:"regular";i:2;s:3:"700";}s:7:"subsets";a:2:{i:0;s:5:"latin";i:1;s:9:"latin-ext";}s:7:"version";s:2:"v6";s:12:"lastModified";s:10:"2017-10-10";s:5:"files";a:3:{i:300;s:87:"http://fonts.gstatic.com/s/benchnine/v6/ah9xtUy9wLQ3qnWa2p-piS3USBnSvpkopQaUR-2r7iU.ttf";s:7:"regular";s:66:"http://fonts.gstatic.com/s/benchnine/v6/h3OAlYqU3aOeNkuXgH2Q2w.ttf";i:700;s:87:"http://fonts.gstatic.com/s/benchnine/v6/qZpi6ZVZg3L2RL_xoBLxWS3USBnSvpkopQaUR-2r7iU.ttf";}}i:1;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:12:"Josefin Slab";s:8:"category";s:5:"serif";s:8:"variants";a:10:{i:0;s:3:"100";i:1;s:9:"100italic";i:2;s:3:"300";i:3;s:9:"300italic";i:4;s:7:"regular";i:5;s:6:"italic";i:6;s:3:"600";i:7;s:9:"600italic";i:8;s:3:"700";i:9;s:9:"700italic";}s:7:"subsets";a:1:{i:0;s:5:"latin";}s:7:"version";s:2:"v8";s:12:"lastModified";s:10:"2017-10-10";s:5:"files";a:10:{i:100;s:89:"http://fonts.gstatic.com/s/josefinslab/v8/etsUjZYO8lTLU85lDhZwUsSVQ0giZ-l_NELu3lgGyYw.ttf";s:9:"100italic";s:89:"http://fonts.gstatic.com/s/josefinslab/v8/8BjDChqLgBF3RJKfwHIYh3Xcj1rQwlNLIS625o-SrL0.ttf";i:300;s:89:"http://fonts.gstatic.com/s/josefinslab/v8/NbE6ykYuM2IyEwxQxOIi2KcQoVhARpoaILP7amxE_8g.ttf";s:9:"300italic";s:89:"http://fonts.gstatic.com/s/josefinslab/v8/af9sBoKGPbGO0r21xJulyyna0FLWfcB-J_SAYmcAXaI.ttf";s:7:"regular";s:89:"http://fonts.gstatic.com/s/josefinslab/v8/46aYWdgz-1oFX11flmyEfS3USBnSvpkopQaUR-2r7iU.ttf";s:6:"italic";s:89:"http://fonts.gstatic.com/s/josefinslab/v8/etsUjZYO8lTLU85lDhZwUvMZXuCXbOrAvx5R0IT5Oyo.ttf";i:600;s:89:"http://fonts.gstatic.com/s/josefinslab/v8/NbE6ykYuM2IyEwxQxOIi2Gv8CylhIUtwUiYO7Z2wXbE.ttf";s:9:"600italic";s:89:"http://fonts.gstatic.com/s/josefinslab/v8/af9sBoKGPbGO0r21xJuly4R-5-urNOGAobhAyctHvW8.ttf";i:700;s:89:"http://fonts.gstatic.com/s/josefinslab/v8/NbE6ykYuM2IyEwxQxOIi2ED2ttfZwueP-QU272T9-k4.ttf";s:9:"700italic";s:89:"http://fonts.gstatic.com/s/josefinslab/v8/af9sBoKGPbGO0r21xJuly_As9-1nE9qOqhChW0m4nDE.ttf";}}i:2;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:4:"Lato";s:8:"category";s:10:"sans-serif";s:8:"variants";a:10:{i:0;s:3:"100";i:1;s:9:"100italic";i:2;s:3:"300";i:3;s:9:"300italic";i:4;s:7:"regular";i:5;s:6:"italic";i:6;s:3:"700";i:7;s:9:"700italic";i:8;s:3:"900";i:9;s:9:"900italic";}s:7:"subsets";a:2:{i:0;s:5:"latin";i:1;s:9:"latin-ext";}s:7:"version";s:3:"v14";s:12:"lastModified";s:10:"2017-10-11";s:5:"files";a:10:{i:100;s:62:"http://fonts.gstatic.com/s/lato/v14/Upp-ka9rLQmHYCsFgwL-eg.ttf";s:9:"100italic";s:62:"http://fonts.gstatic.com/s/lato/v14/zLegi10uS_9-fnUDISl0KA.ttf";i:300;s:62:"http://fonts.gstatic.com/s/lato/v14/Ja02qOppOVq9jeRjWekbHg.ttf";s:9:"300italic";s:62:"http://fonts.gstatic.com/s/lato/v14/dVebFcn7EV7wAKwgYestUg.ttf";s:7:"regular";s:62:"http://fonts.gstatic.com/s/lato/v14/h7rISIcQapZBpei-sXwIwg.ttf";s:6:"italic";s:62:"http://fonts.gstatic.com/s/lato/v14/P_dJOFJylV3A870UIOtr0w.ttf";i:700;s:62:"http://fonts.gstatic.com/s/lato/v14/iX_QxBBZLhNj5JHlTzHQzg.ttf";s:9:"700italic";s:62:"http://fonts.gstatic.com/s/lato/v14/WFcZakHrrCKeUJxHA4T_gw.ttf";i:900;s:62:"http://fonts.gstatic.com/s/lato/v14/8TPEV6NbYWZlNsXjbYVv7w.ttf";s:9:"900italic";s:62:"http://fonts.gstatic.com/s/lato/v14/draWperrI7n2xi35Cl08fA.ttf";}}i:3;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:9:"Open Sans";s:8:"category";s:10:"sans-serif";s:8:"variants";a:10:{i:0;s:3:"300";i:1;s:9:"300italic";i:2;s:7:"regular";i:3;s:6:"italic";i:4;s:3:"600";i:5;s:9:"600italic";i:6;s:3:"700";i:7;s:9:"700italic";i:8;s:3:"800";i:9;s:9:"800italic";}s:7:"subsets";a:7:{i:0;s:5:"latin";i:1;s:9:"latin-ext";i:2;s:8:"cyrillic";i:3;s:12:"cyrillic-ext";i:4;s:10:"vietnamese";i:5;s:5:"greek";i:6;s:9:"greek-ext";}s:7:"version";s:3:"v15";s:12:"lastModified";s:10:"2017-10-11";s:5:"files";a:10:{i:300;s:87:"http://fonts.gstatic.com/s/opensans/v15/DXI1ORHCpsQm3Vp6mXoaTS3USBnSvpkopQaUR-2r7iU.ttf";s:9:"300italic";s:87:"http://fonts.gstatic.com/s/opensans/v15/PRmiXeptR36kaC0GEAetxi9-WlPSxbfiI49GsXo3q0g.ttf";s:7:"regular";s:66:"http://fonts.gstatic.com/s/opensans/v15/IgZJs4-7SA1XX_edsoXWog.ttf";s:6:"italic";s:87:"http://fonts.gstatic.com/s/opensans/v15/O4NhV7_qs9r9seTo7fnsVKCWcynf_cDxXwCLxiixG1c.ttf";i:600;s:87:"http://fonts.gstatic.com/s/opensans/v15/MTP_ySUJH_bn48VBG8sNSi3USBnSvpkopQaUR-2r7iU.ttf";s:9:"600italic";s:87:"http://fonts.gstatic.com/s/opensans/v15/PRmiXeptR36kaC0GEAetxpZ7xm-Bj30Bj2KNdXDzSZg.ttf";i:700;s:87:"http://fonts.gstatic.com/s/opensans/v15/k3k702ZOKiLJc3WVjuplzC3USBnSvpkopQaUR-2r7iU.ttf";s:9:"700italic";s:87:"http://fonts.gstatic.com/s/opensans/v15/PRmiXeptR36kaC0GEAetxne1Pd76Vl7zRpE7NLJQ7XU.ttf";i:800;s:87:"http://fonts.gstatic.com/s/opensans/v15/EInbV5DfGHOiMmvb1Xr-hi3USBnSvpkopQaUR-2r7iU.ttf";s:9:"800italic";s:87:"http://fonts.gstatic.com/s/opensans/v15/PRmiXeptR36kaC0GEAetxg89PwPrYLaRFJ-HNCU9NbA.ttf";}}i:4;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:7:"PT Sans";s:8:"category";s:10:"sans-serif";s:8:"variants";a:4:{i:0;s:7:"regular";i:1;s:6:"italic";i:2;s:3:"700";i:3;s:9:"700italic";}s:7:"subsets";a:4:{i:0;s:5:"latin";i:1;s:9:"latin-ext";i:2;s:8:"cyrillic";i:3;s:12:"cyrillic-ext";}s:7:"version";s:2:"v9";s:12:"lastModified";s:10:"2017-10-11";s:5:"files";a:4:{s:7:"regular";s:63:"http://fonts.gstatic.com/s/ptsans/v9/UFoEz2uiuMypUGZL1NKoeg.ttf";s:6:"italic";s:63:"http://fonts.gstatic.com/s/ptsans/v9/yls9EYWOd496wiu7qzfgNg.ttf";i:700;s:84:"http://fonts.gstatic.com/s/ptsans/v9/F51BEgHuR0tYHxF0bD4vwvesZW2xOQ-xsNqO47m55DA.ttf";s:9:"700italic";s:84:"http://fonts.gstatic.com/s/ptsans/v9/lILlYDvubYemzYzN7GbLkC3USBnSvpkopQaUR-2r7iU.ttf";}}i:5;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:8:"Prociono";s:8:"category";s:5:"serif";s:8:"variants";a:1:{i:0;s:7:"regular";}s:7:"subsets";a:1:{i:0;s:5:"latin";}s:7:"version";s:2:"v7";s:12:"lastModified";s:10:"2017-10-10";s:5:"files";a:1:{s:7:"regular";s:65:"http://fonts.gstatic.com/s/prociono/v7/43ZYDHWogdFeNBWTl6ksmw.ttf";}}i:6;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:7:"Raleway";s:8:"category";s:10:"sans-serif";s:8:"variants";a:18:{i:0;s:3:"100";i:1;s:9:"100italic";i:2;s:3:"200";i:3;s:9:"200italic";i:4;s:3:"300";i:5;s:9:"300italic";i:6;s:7:"regular";i:7;s:6:"italic";i:8;s:3:"500";i:9;s:9:"500italic";i:10;s:3:"600";i:11;s:9:"600italic";i:12;s:3:"700";i:13;s:9:"700italic";i:14;s:3:"800";i:15;s:9:"800italic";i:16;s:3:"900";i:17;s:9:"900italic";}s:7:"subsets";a:2:{i:0;s:5:"latin";i:1;s:9:"latin-ext";}s:7:"version";s:3:"v12";s:12:"lastModified";s:10:"2017-10-11";s:5:"files";a:18:{i:100;s:65:"http://fonts.gstatic.com/s/raleway/v12/UDfD6oxBaBnmFJwQ7XAFNw.ttf";s:9:"100italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/hUpHtml6IPNuUR-FwVi2UKCWcynf_cDxXwCLxiixG1c.ttf";i:200;s:86:"http://fonts.gstatic.com/s/raleway/v12/LAQwev4hdCtYkOYX4Oc7nPesZW2xOQ-xsNqO47m55DA.ttf";s:9:"200italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/N2DIbZG4399cPGfifZUEQi3USBnSvpkopQaUR-2r7iU.ttf";i:300;s:86:"http://fonts.gstatic.com/s/raleway/v12/2VvSZU2kb4DZwFfRM4fLQPesZW2xOQ-xsNqO47m55DA.ttf";s:9:"300italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/TVSB8ogXDKMcnAAJ5CqrUi3USBnSvpkopQaUR-2r7iU.ttf";s:7:"regular";s:65:"http://fonts.gstatic.com/s/raleway/v12/_dCzxpXzIS3sL-gdJWAP8A.ttf";s:6:"italic";s:65:"http://fonts.gstatic.com/s/raleway/v12/utU2m1gdZSfuQpArSy5Dbw.ttf";i:500;s:86:"http://fonts.gstatic.com/s/raleway/v12/348gn6PEmbLDWlHbbV15d_esZW2xOQ-xsNqO47m55DA.ttf";s:9:"500italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/S7vGLZZ40c85SJgiptJGVy3USBnSvpkopQaUR-2r7iU.ttf";i:600;s:86:"http://fonts.gstatic.com/s/raleway/v12/M7no6oPkwKYJkedjB1wqEvesZW2xOQ-xsNqO47m55DA.ttf";s:9:"600italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/OY22yoG8EJ3IN_muVWm29C3USBnSvpkopQaUR-2r7iU.ttf";i:700;s:86:"http://fonts.gstatic.com/s/raleway/v12/VGEV9-DrblisWOWLbK-1XPesZW2xOQ-xsNqO47m55DA.ttf";s:9:"700italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/lFxvRPuGFG5ktd7P0WRwKi3USBnSvpkopQaUR-2r7iU.ttf";i:800;s:86:"http://fonts.gstatic.com/s/raleway/v12/mMh0JrsYMXcLO69jgJwpUvesZW2xOQ-xsNqO47m55DA.ttf";s:9:"800italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/us4LjTCmlYgh3W8CKujEJi3USBnSvpkopQaUR-2r7iU.ttf";i:900;s:86:"http://fonts.gstatic.com/s/raleway/v12/ajQQGcDBLcyLpaUfD76UuPesZW2xOQ-xsNqO47m55DA.ttf";s:9:"900italic";s:86:"http://fonts.gstatic.com/s/raleway/v12/oY2RadnkHfshu5f0FLsgVS3USBnSvpkopQaUR-2r7iU.ttf";}}i:7;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:11:"Roboto Slab";s:8:"category";s:5:"serif";s:8:"variants";a:4:{i:0;s:3:"100";i:1;s:3:"300";i:2;s:7:"regular";i:3;s:3:"700";}s:7:"subsets";a:7:{i:0;s:5:"latin";i:1;s:9:"latin-ext";i:2;s:8:"cyrillic";i:3;s:12:"cyrillic-ext";i:4;s:10:"vietnamese";i:5;s:5:"greek";i:6;s:9:"greek-ext";}s:7:"version";s:2:"v7";s:12:"lastModified";s:10:"2017-10-11";s:5:"files";a:4:{i:100;s:88:"http://fonts.gstatic.com/s/robotoslab/v7/MEz38VLIFL-t46JUtkIEgIAWxXGWZ3yJw6KhWS7MxOk.ttf";i:300;s:88:"http://fonts.gstatic.com/s/robotoslab/v7/dazS1PrQQuCxC3iOAJFEJS9-WlPSxbfiI49GsXo3q0g.ttf";s:7:"regular";s:88:"http://fonts.gstatic.com/s/robotoslab/v7/3__ulTNA7unv0UtplybPiqCWcynf_cDxXwCLxiixG1c.ttf";i:700;s:88:"http://fonts.gstatic.com/s/robotoslab/v7/dazS1PrQQuCxC3iOAJFEJXe1Pd76Vl7zRpE7NLJQ7XU.ttf";}}i:8;a:8:{s:4:"kind";s:16:"webfonts#webfont";s:6:"family";s:15:"Source Sans Pro";s:8:"category";s:10:"sans-serif";s:8:"variants";a:12:{i:0;s:3:"200";i:1;s:9:"200italic";i:2;s:3:"300";i:3;s:9:"300italic";i:4;s:7:"regular";i:5;s:6:"italic";i:6;s:3:"600";i:7;s:9:"600italic";i:8;s:3:"700";i:9;s:9:"700italic";i:10;s:3:"900";i:11;s:9:"900italic";}s:7:"subsets";a:7:{i:0;s:5:"latin";i:1;s:9:"latin-ext";i:2;s:8:"cyrillic";i:3;s:12:"cyrillic-ext";i:4;s:10:"vietnamese";i:5;s:5:"greek";i:6;s:9:"greek-ext";}s:7:"version";s:3:"v11";s:12:"lastModified";s:10:"2017-10-11";s:5:"files";a:12:{i:200;s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/toadOcfmlt9b38dHJxOBGKXvKVW_haheDNrHjziJZVk.ttf";s:9:"200italic";s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/fpTVHK8qsXbIeTHTrnQH6OptKU7UIBg2hLM7eMTU8bI.ttf";i:300;s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/toadOcfmlt9b38dHJxOBGFP7R5lD_au4SZC6Ks_vyWs.ttf";s:9:"300italic";s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/fpTVHK8qsXbIeTHTrnQH6DUpNKoQAsDux-Todp8f29w.ttf";s:7:"regular";s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/ODelI1aHBYDBqgeIAH2zlNRl0pGnog23EMYRrBmUzJQ.ttf";s:6:"italic";s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/M2Jd71oPJhLKp0zdtTvoMwRX4TIfMQQEXLu74GftruE.ttf";i:600;s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/toadOcfmlt9b38dHJxOBGOiMeWyi5E_-XkTgB5psiDg.ttf";s:9:"600italic";s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/fpTVHK8qsXbIeTHTrnQH6Pp6lGoTTgjlW0sC4r900Co.ttf";i:700;s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/toadOcfmlt9b38dHJxOBGPgXsetDviZcdR5OzC1KPcw.ttf";s:9:"700italic";s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/fpTVHK8qsXbIeTHTrnQH6LVT4locI09aamSzFGQlDMY.ttf";i:900;s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/toadOcfmlt9b38dHJxOBGBA_awHl7mXRjE_LQVochcU.ttf";s:9:"900italic";s:92:"http://fonts.gstatic.com/s/sourcesanspro/v11/fpTVHK8qsXbIeTHTrnQH6A0NcF6HPGWR298uWIdxWv0.ttf";}}}';

            return unserialize($encoded);
        }

        /**
         * Returns the available font weights.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_font_weight_choices() {
            if($this->settings['family']->id){
                $parallaxsome_font_list = get_option( 'parallaxsome_google_font' );
                
                $font_family_id = $this->settings['family']->id;            
                $default_font_family = $this->settings['family']->default;
                $get_font_family = get_theme_mod( $font_family_id, $default_font_family );
      
                $font_array = parallaxsome_search_key( $parallaxsome_font_list, 'family', $get_font_family );

                $variants_array = $font_array['0']['variants'] ;
                $options_array = "";
                foreach ($variants_array  as $key => $variants ) {
                    $options_array[$key] = $variants;
                }
                return $options_array;
            }else{
            return array(
                '400' => esc_html__( 'Normal',     'parallaxsome' ),
                '700' => esc_html__( 'Bold',       'parallaxsome' ),
            );
            }
        }
        /**
         * Returns the available font text decoration.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_text_decoration_choices() {
            return array(
                'none'  => esc_html__( 'None', 'parallaxsome' ),
                'underline'  => esc_html__( 'Underline', 'parallaxsome' ),
                'line-through' => esc_html__( 'Line-through', 'parallaxsome' ),
                'overline' => esc_html__( 'Overline', 'parallaxsome' )
            );
        }

        /**
         * Returns the available font text transform.
         *
         * @since  1.0.0
         * @access public
         * @return array
         */
        public function get_text_transform_choices() {
            return array(
                'none'  => esc_html__( 'None', 'parallaxsome' ),
                'uppercase'  => esc_html__( 'Uppercase', 'parallaxsome' ),
                'lowercase' => esc_html__( 'Lowercase', 'parallaxsome' ),
                'capitalize' => esc_html__( 'Capitalize', 'parallaxsome' )
            );
    } 
 }