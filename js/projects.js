jQuery(document).ready(function() {

	// Switch default post format to blog posts
	var defps = setTimeout(function(){
		jQuery('#post-types a#post').trigger('click');
	},200);

});