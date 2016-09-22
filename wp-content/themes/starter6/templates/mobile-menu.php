<?php /** Options: .mobile-navigation-right or .mobile-navigation-left or none for full width */ ?>

<div id="mobile-navigation" class="mobile-navigation mobile-navigation-right" aria-hidden="true">
	<div class="mobile-navigation-container">
		
		<div id="mobile-navigation-close" class="mobile-navigation-close" title="Close Menu" data-mobile-menu-close>&times;</div>

		<div class="mobile-navigation-header">
			<!-- Logo -->
		</div>

		<div class="mobile-navigation-body">
			<div class="mobile-navigation-links">
				<ul>
					<?php display_mobile_nav(); ?>
				</ul>				
			</div>
		</div>

	</div>
</div>

<div id="mobile-navigation-overlay" class="mobile-navigation-overlay" aria-hidden="true" data-mobile-menu-close></div>