<?php

if ( ! function_exists( "admin_sub_tab_visible_capability" ) ) {
	/**
	 * This function returns the required "capability" possessed by a user who
	 * has access to the admin sub-tab that renders instructions about this plugin.
	 * For more information about capabilities see
	 * https://wordpress.org/support/article/roles-and-capabilities/
	 * @return string - the capability string
	 */
	function admin_sub_tab_visible_capability(): string {
		return "edit_posts";
	}
}