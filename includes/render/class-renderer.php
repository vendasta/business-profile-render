<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;


/**
 * Class Renderer - Extend this class to register different aspects of a business datum
 */
abstract class Renderer {

	/**
	 * @var string the name of the option field (like "company_name")
	 */
	protected $code_name;

	/**
	 * @var string the name of the option as intended for people to read (like "Company Name")
	 */
	protected $readable_name;

	/**
	 * @var string the value stored in that option field (like "Alphabet Inc.")
	 */
	protected $value;

	/**
	 * Constructor
	 *
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|mixed|null $value - the value to render
	 */
	public function __construct( $code_name, $readable_name, $value ) {
		$this->code_name     = $code_name;
		$this->readable_name = $readable_name;

		if ( is_null( $value ) ) {
			$this->value = "PlaceHolder " . $this->readable_name;
		} else {
			$this->value = $value;
		}
	}

	/**
	 * perform the registration
	 */
	abstract public function register(): void;

	public function get_usage_html(): string {
		$base_class    = "bpr-usage";
		$heading       = $this->get_usage_heading();
		$instruction   = $this->get_instruction_html();
		$value         = $this->get_render_value();
		$escaped_value = esc_attr( $value );

		return "
<div class='$base_class-container'>
	<div class='$base_class-heading'>$heading</div>
	<div class='$base_class-instruction'>$instruction</div>
	<div class='$base_class-render-value-container'>It's appearance depends on your theme but here it renders:<div class='$base_class-render-value'>$value</div></div>
	<div class='$base_class-value-container'>It injects code that looks like:<pre class='$base_class-value'>$escaped_value</pre></div>
</div>";
	}

	/***
	 * @return string - the heading for the section explaining how to use this renderer
	 */
	abstract protected function get_usage_heading(): string;

	/***
	 * @return string - the instruction for using this renderer
	 */
	abstract protected function get_instruction_html(): string;

	/***
	 * @return string - the rendered HTML content this renderer produces
	 */
	protected function get_render_value(): string {
		return esc_attr( $this->value );
	}
}
