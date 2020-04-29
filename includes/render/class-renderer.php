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
	 * @param string|null $value - the value to render
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
}
