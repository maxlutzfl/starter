<?php 
/**
 * Fonts
 */

// add_action('wp_enqueue_scripts', 'bcore_custom_theme_fonts');
function bcore_custom_theme_fonts() {

	
	if ( defined('THEME_GOOGLE_FONT') ) {
		wp_register_style('bcore-google-font', 'https://fonts.googleapis.com/css?family=' . THEME_GOOGLE_FONT);
		wp_enqueue_style('bcore-google-font');
	}
}

/**
 * Typekit
 */
// add_action('bcore_head', 'bcore_typekit_embed');
function bcore_typekit_embed() {
	?>
	<script>
		(function(d) {
			var config = {
				kitId: 'avh5nhx',
				scriptTimeout: 3000,
				async: true
			},
			h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
		})(document);
	</script>
	<?php
}