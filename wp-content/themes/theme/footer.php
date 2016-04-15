<?php
/**
 * Site Footer
 * @package 
 */ 
?>	
		<?php get_template_part('_templates/site', 'footer'); ?>

		<?php
			new BrandCo_Form( 
			    array(
					'title' => 'Contact Form 01', // Does not display on front end
					'id' => 100,
					'submit' => 'Submit', // Text to display in submit button
					'fields' => array(
						1 => array(
							'title' => 'Your Name',
							'type' => 'text',
							'required' => true
						),
						2 => array(
							'title' => 'Your Last Name',
							'type' => 'text',
							'required' => false
						),
						3 => array(
							'title' => 'Your Address',
							'type' => 'address'
						),
						4 => array(
							'title' => 'Your Email',
							'type' => 'email'				
						),
						5 => array(
							'title' => 'Your Phone',
							'type' => 'phone'
						),
						6 => array(
							'title' => 'Message',
							'type' => 'textarea'
						),
					)
			    )
			);	
		?>

	</div>

	<?php get_template_part('_templates/site', 'mobilenav'); ?>

 	<?php wp_footer(); ?>
</body>
</html>