<?php
/**
 * ITEMS
 *
 * @package      SETUP-BE
 * @author       Mark Corpuz
 * @since        1.0.0
 * @license      GPL-2.0+
**/

/**
 * NOTE: To see the constantly evolving structure, visit the link below
 * https://www.dropbox.com/s/rl5rogga8aip9kl/SETUP_layout-structure-overview.svg?dl=0
 */


// OVERVIEW OF HTML STRUCTURE
// 
// IMAGE
// <a class="item image link"><img class="item img"></a>
// <img class="item img">
// 
// OVERLINE
// <div class="item overline"><a></a></div>
// <div class="item overline nolink"></div>
// 
// TITLE
// <h2 class="item title"><a></a></h2>
// <h2 class="item title nolink"><a></a></h2>
// 
// AUTHOR
// <div class="item author"><a></a></div>
// <div class="item author nolink"></div>
// <div class="item author">By <a></a></div>
// <div class="item author nolink">By </div>
// <div class="item author icon">
// 	 <a class="item author avatar"</a>
// 	 <span><a class="item author link"></a></span>
// </div>
// <div class="item author icon nolink">
//   <span class="item author avatar"><span>
//   <span class="item author"></span>
// </div>
// <a class="item author gravatar"></a>
// 
// DATE
// <div class="item date">Jan 1, 2020</div>
// <div class="item date">Sunday | Jan 1, 2020</div>
// <div class="item date">Jan 1, 2020 at 7:00am</div>
// 
// DATE & AUTHOR
// <div class="item dateauthor">Jan 1, 2020 by <a class="item author link">Author</a></div>
// <div class="item dateauthor nolink">by Author</div>
// 
// EXCERPT
// <div class="item excerpt"></div>


/**
 * IMAGE
 * _LINK
 * _NOLINK
 * 
 * + FEATURED-IMAGE
 * + ICON-IMAGE
 * + BG-IMAGE
 */

function setup_be_image( $size = 'medium' ) {
	echo '<a class="item image link" href="' . get_permalink() . '" tabindex="-1" aria-hidden="true">' . wp_get_attachment_image( setup_be_image_id(), $size, "", ["class" => "item img"] ) . '</a>';
}
function setup_be_image_nolink( $size = 'medium' ) {
	echo wp_get_attachment_image( setup_be_image_id(), $size, "", ["class" => "item img"] );
}


/**
 * IMAGE-ID
 *
 */

function setup_be_image_id() {
	return has_post_thumbnail() ? get_post_thumbnail_id() : get_option( 'options_ea_default_image' );
}


/**
 * OVERLINE
 * _LINK
 * _NOLINK
 * 
 */

function setup_be_overline() {
	$term = ea_first_term();
	if( !empty( $term ) && ! is_wp_error( $term ) )
		echo '<div class="item overline"><a href="' . get_term_link( $term, 'category' ) . '">' . $term->name . '</a></div>';
}
function setup_be_overline_nolink() {
	$term = ea_first_term();
	if( !empty( $term ) && ! is_wp_error( $term ) )
		echo '<div class="item overline nolink">' . $term->name . '</div>';
}


/**
 * TITLE
 * _LINK
 * _NOLINK
 * 
 */

function setup_be_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="item title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}
function setup_be_title_nolink() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="item title nolink">' . get_the_title() . '</' . $tag . '>';
}


/**
 * AUTHOR
 * _LINK
 * _NOLINK
 *
 */

function setup_be_author() {
	$id = get_the_author_meta( 'ID' );
	echo '<div class="item author"><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
}
function setup_be_author_nolink() {
	$id = get_the_author_meta( 'ID' );
	echo '<div class="item author nolink">' . get_the_author() . '</div>';
}


	/**
	 * By AUTHOR
	 * _LINK
	 * _NOLINK
	 * 
	 */
	function setup_be_author_by() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author">By <a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></div>';
	}
	function setup_be_author_by_nolink() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author nolink">By ' . get_the_author() . '</div>';
	}

	/**
	 * AUTHOR ICON (icon w name)
	 */
	function setup_be_author_icon() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author icon"><span><a class="item gravatar" href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 20 ) . '</a></span><span><a href="' . get_author_posts_url( $id ) . '">' . get_the_author() . '</a></span></div>';
	}
	function setup_be_author_icon_nolink() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author icon"><span class="item author gravatar">' . get_avatar( $id, 20 ) . '<span><span class="item author">' . get_the_author() . '</span></div>';
	}

	/**
	 * AUTHOR ICONONLY (icon only)
	 *
	 */
	function setup_be_author_gravatar() {
		$id = get_the_author_meta( 'ID' );
		echo '<div class="item author icon"><a class="item gravatar" href="' . get_author_posts_url( $id ) . '" aria-hidden="true" tabindex="-1">' . get_avatar( $id, 20 ) . '</a>';
	}


/**
 * DATE
 * Jan 1, 2020
 * 
 */
function setup_be_date() {
	echo '<div class="item date">' . get_the_date( 'M j, Y' ) . '</div>';
}

	/**
	 * Jan 1, 2020
	 */
	function setup_be_date_mdy() {
		echo '<div class="item date">' . get_the_date( 'M j, Y' ) . '</div>';
	}
	/**
	 * Sunday | Jan 1, 2020
	 */
	function setup_be_date_day_mdy() {
		echo '<div class="item date">' . get_the_date( 'l | M j, Y' ) . '</div>';
	}
	/**
	 * Jan 1, 2020 at 7:00am
	 */
	function setup_be_date_mdy_time() {
		echo '<div class="item date">' . get_the_date( 'M j, Y \a\t g:ia' ) . '</div>';
	}


/**
 * DATE & AUTHOR
 * Jan 1, 2020 by Author
 * 
 */
function setup_be_dateauthor() {
	echo '<div class="item dateauthor">' . get_the_date( 'M j, Y' ) . ' by <a href="' . get_author_posts_url( get_the_ID() ) . '">' . get_the_author() . '</a></div>';
}
function setup_be_dateauthor_nolink() {
	echo '<div class="item dateauthor nolink">' . get_the_date( 'M j, Y' ) . ' by ' . get_the_author() . '</div>';
}


/**
 * EXCERPT
 *
 */
function setup_be_excerpt() {
    if( has_excerpt() ) {
    	echo '<div class="item excerpt">' . get_the_excerpt() . '</div>';
    } else {
    	//echo '';
    }
}

	/**
	 * EXCERPT OR MAX WORDS
	 * 
	 */
	function setup_be_excerpt_maxwords() {
	    $max_words = 10;
	    $the_excerpt = get_the_excerpt();
	    if( $the_excerpt ) {
	        echo '<div class="item excerpt">'.wp_trim_words( $the_excerpt, $max_words ).'</div>';
	    }
	}


/**
 * EDIT
 * 
 */

function setup_be_edit() {
	// specify user privileges that can edit
	$user_types = array( 'administrator', 'editor' );
	// validate if user is logged in
	if( is_user_logged_in() ) {
		// what type of access
		foreach( $user_types as $user_type ) {
			if( current_user_can( $user_type ) ){
				// regular link				
				//return edit_post_link( 'Edit entry' );
				// OR
				// you might want to use the URL for other purposes
				echo '<div class="item edit"><a href="'.get_edit_post_link( get_the_ID() ).'">EDIT</a></div>';
			}
		}
	}
}