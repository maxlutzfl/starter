<?php
/**
 * @package BrandCo Starter Theme
 * @subpackage Global Footer Template
 * @author BrandCo. LLC
 */
get_header();
use BrandCo\Config\Functions;
?>

		<?php get_template_part('templates/site', 'footer'); ?>

	</div><?php /** #siteWrapper */ ?>

	<?php get_template_part('templates/site', 'mobilenav'); ?>

 	<?php wp_footer(); ?>

</body>
</html>