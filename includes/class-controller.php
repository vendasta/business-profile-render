<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'access-control.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'class-data-storage.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-contact-email.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-company-name.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-full-address.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-address.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-city.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-state.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-zip.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-country.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-toll-free-number.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-foursquare.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-twitter.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-instagram.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-linkedin.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-facebook.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-pinterest.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-rss.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-youtube.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-primaryimage.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-logoimage.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-worknumber.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-services.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-hoursofoperation.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-company-description.php' );
require_once( BUSINESS_PROFILE_RENDER_INCLUDE_PATH . 'profile-fields/class-company-short-description.php' );

/**
 * Class Controller
 *
 * Create and register necessary components
 */
class Controller {

	const ACTIVATION_OPTION_KEY = "business_profile_render_version";

	/**
	 * @var Controller the instance of this class
	 */
	private static $singleton = null;

	/**
	 * @var DataStorage provides the interface to the data storage
	 */
	private $storage = null;

	/**
	 * @var array|ProfileField[]
	 */
	private $profile_fields;

	/**
	 * @var bool
	 */
	private $registered;

	/**
	 * Controller constructor.
	 */
	public function __construct() {
		$this->storage        = DataStorage::instance();
		$this->registered     = false;
		$this->profile_fields = array(
		    new ContactEmail( $this->storage ),
			new CompanyName( $this->storage ),
			new FullAddress( $this->storage ),
			new Address( $this->storage ),
			new City( $this->storage ),
			new State( $this->storage ),
			new ZipCode( $this->storage ),
			new Country( $this->storage ),
			new WorkNumber( $this->storage ),
			new TollFreeNumber( $this->storage ),
			new HoursOfOperation( $this->storage ),
			new CompanyDescription( $this->storage ),
			new CompanyShortDescription( $this->storage ),
			new PrimaryImage( $this->storage ),
			new LogoImage( $this->storage ),
			new Services( $this->storage ),
			new Foursquare( $this->storage ),
			new Twitter( $this->storage ),
			new Instagram( $this->storage ),
			new LinkedIn( $this->storage ),
			new Pinterest( $this->storage ),
			new Facebook( $this->storage ),
			new Rss( $this->storage ),
			new YouTube( $this->storage ),
		);
	}

	/**
	 * return the instance of this class
	 *
	 * @return Controller
	 */
	public static function instance(): Controller {
		if ( is_null( self::$singleton ) ) {
			self::$singleton = new self();
		}

		return self::$singleton;
	}

	/**
	 * Run on activation - save the name/version to the settings
	 */
	public function activate(): void {
		update_option( static::ACTIVATION_OPTION_KEY, BUSINESS_PROFILE_RENDER_VERSION );
	}

	/**
	 * Run on deactivate - remove the name/version to the settings
	 */
	public function deactivate(): void {
		delete_option( static::ACTIVATION_OPTION_KEY );
	}

	/**
	 * register the activation and deactivation hook with WordPress
	 */
	public function register_hooks(): void {
		if ( ! $this->registered ) {
			register_activation_hook( BUSINESS_PROFILE_RENDER_FILE, array( $this, 'activate' ) );
			register_deactivation_hook( BUSINESS_PROFILE_RENDER_FILE, array( $this, 'deactivate' ) );
			$this->registered = true;
		}
	}

	/**
	 * render the admin tab which provides instructions about using the renderer classes
	 */
	public function add_admin_tab_action(): void {
		add_action( 'admin_menu', array( $this, 'add_admin_tab' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_instruction_styles' ) );
		add_filter( 'plugin_row_meta', array( $this, 'plugin_row_meta' ), 10, 2 );
	}

	/**
	 * add the sub-tab under the "Tools" tab
	 */
	public function add_admin_tab(): void {
		add_submenu_page(
			"tools.php",
			BUSINESS_PROFILE_RENDER_NAME,
			BUSINESS_PROFILE_RENDER_NAME,
			admin_sub_tab_visible_capability(),
			sanitize_key( BUSINESS_PROFILE_RENDER_NAME ),
			array( $this, 'sub_tab_html' ),
			null );
	}

	/**
	 * This is the callback that outputs HTML for the actual sub-tab
	 */
	public function sub_tab_html(): void {
		echo "<h1>" . BUSINESS_PROFILE_RENDER_NAME . "</h1>
<p>Your Business Profile has important contact information for your business.
This plugin provides ways to automatically render this information on your site.
This includes both <a href='https://codex.wordpress.org/Shortcode'>Shortcodes</a>
and reusable <a href='https://wordpress.org/support/article/blocks/'>Blocks</a>.</p>";

		foreach ( $this->profile_fields as $field ) {
			echo $field->admin_instruction_html();
		}
	}

	/**
	 * Load the CSS for the sub-tab
	 */
	public function add_admin_instruction_styles(): void {
		wp_enqueue_style( 'admin-styles', BUSINESS_PROFILE_RENDER_WEB_PATH_PUBLIC . '/styles/admin-instruction.css' );
	}

	/**
	 * Show row meta on the plugin screen.
	 *
	 * @param mixed $links Plugin Row Meta.
	 * @param mixed $file  Plugin Base file.
	 *
	 * @return array
	 */
	public function plugin_row_meta( $links, $file ) {
		if ( BUSINESS_PROFILE_RENDER_PLUGIN_FILE !== $file ) {
			return (array) $links;
		}

		$href = esc_url( admin_url( 'tools.php?page=businessprofilerender' ) );
		$aria_label = esc_attr__( 'View plugin usage', 'businessprofilerender' );
		$label = esc_html__( 'Usage', 'businessprofilerender' );
		$meta = array(
			'usage' => "<a href=\"$href\" aria-label=\"$aria_label\">$label</a>"
		);
		return array_merge( $links, $meta );
	}
}
