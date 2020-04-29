<?php

namespace BusinessProfileRender;

defined( 'ABSPATH' ) || exit;
require_once( 'class-renderer.php' );


/**
 * Class ReusableBlock - Register a reusable block for the new block-editor that provides the short-code
 */
abstract class ReusableBlock extends Renderer {

	/**
	 * Create the WP-Block style "post"
	 */
	public function register(): void {
		$title = $this->get_title();

		$reusable_block = get_posts( array(
			'name'           => $title,
			'post_type'      => 'wp_block',
			'posts_per_page' => 1
		) );

		if ( $reusable_block ) {
			wp_update_post( array(
				'ID'           => $reusable_block[0]->ID,
				'post_content' => $this->block_content()
			) );
		} else {
			wp_insert_post( array(
				'post_content'   => $this->block_content(),
				'post_title'     => $title,
				'post_type'      => 'wp_block',
				'post_status'    => 'publish',
				'comment_status' => 'closed',
				'ping_status'    => 'closed',
				'guid'           => sprintf(
					'%s/wp_block/%s',
					site_url(),
					$title
				)
			) );
		}
	}

	/**
	 * @return string - the name of the block - a change to this would be a breaking change
	 */
	abstract protected function get_title(): string;

	/**
	 * @return string - the content of the block
	 */
	abstract protected function block_content(): string;
}
