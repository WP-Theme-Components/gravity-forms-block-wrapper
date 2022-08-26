<?php
/**
 * Wrap a Gravity Forms form in a block, for formatting
 *
 * @package WP-Theme-Components
 * @subpackage gravity-forms-block-wrapper
 * @author Cameron Jones
 * @version 1.0.0
 */

namespace WP_Theme_Components\Gravity_Forms_Block_Wrapper;

/**
 * Bail if accessed directly
 *
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/**
 * Wrap classic block content in a block, for formatting
 *
 * @since 1.0.0
 * @param string $block_content Block content.
 * @param array  $block Block object.
 * @return string
 */
function wrap_gf_block( $block_content, $block ) {
	if ( use_block_editor_for_post_type( get_post_type() ) ) {
		if ( 'gravityforms/form' === $block['blockName'] ) {
			$block_content = sprintf(
				'<div class="wp-block-gravity-form">%1$s</div>',
				$block_content
			);
		}
	}
	return $block_content;
}

add_filter( 'render_block', __NAMESPACE__ . '\\wrap_gf_block', 10, 2 );

/**
 * Return whether a post type is compatible with the block editor.
 *
 * @since 1.0.1
 * @param string $post_type The post type.
 * @return bool
 */
function use_block_editor_for_post_type( $post_type ) {
	require_once ABSPATH . 'wp-admin/includes/post.php';
	return \use_block_editor_for_post_type( $post_type );
}
