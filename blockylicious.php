<?php

/**
 * Plugin Name:       Blockylicious
 * Description:       A plugin of funky blocks.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            WebDevEducation
 * Author URI:				https://webdeveducation.com
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       blockylicious
 *
 * @package           create-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */

namespace WebDevEducation;

if (!defined('ABSPATH')) {
	die('Silence is golden.');
}

final class Blockylicious
{
	static function init()
	{
		add_action('enqueue_block_assets', function () {
			wp_enqueue_style("dashicons");
			$style_url = plugins_url("build/style-index.css", __FILE__);
			wp_enqueue_style('blockylicious-style', $style_url, array());
		});
		add_action('init', function () {
			add_filter('block_categories_all', function ($categories) {
				array_unshift($categories, [
					'slug' => 'blockylicious',
					'title' => 'Blockylicious'
				]);
				return $categories;
			});
			register_block_type(__DIR__ . '/build/blocks/curvy');
			register_block_type(__DIR__ . '/build/blocks/clickyGroup');
			register_block_type(__DIR__ . '/build/blocks/clickyButton');
			register_block_type(__DIR__ . '/build/blocks/piccyGallery');
			register_block_type(__DIR__ . '/build/blocks/piccyImage');

			register_block_pattern_category('blockylicious', array(
				'label' => __('Blockylicious', 'blockylicious')
			));
			register_block_pattern('blockylicious/call-to-action', array(
				'categories' => array('call-to-action', 'blockylicious'),
				'title' => __('Blockylicious call to action', 'blockylicious'),
				'description' => __('A heading, paragraph, and clicky button block', 'blockylicious'),
				'content' => '<!-- wp:heading {"textAlign":"center"} -->
				<h2 class="wp-block-heading has-text-align-center">Lorem ipsum</h2>
				<!-- /wp:heading -->
				
				<!-- wp:paragraph {"align":"center"} -->
				<p class="has-text-align-center">Some paragraph text in here as a sub heading.</p>
				<!-- /wp:paragraph -->
				
				<!-- wp:blockylicious/clicky-group {"justifyContent":"center"} -->
				<!-- wp:blockylicious/clicky-button {"labelText":"Call to action","style":{"color":{"background":"#000000","text":"#FFFFFF"},"spacing":{"padding":{"top":"10px","bottom":"10px","left":"20px","right":"20px"}}}} /-->
				<!-- /wp:blockylicious/clicky-group -->'
			));
			$script_url = plugins_url('build/index.js', __FILE__);
			wp_enqueue_script('blockylicious-index', $script_url, array('wp-blocks', 'wp-element', 'wp-editor'));

			$style_url = plugins_url("build/style-index.css", __FILE__);
			wp_enqueue_style('blockylicious-style', $style_url, array());
		});
	}

	static function convert_custom_properties($value)
	{
		$prefix     = 'var:';
		$prefix_len = strlen($prefix);
		$token_in   = '|';
		$token_out  = '--';
		if (str_starts_with($value, $prefix)) {
			$unwrapped_name = str_replace(
				$token_in,
				$token_out,
				substr($value, $prefix_len)
			);
			$value          = "var(--wp--$unwrapped_name)";
		}

		return $value;
	}
}

Blockylicious::init();
