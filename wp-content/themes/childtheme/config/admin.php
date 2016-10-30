<?php

/** Custom admin styles */
add_action('admin_head', 'wp_admin_custom_styles');
function wp_admin_custom_styles() {
	?>
<style>
	.post-type-page #postimagediv h2 span { font-size: 0; }
	.post-type-page #postimagediv h2 span:after { content: "Background Image"; font-size: 14px; }
</style>
	<?php
}