<?php

/**
 * Taxonomy
 *
 * Wrapper class for taxonomy functionality
 *
 * @author Andreas Färnstrand <andreas@farnstranddev.se>
 */

namespace post_status_scheduler;

class Taxonomy {


	/**
	 * get_taxonomies
	 *
	 * Get all taxonomies connected with this post
	 *
	 * @param object $post
	 *
	 * @return array
	 */
	public static function enum( $post_id ) {

		$post       = get_post( $post_id );
		$taxonomies = get_object_taxonomies( $post, 'object' );

		return array_keys( $taxonomies );

	}


	/**
	 * set_terms
	 *
	 * Update the post's terms in given taxonomy
	 *
	 * @param int $post_id
	 * @param string|array $terms
	 * @param string $taxonomy
	 */
	public static function set_terms( $post_id, $terms = '', $taxonomy = '', $append = false ) {

		wp_set_post_terms( $post_id, $terms, $taxonomy, $append );

	}


	/**
	 * get_terms
	 *
	 * Get the terms connectedto given post and taxonomy
	 *
	 * @param int $post_id
	 * @param string $taxonomy
	 *
	 * @return array
	 */
	public static function get_terms( $post_id, $taxonomy = '' ) {

		return wp_get_post_terms( $post_id, $taxonomy );

	}


	public static function get_all_terms( $post_id ) {

		$taxonomies = self::enum( $post_id );
		$all_terms  = array();

		if ( count( $taxonomies ) > 0 ) {

			foreach ( $taxonomies as $taxonomy ) {

				foreach ( self::get_terms( $post_id, $taxonomy ) as $term ) {

					array_push( $all_terms, $term );

				}

			}

		}

		return $all_terms;

	}


	/**
	 * reset_all_terms
	 *
	 * Resets all terms for post with given post_id
	 *
	 * @param int $post_id
	 */
	public static function reset_all_terms( $post_id ) {

		$all_taxonomies      = self::enum( $post_id );
		$options             = Settings::get_options();
		$categories_and_tags = ! empty( $options['categories_and_tags'] ) ? $options['categories_and_tags'] : 'both';

		// Loop all taxonomies and reset terms
		if ( count( $all_taxonomies ) > 0 ) {
			foreach ( $all_taxonomies as $taxonomy ) {

				// We need to check what types of terms to remove
				if ( $categories_and_tags == 'both' ) {

					self::set_terms( $post_id, '', $taxonomy );

				} elseif ( $categories_and_tags == 'tags' ) {

					if ( ! is_taxonomy_hierarchical( $taxonomy ) ) {
						self::set_terms( $post_id, '', $taxonomy );
					}

				} elseif ( $categories_and_tags == 'categories' ) {

					if ( is_taxonomy_hierarchical( $taxonomy ) ) {
						self::set_terms( $post_id, '', $taxonomy );
					}

				}

			}
		}

	}


	/**
	 * get_posttype_terms
	 *
	 * Get all categories registered to a post type
	 *
	 * @param string $post_type
	 *
	 * @return array
	 */
	public static function get_posttype_terms( $post_type ) {
		$all_taxonomies = get_object_taxonomies( $post_type );
		$tag_taxonomies = array();
		$cat_taxonomies = array();

		if ( count( $all_taxonomies ) > 0 ) {
			foreach ( $all_taxonomies as $taxonomy ) {
				if ( ! is_taxonomy_hierarchical( $taxonomy ) ) {
					$tag_taxonomies [] = $taxonomy;
				} else {
					$cat_taxonomies [] = $taxonomy;
				}
			}
		}

		// Get categories
		$args           = array(
			'type'       => $post_type,
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => false,
			'taxonomy'   => $cat_taxonomies
		);
		$tmp_categories = get_categories( $args );
		$categories     = array();

		foreach ( $tmp_categories as $category ) {
			if ( $category->cat_name != 'uncategorized' ) {
				array_push( $categories, $category );
			}
		}

		$tags = array();

		if ( ! empty( $tag_taxonomies ) ) {

			// Get categories
			$args     = array(
				'type'       => $post_type,
				'orderby'    => 'name',
				'order'      => 'ASC',
				'hide_empty' => false,
				'taxonomy'   => $tag_taxonomies
			);
			$tmp_tags = get_categories( $args );


			foreach ( $tmp_tags as $tag ) {
				if ( $tag->cat_name != 'uncategorized' ) {
					array_push( $tags, $tag );
				}
			}


		}


		return array(
			'categories' => $categories,
			'tags'       => $tags
		);

	}


	/**
	 * setup_post_terms
	 *
	 * Setup values to use in select
	 *
	 * @param array $chosen_terms
	 * @param array $all_terms
	 *
	 * @return array $result
	 */
	public static function setup_post_terms( $chosen_terms = array(), $all_terms = array() ) {

		$result = array();

		if ( count( $chosen_terms ) > 0 ) {

			foreach ( $chosen_terms as $term ) {

				foreach ( $all_terms['categories'] as $object ) {

					if ( $term->term_id == $object->term_id ) {

						$result [] = $term->term_id . '_' . $object->taxonomy;

					}

				}

				foreach ( $all_terms['tags'] as $object ) {

					if ( $term->term_id == $object->term_id ) {

						$result [] = $term->term_id . '_' . $object->taxonomy;

					}

				}

			}

		}

		return $result;

	}

}

?>