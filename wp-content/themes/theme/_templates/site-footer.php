<?php
/**
 * Site Footer
 * @package 
 */ 
?>	

<footer id="SiteFooter" role="contentinfo">
	
<?php 

$form = new BrandCo_Form( 
	array(
		'title' => 'Holler at us!',
		'submit' => 'Submit my shit',
		'fields' => array(
			'text*' => 'Your Name',
			'address' => 'Address',
			'phone' => 'Your Phone Number',
			'email' => 'Your Email',
			'textarea' => 'How can we help?',	
		)
	)
);

?>

</footer>