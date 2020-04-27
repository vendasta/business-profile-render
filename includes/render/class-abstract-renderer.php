<?php


defined( 'ABSPATH' ) || exit;


/**
 * Class AbstractRenderer - Extend this class to register different aspects of a business datum
 */
class AbstractRenderer {

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
	 * @param string $value - the value to render
	 * @param boolean $profile_data_exists - true if the entire business profile option is set
	 */
	public function __construct( $code_name, $readable_name, $value, $profile_data_exists ) {
		$this->code_name     = $code_name;
		$this->readable_name = $readable_name;

		if ( ! $profile_data_exists ) {
			$this->value = "PlaceHolder " . $this->readable_name;
		} elseif ( $value == null ) {
			$this->value = "";
		} else {
			$this->value = $value;
		}
	}

	/**
	 * perform the registration
	 *
	 * @throws Exception - when not overridden, this is an abstract class
	 */
	public function register() {
		throw new Exception( get_class( $this ) . "->register: not implemented" );
	}
}
