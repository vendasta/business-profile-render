<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-profilefield.php' );

/**
 * Class ContactEmail holds and displays the contact email of the company
 */
class ContactEmail extends ProfileField {

    /**
     * @return  string the name of the datum containing relevant data
     */
    protected static function profile_option_name(): string {
        return "contact_email";
    }

    /**
     * @return  string the name of this datum as read by a person
     */
    protected static function readable_profile_option(): string {
        return "Email";
    }

    /**
     * @return string the meaningful description of this datum as read by a person
     */
    protected static function readable_description(): string {
        return "The contact email of the business.";
    }
}
