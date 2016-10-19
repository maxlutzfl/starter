<?php 
/**
 * 
 * 

$insert_about_section_module = new bcore_module(
	'testimonials-section-412312412512123', // Outputs HTML ID
	'about', // Which module to build

	// Args
	array(
		'title' => '<h1>New testimonials title</h1>',
		'subtitle' => '<h2>Subtitle</h2>'
	)
);

 */

class bcore_module {

	function __construct($id, $module, $args) {

		// Setup what content to replace the
		// placeholder content of the module
		$this->filters($id, $args);

		// Get which module template to output
		$this->get_module($id, $module, $args);
	}

	public function get_module($id, $module, $args) {

		// Run though each module to determine which one to show
		if ( $module === 'testimonials' ) {
			return $this->testimonials($id);
		}

		if ( $module === 'about' ) {
			return $this->about($id);
		}
	}

	private function filters($id, $args) {

		// Run thought each arg and add_filter so 
		// the placeholder content will be filled in
		foreach ($args as $key => $value) {
			add_filter(
				'bcore_module__' . $id . '__' . $key, 
				function() use ($value) {
					return $value;
				}
			);
		}
	}

	private function testimonials($id) {

		// Empty filters array
		$filters = array();

		// Get placeholder content that will be 
		// filled in later with add_filters
		$defaults = array(
			'title' => 'Testimonials Title',
			'subtitle' => 'What our clients say'
		);

		// Create apply_filters for each piece of
		// content that can be customized
		foreach ( $defaults as $key => $value ) {
			$filters[$key] = apply_filters(
				'bcore_module__' . $id . '__' . $key,
				$value,
				10
			);
		}

		// Now build the template
		?>
			<section id="<?php echo $id; ?>" class="bcore-module--testimonials">
				<div class="section-container">
					<?php echo $filters['title']; ?>
					<?php echo $filters['subtitle']; ?>
				</div>
			</section>
		<?php
	}

	private function about($id) {
		$filters = array();

		$defaults = array(
			'title' => 'Testimonials Title',
			'subtitle' => 'What our clients say'
		);

		foreach ( $defaults as $key => $value ) {
			$filters[$key] = apply_filters(
				'bcore_module__' . $id . '__' . $key,
				$value,
				10
			);
		}
		?>
			<section id="<?php echo $id; ?>" class="bcore-module--about">
				<div class="section-container">
					<?php echo $filters['title']; ?>
					<?php echo $filters['subtitle']; ?>
				</div>
			</section>
		<?php
	}
}