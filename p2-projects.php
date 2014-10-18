<?php
/**
 * Plugin Name: P2 Projects
 * Plugin URI: http://jleuze.com/
 * Description: Functionality plugin for P2 project management
 * Version: 1.0
 * Author: Josh Leuze
 * Author URI: http://jleuze.com/
 * License: GPL2
 */

// Automatically mark new posts as "unresolved"
add_filter( 'p2_resolved_posts_mark_new_as_unresolved', '__return_true' );

// Add projects script
wp_enqueue_script( 'projects-script', plugins_url( '/js/projects.js', __FILE__ ), array( 'jquery' ) );

// Add category widget for unresolved / resolved posts
include( 'includes/unresolved-post-category-widget.php' );