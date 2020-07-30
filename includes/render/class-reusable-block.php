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

		$content = $this->block_content();
		if ( $reusable_block ) {
			if ( $reusable_block[0]->post_content !== $content ) {
				wp_update_post( array(
					'ID'           => $reusable_block[0]->ID,
					'post_content' => $content
				) );
			}
		} else {
			wp_insert_post( array(
				'post_content'   => $content,
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
            if ( ! function_exists('register_block_style' ) ) {
                return;
            }
            register_block_style(
                'core/image',
                array(
                    'name'         => 'fixed-size-linked-img',
                    'label'        => 'image',
                    'inline_style' => 'img { height:32px; width: 32px; }'
                )
            );
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

	/***
	 * @return string - the heading for the section explaining how to use this renderer
	 */
	protected function get_usage_heading(): string {
		return "$this->readable_name Reusable Block";
	}

	/***
	 * @return string - the instruction for using this renderer
	 */
	protected function get_instruction_html(): string {
		$title = $this->get_title();

		return "To use this Reusable Block, add it to your page or post while 
in Block Editor mode. It will be in the Reusable Block list, named <code>$title</code>";
	}

	/***
	 * @return string - the rendered HTML content this renderer produces
	 */
	protected function get_render_value(): string {
		return $this->block_content();
	}

}
