<?php
class Bitcoinee_Customizer_Toggle_Control extends WP_Customize_Control {
	public $type = 'ios';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since 3.4.0
	 **/
	public function enqueue() {
		wp_enqueue_script( 'bitcoinee-customizer-toggle-control', get_template_directory_uri() . '/customizer/js/customizer-toggle-control.js', array( 'jquery' ), rand(), true );
		wp_enqueue_style( 'bitcoinee-pure-css-toggle-buttons', get_template_directory_uri() . '/customizer/css/customizer-toggle-control.css', array(), rand() );

		$css = '
			.disabled-control-title {
				color: #a0a5aa;
			}
			input[type=checkbox].tgl-light:checked + .tgl-btn { 
				background: #0085ba;
			}
			input[type=checkbox].tgl-light + .tgl-btn {
			  background: #a0a5aa;
			}
			input[type=checkbox].tgl-light + .tgl-btn:after {
			  background: #f7f7f7;
			}

			input[type=checkbox].tgl-ios:checked + .tgl-btn {
			  background: #0085ba;
			}

			input[type=checkbox].tgl-flat:checked + .tgl-btn {
			  border: 4px solid #0085ba;
			}
			input[type=checkbox].tgl-flat:checked + .tgl-btn:after {
			  background: #0085ba;
			}

		';
		wp_add_inline_style( 'bitcoinee-pure-css-toggle-buttons' , $css );
	}

	/**
	 * Render the control's content.
	 *
	 * @author soderlind
	 * @version 1.2.0
	 */
	public function render_content() {
		?>
		<label>
			<div class="bitcoinee-customizer-toggle-btn">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<input id="cb<?php echo $this->instance_number ?>" type="checkbox" class="tgl tgl-<?php echo $this->type?>" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?> />
				<label for="cb<?php echo $this->instance_number ?>" class="tgl-btn"></label>
			</div>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>
		</label>
		<?php
	}
}