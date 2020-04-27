<?php


defined( 'ABSPATH' ) || exit;
require_once( 'class-abstract-business-profile-field.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-plaintext-reusable-block-renderer.php' );

/**
 * Class CompanyName holds and displays the name of the company
 */
class CompanyName extends BusinessProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name(): string {
		return "company_name";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option(): string {
		return "Company Name";
	}

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string|null $value - the value to render
	 *
	 * @return Renderer[] - renderers to run during init - extend to include reusable block
	 * @throws Exception
	 */
	protected function construct_renderers( $code_name, $readable_name, $value ) {
		$parent_renderers = parent::construct_renderers( $code_name, $readable_name, $value );
		array_push( $parent_renderers,
			new PlaintextReusableBlockRenderer( $code_name, $readable_name, $value )
		);

		return $parent_renderers;
	}
}
