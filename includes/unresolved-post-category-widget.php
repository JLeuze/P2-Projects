<?php

// Category widget for unresolved / resolved posts
function jl_unresolved_posts_cat_register_widget() {

	register_widget( 'jl_unresolved_posts_cat_widget' );

}

class jl_unresolved_posts_cat_widget extends WP_Widget {

	function jl_unresolved_posts_cat_widget() {

		$widget_ops = array(
		
			'classname'   => 'unresolved-cat-widget',
			'description' => __( 'A list of unresolved post categories.', 'unresolved-cat' )
		
		);

		$control_ops = array( 'id_base' => 'unresolved-cat-widget' );

		$this->WP_Widget( 'unresolved-cat-widget', __( 'Unresolved Post Categories', 'unresolved-cat' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
	
		extract( $args );
					
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $before_widget;
		
		if ( $title ) {
		
			echo $before_title . $title . $after_title;
			
		}
		
		// List categories with links		
		$jl_unresolved_cat_terms       = get_terms( 'category' );
		$jl_unresolved_cat_terms_count = count($jl_unresolved_cat_terms);
		$jl_unresolved_cat_value       = $instance['category'];
		
		if ( $jl_unresolved_cat_terms_count > 0 ) {
				
			echo '<ul>';
						
			foreach ( $jl_unresolved_cat_terms as $jl_unresolved_cat_terms ) {

				//echo '<li> <a href="' home_url( '/' ) . $jl_unresolved_cat_terms->slug . '/?resolved=unresolved">' . $jl_unresolved_cat_terms->name . '</a> <a href="' home_url( '/' ) . $jl_unresolved_cat_terms->slug . '/?resolved=resolved">(Resolved)</a></li>';
				
				echo '<li><a href="' . home_url( '/category/' ) . $jl_unresolved_cat_terms->slug . '/?resolved=unresolved">' . $jl_unresolved_cat_terms->name . '</a> <a href="' . home_url( '/category/' ) . $jl_unresolved_cat_terms->slug . '/?resolved=resolved">(Resolved)</a></li>';

			}

			echo '</ul>';

			$jl_urgent_term = term_exists('Urgent', 'post_tag');
			if ($jl_urgent_term !== 0 && $jl_urgent_term !== null) {
				echo '<a style="display:block; background-color: rgb(230, 0, 10); color: #fff; border-radius: 5px; padding: 10px; margin-top: 10px" href="' . home_url( '/tag/urgent/?resolved=unresolved' ) . '">Urgent Projects</a>';
			}
			
		}

		echo $after_widget;
	
	}

	function update( $new_instance, $old_instance ) {
	
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	
	}
	
	function form( $instance ) {
	
		$defaults = array(
		
			'title' => ''
			
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults );
	
		echo '<p><label for="' . $this->get_field_id( 'title' ) . '">' . __('Title:', 'unresolved-cat') . '</label>
		<input type="text" class="widefat" id="' . $this->get_field_id( 'title' ) . '" name="' . $this->get_field_name( 'title' ) . '" value="' . $instance['title'] . '" /></p>';

	}

}
add_action( 'widgets_init', 'jl_unresolved_posts_cat_register_widget' );