<?php


defined( 'ABSPATH' ) || exit;
require_once( 'class-abstract-business-profile-field.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'render/class-paragraph-reusable-block-renderer.php' );

/**
 * Class CompanyName holds and displays the name of the company
 */
class CompanyName extends AbstractBusinessProfileField {

	/**
	 * @return  string the name of the datum containing relevant data
	 */
	protected static function profile_option_name() {
		return "company_name";
	}

	/**
	 * @return  string the name of this datum as read by a person
	 */
	protected static function readable_profile_option() {
		return "Company Name";
	}

	/**
	 * @param string $code_name - the name of the datum to register
	 * @param string $readable_name - the name of this datum as read by a person
	 * @param string $value - the value to render
	 * @param boolean $profile_data_exists - true if the business profile data was set
	 *
	 * @return AbstractRenderer[] - renderers to run during init - extend to include reusable block
	 * @throws Exception
	 */
	protected function construct_renderers( $code_name, $readable_name, $value, $profile_data_exists ) {
		$parent_renderers = parent::construct_renderers( $code_name, $readable_name, $value, $profile_data_exists );
		array_push( $parent_renderers,
			new ParagraphReusableBlockRenderer( $code_name, $readable_name, $value, $profile_data_exists )
		);

		return $parent_renderers;
	}
}
