<?php
/**
 * @package:		WordPress
 * @subpackage:		Admin Bar Button Plugin
 * @description:	Options page for the admin bar button
 * @since:			2.0
 */

/**
 * Avoid direct calls to this file where WP core files are not present
 */
if(!function_exists('add_action')) :
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
endif;

/** Initiate the plugin options page */
$abb_page = new ABB_Page();

/**
 * Admin Bar Button options page class
 */
class ABB_Page{
	
	/**
	 * The menu slug of this plugin
	 *
	 * @var string
	 */
	private $plugin_slug = 'djg-admin-bar-button';
	
	/**
	 * The menu slug of this plugin
	 *
	 * @var string
	 */
	private $plugin_text_domain = 'djg-admin-bar-button';
	
	/**
	 * The currently saved options
	 *
	 * @var array
	 */
	private $options = array();
	
	/**
	 * The default options (in case the user tries to submit a blank option, or if one is not set on page load)
	 *
	 * @var array
	 */
	private $defaults = array();
	
	/**
	 * The options available for each select dropdown
	 *
	 * @var array
	 */
	private $select_options = array();
	
	/**
	 * The page hook for this plugin
	 *
	 * @var string
	 */
	private $page_hook;
	
	/**
	 * The properties of the current screen that is being displayed
	 *
	 * @var object
	 */
	private $screen;
	
	/**
	 * Constructor
	 */
	public function __construct(){
	
		$this->set_options();			// Set the currently saved options
		$this->set_defaults();			// Set the default options
		$this->set_select_options();	// Set the options available for each select
		
		add_action('after_setup_theme', array(&$this, 'after_setup_theme'));		// Add the necessary theme support
		add_action('wp_enqueue_scripts', array(&$this, 'on_wp_enqueue_scripts'));	// Enqueue the necessary front end scripts/styeles
		add_action('wp_head', array(&$this, 'on_wp_head'));							// Output the necessary CSS/JS directly into the head of the front end
		add_action('admin_bar_menu', array(&$this, 'on_admin_bar_menu'), 999);		// If nevessary, add the hide button to the admin menu
		add_action('admin_menu', array(&$this, 'on_admin_menu'));					// Add the Admin Bar Button options Settings menu
		add_action('admin_init', array(&$this, 'on_admin_init'));					// Register the settings that can be saved by this plugin
		
	}
	
	/**
	 * Add the necessary theme support
	 */
	public function after_setup_theme(){
	
		/** Set the CSS to remove the space typically alocated to the WordPress Admin Bar */
		add_theme_support('admin-bar', array('callback' => array(&$this, 'on_admin_bar')));
		
	}
	
	/**
	 * Set the CSS to remove the space typically reserved for the WordPress Admin Bar
	 */
	public function on_admin_bar(){
		
		$reserve_space =			$this->get_value('bar_reserve_space');
		$background_colour =		$this->get_value('admin_bar_colour');
		$background_colour_hover =	$this->get_value('admin_bar_colour_hover');
		$text_colour =				$this->get_value('text_colour');
		$text_colour_hover =		$this->get_value('text_colour_hover');

?>
<style media="print" type="text/css">
#wpadminbar { display:none; }
.djg-admin-bar-button { display:none; }
</style>

<?php if((bool)$reserve_space) : ?>

<!-- Admin Bar - Reserved Space -->
<style media="screen" type="text/css">
html{
	margin-top:	32px !important;
}
* html body{
	margin-top:	32px !important;
}
@media screen and (max-width: 782px){
	html{
		margin-top:	46px !important;
	}
	* html body{
		margin-top:	46px !important;
	}
}
</style>

<?php else : ?>

<!-- Admin Bar - No reserved Space -->
<style media="screen" type="text/css">
.admin-bar.masthead-fixed .site-header {
    top:	0; 
}
</style>

<?php endif; ?>

<!-- Admin Bar - Generic -->
<style media="screen" type="text/css">
#wpadminbar{
	background-color:	<?php echo $background_colour; ?> !important;
	display:			none;
}
#wpadminbar:not(.mobile) .ab-top-menu > li:hover > .ab-item{
	background-color:	<?php echo $background_colour_hover; ?> !important;
}

#wpadminbar .menupop .ab-sub-wrapper,
#wpadminbar .shortlink-input{
	background-color:	<?php echo $background_colour_hover; ?> !important;
}

#wpadminbar:not(.mobile) .ab-top-menu > li > .ab-item{
	color:	<?php echo $text_colour; ?> !important;
}
#wpadminbar #adminbarsearch:before,
#wpadminbar .ab-icon:before,
#wpadminbar .ab-item:before{
	color:	<?php echo $text_colour; ?> !important;
}
#wpadminbar a.ab-item,
#wpadminbar > #wp-toolbar span.ab-label,
#wpadminbar > #wp-toolbar span.noticon{
    color:	<?php echo $text_colour; ?> !important;
}

#wpadminbar #adminbarsearch:hover:before,
#wpadminbar > #wp-toolbar a.ab-item:hover span.ab-label,
#wpadminbar > #wp-toolbar span.noticon:hover{
	color:	<?php echo $text_colour_hover; ?> !important;
}
#wpadminbar > #wp-toolbar a.ab-item:hover,
#wpadminbar > #wp-toolbar a.ab-item:hover:before,
#wpadminbar > #wp-toolbar a.ab-item:hover span.ab-icon:before{
	color:	<?php echo $text_colour_hover; ?> !important;
}
</style>

<!-- Admin Bar Button -->
<style media="screen" type="text/css">
.djg-admin-bar-button{
	background-color:	<?php echo $background_colour; ?> !important;
	color:				<?php echo $text_colour; ?> !important;
}
.djg-admin-bar-button:hover{
	background-color:	<?php echo $background_colour_hover; ?> !important;
	color:				<?php echo $text_colour_hover; ?> !important;
}
</style>
<?php
	}
	
	/**
	 * Enqueue the necessary front end scripts/styles
	 */
	public function on_wp_enqueue_scripts(){
		
		/** Enqueue the required scripts/styles */
		if(is_user_logged_in()) :
			wp_enqueue_style('djg-admin-bar-front', plugins_url('css/adminBar-front.css?scope=admin-bar-button', __FILE__ ));
			wp_enqueue_script('djg-admin-bar-front', plugins_url('js/adminBar-front.js?scope=admin-bar-button', __FILE__ ), array('jquery-ui-widget', 'jquery-effects-slide'));
		endif;
		
	}
	
	/**
	 * Output the necessary CSS/JS directly into the head of the front end
	 */
	public function on_wp_head(){
	
		if(is_user_logged_in()) :
?>
<script type="text/javascript">
/** The options to use for displaying the Admin Bar Button */
var djg_admin_bar_button = {
	text:					'<?php echo $this->get_value('text'); ?>',
	text_direction:			'<?php echo $this->get_value('text_direction'); ?>',
	button_position:		'<?php echo $this->get_value('button_position'); ?>',
	button_animate:			'<?php echo $this->get_value('button_animate'); ?>',
	button_direction:		'<?php echo $this->get_value('button_direction'); ?>',
	button_duration:		<?php echo $this->get_value('button_duration'); ?>,
	button_activate:		'<?php echo $this->get_value('button_activate'); ?>',
	bar_reserve_space:		<?php echo $this->get_value('bar_reserve_space'); ?>,
	bar_animate:			'<?php echo $this->get_value('bar_animate'); ?>',
	bar_direction:			'<?php echo $this->get_value('bar_direction'); ?>',
	bar_duration:			<?php echo $this->get_value('bar_duration'); ?>,
	bar_shown_behaviour:	'<?php echo $this->get_value('bar_shown_behaviour'); ?>',
	show_time:				<?php echo $this->get_value('show_time'); ?>,
	show_hide_button:		<?php echo $this->get_value('show_hide_button'); ?>
}
</script>
<?php
		else :
?>
<script type="text/javascript">
/** Don't display the Admin Bar Button (as no user is logged in) */
var djg_admin_bar_button = false
</script>
<?php
		endif;

	}
	
	/**
	 * If necessary, add the hide button to the admin menu 
	 */
	public function on_admin_bar_menu($wp_admin_bar){
	
		/** Check to see if the 'hide' button should be shown */
		if(!$this->get_value('show_hide_button') || is_admin()) :
			return;
		endif;
		
		$button_text = 'Hide '.$this->get_value('text');
		
		$args = array(
			'id'		=> 'hide',
			'parent'	=> 'top-secondary',
			'title'		=> sprintf('<span class="ab-icon dashicons-no"></span><span class="ab-label">%1$s</span>', $button_text),
			'href'		=> '#',
			'meta'		=> array('title' => esc_attr(strip_tags($button_text)))
		);
		$wp_admin_bar->add_node($args);
		
	}
	
	/**
	 * Add the Admin Bar Button options Settings menu
	 */
	public function on_admin_menu(){
	
		$this->page_hook = add_options_page(
			__('Admin Bar Button Settings', $this->plugin_text_domain),	// Page title
			__('Admin Bar Button', $this->plugin_text_domain),			// Menu title
			'manage_options',											// Required capability
			$this->plugin_slug,											// Page slug
			array(&$this, 'on_show_page')								// Rendering callback
		);
		
	}
	
	/**
	 * Register the settings that can be saved by this plugin
	 */
	public function on_admin_init(){
	
		add_action('load-'.$this->page_hook, array(&$this, 'on_admin_load'));	// Set information that can only be gathered once the page has loaded
		
		register_setting(
			'admin_bar_button_group',			// Group name
			'admin_bar_button',					// Option name
			array(&$this, 'on_save_settings')	// Sanatize options callback
		);
		
		
		/*-----------------------------------------------
		  Admin Bar Button
		-----------------------------------------------*/
		
		add_settings_section(
            'abb_button_section',								// ID
            __('Admin Bar Button', $this->plugin_text_domain),	// Title
            false,												// Callback
            'djg_admin_bar_button'								// Page
        );
		
		add_settings_field(
            'text',											// ID
            __('Button Text', $this->plugin_text_domain),	// Title
            array($this, '_option_button_text'),			// Callback
            'djg_admin_bar_button',							// Page
            'abb_button_section',							// Section
			array(											// Args
				'label_for' => 'text'
			)
        );
		
		add_settings_field(
            'text_direction',
            __('Text Direction', $this->plugin_text_domain),
            array($this, '_option_text_direction'),
            'djg_admin_bar_button',
            'abb_button_section',
			array(
				'label_for' => 'text_direction'
			)
        );
		
		add_settings_field(
            'button_position',
            __('Position on the Screen', $this->plugin_text_domain),
            array($this, '_option_button_position'),
            'djg_admin_bar_button',
            'abb_button_section',
			array(
				'label_for' => 'button_position'
			)
        );
		
		add_settings_field(
            'button_activate',
            __('Button Activated On', $this->plugin_text_domain),
            array($this, '_option_button_activate'),
            'djg_admin_bar_button',
            'abb_button_section',
			array(
				'label_for' => 'button_activate'
			)
        );
		
		add_settings_field(
            'button_animate',
            __('Animate', $this->plugin_text_domain),
            array($this, '_option_button_animate'),
            'djg_admin_bar_button',
            'abb_button_section',
			array(
				'label_for' => 'button_animate'
			)
        );
		
		add_settings_field(
            'button_duration',
            __('Slide Duration (milliseconds)', $this->plugin_text_domain),
            array($this, '_option_button_duration'),
            'djg_admin_bar_button',
            'abb_button_section',
			array(
				'label_for' => 'button_duration'
			)
        );
		
		add_settings_field(
            'button_direction',
            __('Slide Direction', $this->plugin_text_domain),
            array($this, '_option_button_direction'),
            'djg_admin_bar_button',
            'abb_button_section',
			array(
				'label_for' => 'button_direction'
			)
        );
		
		
		/*-----------------------------------------------
		  WordPress Admin Bar
		-----------------------------------------------*/
		
		add_settings_section(
            'abb_bar_section',										// ID
            __('WordPress Admin Bar', $this->plugin_text_domain),	// Title
            false,													// Callback
            'djg_admin_bar_button'									// Page
        );
		
		add_settings_field(
            'bar_reserve_space',							// ID
            __('Reserve Space', $this->plugin_text_domain),	// Title
            array($this, '_option_bar_reserve_space'),		// Callback
            'djg_admin_bar_button',							// Page
            'abb_bar_section',								// Section
			array(											// Args
				'label_for' => 'bar_reserve_space'
			)
        );
		
		add_settings_field(
            'bar_animate',								// ID
            __('Animate', $this->plugin_text_domain),	// Title
            array($this, '_option_bar_animate'),		// Callback
            'djg_admin_bar_button',						// Page
            'abb_bar_section',							// Section
			array(										// Args
				'label_for' => 'bar_animate'
			)
        );
		
		add_settings_field(
            'bar_duration',
            __('Slide Duration (milliseconds)', $this->plugin_text_domain),
            array($this, '_option_bar_duration'),
            'djg_admin_bar_button',
            'abb_bar_section',
			array(
				'label_for' => 'bar_duration'
			)
        );
		
		add_settings_field(
            'bar_direction',
            __('Slide Direction', $this->plugin_text_domain),
            array($this, '_option_bar_direction'),
            'djg_admin_bar_button',
            'abb_bar_section',
			array(
				'label_for' => 'bar_direction'
			)
        );
		
		add_settings_field(
            'bar_shown_behaviour',
            __('Admin Bar Behaviour', $this->plugin_text_domain),
            array($this, '_option_bar_shown_behaviour'),
            'djg_admin_bar_button',
            'abb_bar_section',
			array(
				'label_for' => 'bar_shown_behaviour'
			)
        );
		
		add_settings_field(
            'show_time',
            __('Show Time (milliseconds)', $this->plugin_text_domain),
            array($this, '_option_show_time'),
            'djg_admin_bar_button',
            'abb_bar_section',
			array(
				'label_for' => 'show_time'
			)
        );
		
		add_settings_field(
            'show_hide_button',
            __('Show the Hide Button', $this->plugin_text_domain),
            array($this, '_option_show_hide_button'),
            'djg_admin_bar_button',
            'abb_bar_section',
			array(
				'label_for' => 'show_hide_button'
			)
        );
		
		add_settings_field(
            'show_wordpress_menu',
            __('Show the WordPress Menu', $this->plugin_text_domain),
            array($this, '_option_show_wordpress_menu'),
            'djg_admin_bar_button',
            'abb_bar_section',
			array(
				'label_for' => 'show_wordpress_menu'
			)
        );
		
		
		/*-----------------------------------------------
		  WordPress Admin Bar Colours
		-----------------------------------------------*/
		
		add_settings_section(
            'abb_colours_section',						// ID
            __('Colours', $this->plugin_text_domain),	// Title
            false,										// Callback
            'djg_admin_bar_button'						// Page
        );
		
		add_settings_field(
            'admin_bar_colour',									// ID
            __('Background Colour', $this->plugin_text_domain),	// Title
            array($this, '_option_admin_bar_colour'),			// Callback
            'djg_admin_bar_button',								// Page
            'abb_colours_section'
        );
		
		add_settings_field(
            'admin_bar_colour_hover',
            __('Background Colour (Hover)', $this->plugin_text_domain),
            array($this, '_option_admin_bar_colour_hover'),
            'djg_admin_bar_button',
            'abb_colours_section'
        );
		
		add_settings_field(
            'text_colour',
            __('Text Colour', $this->plugin_text_domain),
            array($this, '_option_text_colour'),
            'djg_admin_bar_button',
            'abb_colours_section'
        );
		
		add_settings_field(
            'text_colour_hover',
            __('Text Colour (Hover)', $this->plugin_text_domain),
            array($this, '_option_text_colour_hover'),
            'djg_admin_bar_button',
            'abb_colours_section'
        );
		
	}
	
	/**
	 * Grab the current screen and add contextual help
	 */
	public function on_admin_load(){
	
		add_action('admin_enqueue_scripts', array(&$this, 'on_admin_enqueue_scripts'));				// Enqueue the necessary admin scripts/styeles
		add_action('admin_print_styles-'.$this->page_hook, array(&$this, 'on_admin_print_styles'));	// Print the necessary admin styles
		
		$this->screen = get_current_screen();	// Grab the current screen
		
		$this->screen->set_help_sidebar($this->do_help_sidebar());
		
		$this->screen->add_help_tab(array(
			'id'		=> 'description',
			'title'		=> __('Description'),
			'callback'	=> array(&$this, 'do_help_description')
		));
		
		$this->screen->add_help_tab(array(
			'id'		=> 'faq',
			'title'		=> __('FAQ'),
			'callback'	=> array(&$this, 'do_help_faq')
		));
		
		$this->screen->add_help_tab(array(
			'id'		=> 'support',
			'title'		=> __('Support'),
			'callback'	=> array(&$this, 'do_help_support')
		));
		
		$this->screen->add_help_tab(array(
			'id'		=> 'donate',
			'title'		=> __('Donate'),
			'callback'	=> array(&$this, 'do_help_donate')
		));
		
	}
	
	/**
	 * Enqueue the necessary admin scripts/styles
	 */
	public function on_admin_enqueue_scripts(){
	
		/** Enqueue the required scripts/styles */
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('abb-colour-picker', plugins_url('css/rgba-color-picker.css?scope=admin-bar-button', __FILE__));
		wp_enqueue_script('abb-colour-picker', plugins_url('js/rgba-color-picker.js?scope=admin-bar-button', __FILE__), array('jquery','wp-color-picker'), '', true);
		wp_enqueue_style('abb-admin', plugins_url('css/adminBar-admin.css?scope=admin-bar-button', __FILE__));
		wp_enqueue_script('abb-admin', plugins_url('js/adminBar-admin.js?scope=admin-bar-button', __FILE__), array('jquery-ui-tabs'));
		
	}
	
	/**
	 * Enqueue the necessary admin styles
	 */
	public function on_admin_print_styles(){
?>
<style>
.tips{
	display: inline-block;
	font-style:	italic;
	margin-left: 10px;
	vertical-align: middle;
}
.tip{
	display: block;
}
</style>
<?php
	}
	
	/**
	 * Render the plugin page
	 */
	public function on_show_page(){
	
?>
		<div id="admin-bar-button-page" class="wrap admin-bar-button">
		
			<h2><?php _e('Admin Bar Button Settings', $this->plugin_text_domain); ?></h2>
			
			<form action="options.php" method="post">
			
				<?php settings_fields('admin_bar_button_group'); ?>
				<?php $this->do_settings_sections_tabs('djg_admin_bar_button'); ?>
				<p>
					<?php submit_button('Save Changes', 'primary', 'submit', false); ?>
					<?php submit_button('Restore Defaults', 'delete', 'delete', false); ?>
				</p>
				
			</form>
		</div>
<?php
	}
	
	/**
	 * Sanitize the option on save
	 */
	public function on_save_settings($input){
	
		/** Check to see if the options should be restored to default */
		if(isset($_POST['delete'])) :
			delete_option('admin_bar_button');
			return;
		endif;
		
		if(!isset($_POST['submit'])) return;	// Ensure the user is supposed to be here
		
		$this->set_defaults();			// Set the default options
		$this->set_select_options();	// Set the options available for each select
		$new_input = array();			// Create a new array to hold the sanitized options
		
		/** Button text */
        if(isset($input['text'])) :
			$text = sanitize_text_field($input['text']);
            $new_input['text'] = ($text !== '') ? $text : $this->defaults['text'];
		endif;
		
        /** Text direction */
		if(isset($input['text_direction'])) :
            $new_input['text_direction'] = (array_key_exists($input['text_direction'], $this->select_options['text_direction'])) ? $input['text_direction'] : $this->defaults['text_direction'];
		endif;
		
		/** Button position */
		if(isset($input['button_position'])) :
            $new_input['button_position'] = (array_key_exists($input['button_position'], $this->select_options['button_position'])) ? $input['button_position'] : $this->defaults['button_position'];
		endif;
		
		/** Button activate */
		if(isset($input['button_activate'])) :
            $new_input['button_activate'] = (array_key_exists($input['button_activate'], $this->select_options['button_activate'])) ? $input['button_activate'] : $this->defaults['button_activate'];
		endif;
		
		/** Button animate */
		if(isset($input['button_animate'])) :
            $new_input['button_animate'] = (array_key_exists($input['button_animate'], $this->select_options['button_animate'])) ? $input['button_animate'] : $this->defaults['button_animate'];
		endif;
		
		/** Button duration */
		if(isset($input['button_duration'])) :
			$time = absint($input['button_duration']);
			$new_input['button_duration'] = ($time >= 0) ? $time : $this->defaults['button_duration'];
		endif;
		
		/** Button direction */
		if(isset($input['button_direction'])) :
            $new_input['button_direction'] = (array_key_exists($input['button_direction'], $this->select_options['button_direction'])) ? $input['button_direction'] : $this->defaults['button_direction'];
		endif;
		
		/** Show reserve space */
		if(isset($input['bar_reserve_space'])) :
			$new_input['bar_reserve_space'] = (isset($input['bar_reserve_space'])) ? intval($input['bar_reserve_space']) : intval($this->defaults['bar_reserve_space']);
		endif;
		
		/** Bar animate */
		if(isset($input['bar_animate'])) :
            $new_input['bar_animate'] = (array_key_exists($input['bar_animate'], $this->select_options['bar_animate'])) ? $input['bar_animate'] : $this->defaults['bar_animate'];
		endif;
		
		/** Bar duration */
		if(isset($input['bar_duration'])) :
			$time = absint($input['bar_duration']);
			$new_input['bar_duration'] = ($time >= 0) ? $time : $this->defaults['bar_duration'];
		endif;
		
		/** Bar direction */
		if(isset($input['bar_direction'])) :
            $new_input['bar_direction'] = (array_key_exists($input['bar_direction'], $this->select_options['bar_direction'])) ? $input['bar_direction'] : $this->defaults['bar_direction'];
		endif;
		
		/** Bar shown behaviour */
		if(isset($input['bar_shown_behaviour'])) :
            $new_input['bar_shown_behaviour'] = (array_key_exists($input['bar_shown_behaviour'], $this->select_options['bar_shown_behaviour'])) ? $input['bar_shown_behaviour'] : $this->defaults['bar_shown_behaviour'];
		endif;
		
		/** Show time */
		if(isset($input['show_time'])) :
			$time = absint($input['show_time']);
			$new_input['show_time'] = ($time >= 2000) ? $time : $this->defaults['show_time'];
		endif;
		
		/** Show hide button */
		if(isset($input['show_hide_button'])) :
			$new_input['show_hide_button'] = (isset($input['show_hide_button'])) ? intval($input['show_hide_button']) : intval($this->defaults['show_hide_button']);
		endif;
		
		/** Show WordPress menu */
		if(isset($input['show_wordpress_menu'])) :
			$new_input['show_wordpress_menu'] = (isset($input['show_wordpress_menu'])) ? intval($input['show_wordpress_menu']) : intval($this->defaults['show_wordpress_menu']);
		endif;
		
		/** Bar background colour */
		if(isset($input['admin_bar_colour'])) :
			$new_input['admin_bar_colour'] = $this->sanitize_hex_rgba($input['admin_bar_colour']);
		endif;
		
		/** Bar background colour (hover) */
		if(isset($input['admin_bar_colour_hover'])) :
			$new_input['admin_bar_colour_hover'] = $this->sanitize_hex_rgba($input['admin_bar_colour_hover']);
		endif;
		
		/** Text colour */
		if(isset($input['text_colour'])) :
			$new_input['text_colour'] = $this->sanitize_hex_rgba($input['text_colour']);
		endif;
		
		/** Text colour (hover) */
		if(isset($input['text_colour_hover'])) :
			$new_input['text_colour_hover'] = $this->sanitize_hex_rgba($input['text_colour_hover']);
		endif;
		
        return $new_input;
		
	}
	
	/**
	 * Set the $options, grabbed from the 'wp_options' DB table
	 */
	private function set_options(){
	
		$this->options = get_option('admin_bar_button');
		
	}
	
	/**
	 * Set the default values, used if a value is not set when the 'on_show_page' or 'on_save_settings' methods are called
	 */
	private function set_defaults(){
	
		$this->dafaults = array(
			'text'						=> __('Admin bar', $this->plugin_text_domain),
			'text_direction'			=> 'ltr',
			'button_position'			=> 'top-left',
			'button_activate'			=> 'both',
			'button_animate'			=> 'yes',
			'button_duration'			=> 500,
			'button_direction'			=> 'left',
			'bar_reserve_space'			=> 0,
			'bar_animate'				=> 'yes',
			'bar_duration'				=> 500,
			'bar_direction'				=> 'right',
			'bar_shown_behaviour'		=> 'go',
			'show_time'					=> 5000,
			'show_hide_button'			=> 1,
			'show_wordpress_menu'		=> 1,
			'admin_bar_colour'			=> '#23282D',
			'admin_bar_colour_hover'	=> '#32373C',
			'text_colour'				=> '#9EA3A8',
			'text_colour_hover'			=> '#00B9EB'
		);
		
	}
	
	/**
	 * Set the options that are available for each of the <select> elements
	 *
	 * @param string $scope	The set of options to return
	 */
	private function set_select_options($scope = null){
	
		$this->select_options = array(
			'text_direction'	=> array(
				'ltr'	=> __('Left to right', $this->plugin_text_domain),
				'rtl'	=> __('Right to left', $this->plugin_text_domain)
			),
			'button_position'	=> array(
				'top-left'		=> __('Top left', $this->plugin_text_domain),
				'top-right'		=> __('Top right', $this->plugin_text_domain),
				'bottom-left'	=> __('Bottom left', $this->plugin_text_domain),
				'bottom-right'	=> __('Bottom right', $this->plugin_text_domain)
			),
			'button_activate'	=> array(
				'both'	=> __('Click and hover', $this->plugin_text_domain),
				'click'	=> __('Click', $this->plugin_text_domain),
				'hover'	=> __('Hover', $this->plugin_text_domain)
			),
			'button_animate'	=> array(
				'yes'	=> __('Yes, animate it', $this->plugin_text_domain),
				'no'	=> __('No, show/hide it instantly', $this->plugin_text_domain)
			),
			'button_direction'	=> array(
				'up'	=> __('Slide up', $this->plugin_text_domain),
				'down'	=> __('Slide down', $this->plugin_text_domain),
				'left'	=> __('Slide left', $this->plugin_text_domain),
				'right'	=> __('Slide right', $this->plugin_text_domain)
			),
			'bar_animate'	=> array(
				'yes'	=> __('Yes, animate it', $this->plugin_text_domain),
				'no'	=> __('No, show/hide it instantly', $this->plugin_text_domain)
			),
			'bar_direction'	=> array(
				'up'	=> __('Slide up', $this->plugin_text_domain),
				'down'	=> __('Slide down', $this->plugin_text_domain),
				'left'	=> __('Slide left', $this->plugin_text_domain),
				'right'	=> __('Slide right', $this->plugin_text_domain)
			),
			'bar_shown_behaviour' => array(
				'go'	=> __('Hide after a defined time', $this->plugin_text_domain),
				'stay'	=> __('Always remain open', $this->plugin_text_domain)
			)
		);
		
	}
	
	/**
	 * Sanitize a hex colour (3 or 6 characters)
	 *
	 * @param required string $colour	The colour to check
	 * @return string					Sanitized colour or default
	 */
	private function sanitize_hex_rgba($colour){
	
		/** Ensure that the hex colour begins with a string */
		if(!$colour[0] === '#')
			$colour = '#'.$colour;
		
		return (preg_match('/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)|(rgba\(\d+\,\d+\,\d+\,([^\)]+)\))/i', $colour)) ? $colour : $this->defaults['admin_bar_color'];
		
	}
	
	/**
	 * Output the help sidebar
	 */
	private function do_help_sidebar(){
	
		ob_start();
?>
			<p>
				<strong><?php _e('For more information', $this->plugin_text_domain); ?>:</strong>
			</p>
			<p>
				<a href="http://wordpress.org/plugins/admin-bar-button/" title="'<?php esc_attr_e('Admin Bar Button', $this->plugin_text_domain); ?>">
					<?php _e('Visit the Plugin Page', $this->plugin_text_domain); ?>
				</a>
			</p>
<?php
		return ob_get_clean();
	
	}
	
	/**
	 * Callback for outputting the 'Description' halp tab
	 */
	public function do_help_description(){
?>
		<p>
			<?php _e('Thanks for installing Admin Bar Button, I hope that you like the plugin.', $this->plugin_text_domain); ?>
		</p>
		<p>
			<?php _e('Admin Bar Button is a plugin that will create a simple button to replace the default WordPress admin bar on the front end.  ', $this->plugin_text_domain); ?>
			<?php _e('When using this plugin, the full height of the page is used by your site, which is particularly handy if you have fixed headers.', $this->plugin_text_domain); ?>
		</p>
		<p>
			<?php _e('Please see the ', $this->plugin_text_domain); ?>
			<a href="http://wordpress.org/plugins/admin-bar-button/screenshots/" title="<?php esc_attr_e('Admin Bar Button &raquo; Screenshots', $this->plugin_text_domain); ?>">
				<?php _e('these screenshots', $this->plugin_text_domain); ?>
			</a>
			<?php _e('to see how the Admin Bar Button looks.', $this->plugin_text_domain); ?>
		</p>
<?php
	}
	
	/**
	 * Callback for outputting the 'FAQ' halp tab
	 */
	public function do_help_faq(){
?>
		<h3>
			<?php _e('What do all of the options mean?', $this->plugin_text_domain); ?>
		</h3>
		<p><strong><em>
			<?php _e('The Admin Bar Button, added by this plugin', $this->plugin_text_domain); ?>
		</em></strong></p>
		<ul>
			<li><strong><?php _e('Button Text', $this->plugin_text_domain); ?></strong>: <?php _e('The text to display in the Admin Bar Button.  You can set this to anything you want, the button will resize appropriately.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Text Direction', $this->plugin_text_domain); ?></strong>: <?php _e('The direction of the Admin Bar Button text.  Default is left-to-right, but you can use right-to-left if appropriate for you language.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Position on the Screen', $this->plugin_text_domain); ?></strong>: <?php _e('Where on the screen to position the Admin Bar Button.  You can place the button in any of the four corners.  If you choose \'Bottom left\' or \'Bottom right\' then the WordPress Admin Bar will also be shown on the bottom of the screen.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Button Activated On', $this->plugin_text_domain); ?></strong>: <?php _e('The actions that will activate the Admin Bar.  Currently you can choose between when the user clicks the button, when they hover over it, or both.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Animate', $this->plugin_text_domain); ?></strong>: <?php _e('Whether or not to animate the show/hide of the Admin Bar Button.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Duration', $this->plugin_text_domain); ?></strong>: <?php _e('The time (in milliseconds) that it takes for the Admin Bar Button to slide off of the screen (and back on to it when the WordPress Admin Bar is hidden again).  Any positive value is acceptable, and setting it to \'0\' will disable the animation.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Direction', $this->plugin_text_domain); ?></strong>: <?php _e('The direction from which the Admin Bar Button will slide off of the screen (and back on to it when the WordPress Admin Bar is hidden again).  This option is irrelevant and so ignored if either \'Animate\' is set to \'No\' or \'Slide Duration\' is set to \'0\'.', $this->plugin_text_domain); ?></li>
		</ul>                                                            
		<p><strong><em>
			<?php _e('The WordPress Admin Bar', $this->plugin_text_domain); ?>
		</em></strong></p>
		<ul>
			<li><strong><?php _e('Reserve Space', $this->plugin_text_domain); ?></strong>: <?php _e('Whether or not reserve space at the top of the page for the WordPress Admin Bar.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Animate', $this->plugin_text_domain); ?></strong>: <?php _e('Whether or not to animate the show/hide of the WordPress Admin Bar.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Duration', $this->plugin_text_domain); ?></strong>: <?php _e('The time (in milliseconds) that it takes for the WordPress Admin Bar to slide on to the screen (and back off of it when the Admin Bar Button is shown again).  Any positive value is acceptable, and setting it to \'0\' will disable the animation.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Direction', $this->plugin_text_domain); ?></strong>: <?php _e('The direction from which the WordPress Admin Bar will slide on to the screen (and back off of it when the Admin Bar Button is shown again).  This option is irrelevant and so ignored if either \'Animate\' is set to \'No\' or \'Slide Duration\' is set to \'0\'.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Admin Bar Behaviour', $this->plugin_text_domain); ?></strong>: <?php _e('Whether the WordPress Admin Bar should close automatically after the time defined in \'Show Time\', or remain open.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Show Time', $this->plugin_text_domain); ?></strong>: <?php _e('The time (in milliseconds) that the Admin Bar will be visible for, when shown.  The minimum time is 2000 (2 seconds), and setting this option to less than that will result in the default being used.  This option is irrelevant and so ignored if either \'Admin Bar Behaviour\' is set to \'Always remain open\'.', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Show the Hide Button', $this->plugin_text_domain); ?></strong>: <?php _e('Whether or not to show the \'Hide\' button on the WordPress Admin Bar.', $this->plugin_text_domain); ?></li>
		</ul>                                                       
		
		<h3>
			<?php _e('What are the option defaults?', $this->plugin_text_domain); ?>
		</h3>
		<p><strong><em>
			<?php _e('The Admin Bar Button, added by this plugin', $this->plugin_text_domain); ?>
		</em></strong></p>
		<ul>
			<li><strong><?php _e('Button Text', $this->plugin_text_domain); ?></strong>: <?php _e('Admin bar', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Text Direction', $this->plugin_text_domain); ?></strong>: <?php _e('Left to right', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Position on the Screen', $this->plugin_text_domain); ?></strong>: <?php _e('Top left', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Button Activated On', $this->plugin_text_domain); ?></strong>: <?php _e('Hover and click', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Animate', $this->plugin_text_domain); ?></strong>: <?php _e('Yes', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Duration', $this->plugin_text_domain); ?></strong>: <?php _e('500 milliseconds (0.5 seconds)', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Direction', $this->plugin_text_domain); ?></strong>: <?php _e('Left', $this->plugin_text_domain); ?></li>
		</ul>                                                                
		<p><strong><em>
			<?php _e('The WordPress Admin Bar', $this->plugin_text_domain); ?>
		</em></strong></p>
		<ul>
			<li><strong><?php _e('Reserve Space', $this->plugin_text_domain); ?></strong>: <?php _e('No', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Animate', $this->plugin_text_domain); ?></strong>: <?php _e('Yes', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Duration', $this->plugin_text_domain); ?></strong>: <?php _e('500 milliseconds (0.5 seconds)', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Slide Direction', $this->plugin_text_domain); ?></strong>: <?php _e('Right', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Admin Bar Behaviour', $this->plugin_text_domain); ?></strong>: <?php _e('Hide after a defined time', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Show Time', $this->plugin_text_domain); ?></strong>: <?php _e('5000 milliseconds (5 seconds)', $this->plugin_text_domain); ?></li>
			<li><strong><?php _e('Show the Hide Button', $this->plugin_text_domain); ?></strong>: <?php _e('Yes', $this->plugin_text_domain); ?></li>
		</ul>                                                       
		
		<h3>
			<?php _e('Can I prevent the Admin Bar Button and/or the WordPress Admin Bar being animated when it is shown or hidden?', $this->plugin_text_domain); ?>
		</h3>
		<p>
			<?php _e('Yes, you simply have to set the', $this->plugin_text_domain); ?>
			<strong><?php _e('Animate', $this->plugin_text_domain); ?></strong>
			<?php _e('option to', $this->plugin_text_domain); ?>
			<strong><?php _e('No, show/hide it instantly', $this->plugin_text_domain); ?></strong>.
			<?php _e('There is a separate option for both the ', $this->plugin_text_domain); ?>
			<strong><?php _e('Admin Bar Button', $this->plugin_text_domain); ?></strong>
			<?php _e('and the', $this->plugin_text_domain); ?>
			<strong><?php _e('WordPress Admin Bar', $this->plugin_text_domain); ?></strong>,
			<?php _e('so you can animate only one or the other if you so choose.', $this->plugin_text_domain); ?>
		</p>
		
		<?php
		$settings_link = sprintf(
			'<a href="%1$s" title="%2$s">%3$s</a>',
			admin_url('options-general.php?page='.$this->plugin_slug),
			__('View the Settings page', $this->plugin_text_domain),
			'<strong>'.__('Settings', $this->plugin_text_domain).'</strong>'
		)
		 ?>
		<h3>
			<?php _e('Can I restore the default settings?', $this->plugin_text_domain); ?>
		</h3>
		<p>
			<?php _e('Of course.  Simply visit the', $this->plugin_text_domain); ?>
			<?php echo $settings_link; ?>
			<?php _e('page', $this->plugin_text_domain); ?>
			(<em><?php _e('Settings &raquo; Admin Bar Button', $this->plugin_text_domain); ?></em>),
			<?php _e('scroll to the bottom and click Restore Defaults.  ', $this->plugin_text_domain); ?>
			<?php _e('You\'ll be asked to confirm that you wish to do this, and then all of the defaults will be restored.', $this->plugin_text_domain); ?>
		</p>
<?php
	}
	
	/**
	 * Callback for outputting the 'Support' halp tab
	 */
	public function do_help_support(){
?>
		<p>
			<?php _e('If you find a bug with this plugin please report it on the ', $this->plugin_text_domain); ?>
			<a href="http://wordpress.org/support/plugin/admin-bar-button" title="<?php esc_attr_e('Admin Bar Button &raquo; Support', $this->plugin_text_domain); ?>">
				<?php _e('plugin support page', $this->plugin_text_domain); ?>
			</a>
			<?php _e('and I\'ll do my best to fix the problem quickly for you.', $this->plugin_text_domain); ?>
		</p>
		<p>
			<?php _e('General comments, gripes and requests relating to this plugin are also welcome, especially if you are using a theme with which this plugin does not function correctly.', $this->plugin_text_domain); ?>
		</p>
<?php
	}
	
	/**
	 * Callback for outputting the 'Donate' halp tab
	 */
	public function do_help_donate(){
?>
		<p>
			<?php _e('This plugin is free to use and you may distribute it as you please', $this->plugin_text_domain); ?>
		</p>
		<p>
			<?php _e('I love coding and have made this plugin because it was something I felt was useful, and hopefully you will to.  ', $this->plugin_text_domain); ?>
			<?php _e('There is absolutely no obligation for you to do so, but if you like my work I\'d be very grateful for any donations that you wish to make.', $this->plugin_text_domain); ?>
		</p>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="3DPCXL86N299A">
			<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal – The safer, easier way to pay online.">
			<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
		</form>
<?php
	}
	
	function do_settings_sections_tabs($page){
		
		global $wp_settings_sections, $wp_settings_fields;
		
		if(!isset($wp_settings_sections[$page])) :
			return;
		endif;
		
		echo '<div id="abb-tabs">';
		echo '<ul>';
		
		foreach((array)$wp_settings_sections[$page] as $section) :
		
			if(!isset($section['title']))
				continue;
			
			printf('<li><a href="#%1$s">%2$s</a></li>',
				$section['id'],		/** %1$s - The ID of the tab */
				$section['title']	/** %2$s - The Title of the section */
			);
			
		endforeach;
		
		echo '</ul>';
		
		foreach((array)$wp_settings_sections[$page] as $section) :
		
			printf('<div id="%1$s">',
				$section['id']		/** %1$s - The ID of the tab */
			);
			
			if(!isset($section['title']))
				continue;
			
			if($section['callback'])
				call_user_func($section['callback'], $section);
			
			if(!isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section['id']]))
				continue;
				
			echo '<table class="form-table">';
			do_settings_fields($page, $section['id']);
			echo '</table>';
			
			echo '</div>';
			
		endforeach;
		
		echo '</div>';
		
	}
	
	/**
	 * Output an option of the $type specified
	 *
	 * @param required string $type	The type of option to output
	 * @parma required string $id	The ID of the option that is to be output
	 * @param array $args			The arguments to use for the option that is to be output
	 */
	private function do_option($type, $id, $args = array()){
	
		switch($type) :
		
			case 'text' :
				$this->do_option_text($id, $args);
				break;
			case 'checkbox' :
				$this->do_option_checkbox($id, $args);
				break;
			case 'select' :
				$this->do_option_select($id, $args);
				break;
		
		endswitch;
		
	}
	
	/**
	 * Output a text <input> option
	 *
	 * @parma required string $id	The ID of the option that is to be output
	 * @param array $args			The arguments to use for the option that is to be output
	 */
	private function do_option_text($id, $args = array()){
	
		$defaults = array(
			'name'			=> '',
			'value'			=> false,
			'class'			=> '',
			'description'	=> false,
			'tips'			=> false,
			'readonly'		=> false
		);
		$args = wp_parse_args($args, $defaults);
		extract($args, EXTR_OVERWRITE);
		
		$name = ($name !== '') ? $name : $id;
		$readonly = ($readonly) ? 'readonly="true"' : false;
		
		printf(
			"\n\t".'<input type="text" id="%1$s" class="%2$s" name="%3$s" value="%4$s" %5$s />'."\n",
			$id,		/** %1$s - The ID of the input */
			$class,		/** %2$s - The class of the input */
			$name,		/** %3$s - The name of the select */
			$value,		/** %4$s - The value of the option */
			$readonly	/** %5$s - Whether or not the option is readonly */
		);
		
		$this->do_tips($tips);
		$this->do_description($description);
		
	}
	
	/**
	 * Output a checkbox <input> option
	 *
	 * @parma required string $id	The ID of the option that is to be output
	 * @param array $args			The arguments to use for the option that is to be output
	 */
	private function do_option_checkbox($id, $args = array()){
	
		$defaults = array(
			'name'			=> '',
			'checked'		=> false,
			'class'			=> '',
			'description'	=> false,
			'tips'			=> false
		);
		$args = wp_parse_args($args, $defaults);
		extract($args, EXTR_OVERWRITE);
		
		$name = ($name !== '') ? $name : $id;
		$checked = ($checked) ? 'checked="true"' : false;
		
		/** Include a hidden input with a value of '0' so that unchecked boxes are given a vaule when _POSTed */
		printf(
			"\n\t".'<input type="hidden" id="%1$s-hidden" class="%2$s" name="%3$s" value="0" />'."\n",
			$id,		/** %1$s - The ID of the input */
			$class,		/** %2$s - The class of the input */
			$name		/** %3$s - The name of the select */
		);
		
		printf(
			"\n\t".'<input type="checkbox" id="%1$s" class="%2$s" name="%3$s" value="1" %4$s />'."\n",
			$id,		/** %1$s - The ID of the input */
			$class,		/** %2$s - The class of the input */
			$name,		/** %3$s - The name of the select */
			$checked	/** %4$s - Whether or not the checkbox is checked */
		);
		
		$this->do_tips($tips);
		$this->do_description($description);
		
	}
	
	/**
	 * Output a <select> option
	 *
	 * @parma required string $id	The ID of the option that is to be output
	 * @param array $args			The arguments to use for the option that is to be output
	 */
	private function do_option_select($id, $args = array()){
	
		$defaults = array(
			'name'			=> '',
			'options'		=> array(),
			'selected'		=> false,
			'class'			=> '',
			'optgroup'		=> 'Select an option',
			'description'	=> false,
			'tips'			=> false,
			'disabled'		=> false
		);
		$args = wp_parse_args($args, $defaults);
		extract($args, EXTR_OVERWRITE);
		
		$name = ($name !== '') ? $name : $id;
		$disabled = ($disabled) ? 'disabled="true"' : false;
		
		if(!empty($options)) :
		
			/** Include a hidden input with the option value so that disabled selects are given a vaule when _POSTed */
			printf(
				"\n\t".'<input type="hidden" id="%1$s-hidden" class="%2$s" name="%3$s" value="%4$s" />'."\n",
				$id,		/** %1$s - The ID of the input */
				$class,		/** %2$s - The class of the input */
				$name,		/** %3$s - The name of the select */
				$selected	/** %4$s - The currently selected value */
			);
			
			printf(
				"\n\t".'<select id="%1$s" class="%2$s" name="%3$s" %4$s>'."\n",
				$id,		/** %1$s - The ID of the select */
				$class,		/** %2$s - The class of the select */
				$name,		/** %3$s - The name of the select */
				$disabled	/** %4$s - Whether or no the select is disabled */
			);
			
			if($optgroup) :
				printf(
					'<optgroup label="%1$s">',
					$optgroup	/** %1$s - The title of the Option Group for this set of options */
				);
			endif;
			
			foreach($options as $option => $text) :
			
				$is_selected = ($option === $selected) ? ' selected="true"' : false;
				printf(
					"\t\t".'<option value="%1$s"%2$s>%3$s</option>'."\n",
					$option,		/** %1$s - The option value */
					$is_selected,	/** %2$s - Whether or not the option is selected */
					$text			/** %3$s - The option text */
				);
				
			endforeach;
			
			if($optgroup) :
				echo '</optgroup>';
			endif;
			
			echo "\t".'</select>'."\n";
			
		endif;
		
		$this->do_tips($tips);
		$this->do_description($description);
		
	}
	
	/**
	 * Output a description underneath an option
	 *
	 * @since 2.2
	 * @param required mixed $description	The description to output
	 */
	private function do_description($description){
	
		if(is_string($description)) :
			printf(
				"\n\t".'<p class="description">%1$s</p>'."\n",
				$description	/** %1$s - A brief description of the option */
			);
		endif;
		
	}
	
	/**
	 * Output a tip next do an option
	 *
	 * @since 2.2
	 * @param required array $tips	The tips to output (must be an array of arrays)
	 */
	private function do_tips($tips){
	
		if(!empty($tips)) :
		
			echo '<span class="tips">';
			
			foreach($tips as $tip) :
		
				if(is_array($tip)) :
					printf(
						"\n\t".'<span class="tip"><strong>%1$s:</strong> %2$s</span>'."\n",
						$tip[0],	/** %1$s - The tip prefix */
						$tip[1]		/** %2$s - The tip to display */
					);
				elseif(is_string($tip)) :
					printf(
						"\n\t".'<span class="tip">%1$s</span>'."\n",
						$tip	/** %1$s - The tip to display */
					);
				endif;
				
			endforeach;
			
			echo '</span>';
			
		endif;
		
	}
	
	/**
	 * Callback for outputting the 'text' option
	 */
	public function _option_button_text(){
	
		$value = $this->get_value('text');	// Get the value currently saved for this option
		
		$this->do_option(
			'text',				// Option type
			'text',				// ID
			array(				// Args
				'name'			=> 'admin_bar_button[text]',
				'value'			=> $value,
				'class'			=> 'regular-text'
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'text_direction' option
	 */
	public function _option_text_direction(){
	
		$options = $this->select_options['text_direction'];	// Get the valid options for this setting
		$selected = $this->get_value('text_direction');		// Get the value currently selected for this option
		
		$this->do_option(
			'select',			// Option type
			'text_direction',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[text_direction]',
				'options'		=> $options,
				'selected'		=> $selected
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'button_position' option
	 */
	public function _option_button_position(){
	
		$options = $this->select_options['button_position'];	// Get the valid options for this setting
		$selected = $this->get_value('button_position');		// Get the value currently selected for this option
		
		$this->do_option(
			'select',			// Option type
			'button_position',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[button_position]',
				'options'		=> $options,
				'selected'		=> $selected
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'button_activate' option
	 */
	public function _option_button_activate(){
	
		$options = $this->select_options['button_activate'];	// Get the valid options for this setting
		$selected = $this->get_value('button_activate');		// Get the value currently selected for this option
		
		$this->do_option(
			'select',			// Option type
			'button_activate',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[button_activate]',
				'options'		=> $options,
				'selected'		=> $selected,
				'description'	=> __('The actions that will activate the Admin Bar.', $this->plugin_text_domain)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'button_animate' option
	 */
	public function _option_button_animate(){
	
		$options = $this->select_options['button_animate'];	// Get the valid options for this setting
		$selected = $this->get_value('button_animate');		// Get the value currently selected for this option
		
		$this->do_option(
			'select',			// Option type
			'button_animate',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[button_animate]',
				'options'		=> $options,
				'selected'		=> $selected
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'button_duration' option
	 */
	public function _option_button_duration(){
	
		$value = $this->get_value('button_duration');	// Get the value currently saved for this option
		$button_animate = $this->get_value('button_animate');
		$readonly = ($button_animate === 'no') ? true : false;
		
		$this->do_option(
			'text',				// Option type
			'button_duration',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[button_duration]',
				'value'			=> $value,
				'class'			=> 'regular-text',
				'description'	=> __('The time that it takes for the Admin Bar Button to slide off of (and on to) the screen.', $this->plugin_text_domain),
				'readonly'		=> $readonly
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'button_direction' option
	 */
	public function _option_button_direction(){
	
		$options = $this->select_options['button_direction'];	// Get the valid options for this setting
		$selected = $this->get_value('button_direction');		// Get the value currently selected for this option
		$button_animate = $this->get_value('button_animate');
		$disabled = ($button_animate === 'no') ? true : false;
		
		$this->do_option(
			'select',			// Option type
			'button_direction',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[button_direction]',
				'options'		=> $options,
				'selected'		=> $selected,
				'description'	=> __('The side of the screen from which the Admin Bar Button will exit (and enter).', $this->plugin_text_domain),
				'disabled'		=> $disabled
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'bar_reserve_space' option
	 */
	public function _option_bar_reserve_space(){
	
		$value = $this->get_value('bar_reserve_space');	// Get the value currently saved for this option
		$checked = ($value) ? true : false;
		
		$this->do_option(
			'checkbox',			// Option type
			'bar_reserve_space',		// ID
			array(				// Args
				'name'			=> 'admin_bar_button[bar_reserve_space]',
				'checked'		=> $checked,
				'description'	=> __('Whether or not to reserve space for the WordPress Admin Bar.', $this->plugin_text_domain),
				'tips'			=> array(
					array(
						__('Tip', $this->plugin_text_domain),
						__('The default WordPress Admin Bar does this, but for most sites it\'s unnecessary.', $this->plugin_text_domain)
					)
				)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'bar_animate' option
	 */
	public function _option_bar_animate(){
	
		$options = $this->select_options['bar_animate'];	// Get the valid options for this setting
		$selected = $this->get_value('bar_animate');		// Get the value currently selected for this option
		
		$this->do_option(
			'select',			// Option type
			'bar_animate',		// ID
			array(				// Args
				'name'			=> 'admin_bar_button[bar_animate]',
				'options'		=> $options,
				'selected'		=> $selected
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'bar_duration' option
	 */
	public function _option_bar_duration(){
	
		$value = $this->get_value('bar_duration');	// Get the value currently saved for this option
		$bar_animate = $this->get_value('bar_animate');
		$readonly = ($bar_animate === 'no') ? true : false;
		
		$this->do_option(
			'text',				// Option type
			'bar_duration',		// ID
			array(				// Args
				'name'			=> 'admin_bar_button[bar_duration]',
				'value'			=> $value,
				'class'			=> 'regular-text',
				'description'	=> __('The time that it takes for the Admin Bar to slide on to (and off of) the screen.', $this->plugin_text_domain),
				'readonly'		=> $readonly
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'bar_direction' option
	 */
	public function _option_bar_direction(){
	
		$options = $this->select_options['bar_direction'];	// Get the valid options for this setting
		$selected = $this->get_value('bar_direction');		// Get the value currently selected for this option
		$bar_animate = $this->get_value('bar_animate');
		$disabled = ($bar_animate === 'no') ? true : false;
		
		$this->do_option(
			'select',			// Option type
			'bar_direction',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[bar_direction]',
				'options'		=> $options,
				'selected'		=> $selected,
				'description'	=> __('The side of the screen from which the Admin Bar will enter (and exit).', $this->plugin_text_domain),
				'disabled'		=> $disabled
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'bar_shown_behaviour' option
	 */
	public function _option_bar_shown_behaviour(){
	
		
		$options = $this->select_options['bar_shown_behaviour'];	// Get the valid options for this setting
		$selected = $this->get_value('bar_shown_behaviour');		// Get the value currently selected for this option 
		
		$this->do_option(
			'select',				// Option type
			'bar_shown_behaviour',	// ID
			array(					// Args
				'name'			=> 'admin_bar_button[bar_shown_behaviour]',
				'options'		=> $options,
				'selected'		=> $selected,
				'description'	=> __('Once the Admin Bar is shown, what should happen to it?', $this->plugin_text_domain)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'show_time' option
	 */
	public function _option_show_time(){
	
		$value = $this->get_value('show_time');	// Get the value currently saved for this option
		$bar_shown_behaviour = $this->get_value('bar_shown_behaviour');
		$readonly = ($bar_shown_behaviour === 'stay') ? true : false;
		
		$this->do_option(
			'text',				// Option type
			'show_time',		// ID
			array(				// Args
				'name'			=> 'admin_bar_button[show_time]',
				'value'			=> $value,
				'class'			=> 'regular-text',
				'description'	=> __('The time that the Admin Bar will be visible for, when shown.', $this->plugin_text_domain),
				'readonly'		=> $readonly
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'show_hide_button' option
	 */
	public function _option_show_hide_button(){
	
		$value = $this->get_value('show_hide_button');	// Get the value currently saved for this option
		$checked = ($value) ? true : false;
		
		$this->do_option(
			'checkbox',			// Option type
			'show_hide_button',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[show_hide_button]',
				'checked'		=> $checked,
				'description'	=> __('Whether or not to include a \'hide\' button on the Admin Bar when it is shown.', $this->plugin_text_domain),
				'tips'			=> array(
					array(
						__('Tip', $this->plugin_text_domain),
						__('Recommended if you set <b>Admin Bar Behaviour</b> to \'Always remain open\'.', $this->plugin_text_domain)
					)
				)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'show_wordpress_menu' option
	 */
	public function _option_show_wordpress_menu(){
	
		$value = $this->get_value('show_wordpress_menu');	// Get the value currently saved for this option
		$checked = ($value) ? true : false;
		
		$this->do_option(
			'checkbox',				// Option type
			'show_wordpress_menu',	// ID
			array(					// Args
				'name'			=> 'admin_bar_button[show_wordpress_menu]',
				'checked'		=> $checked,
				'description'	=> __('Whether or not to include the WordPress menu on the Admin Bar when it is shown.', $this->plugin_text_domain),
				'tips'			=> array(
					array(
						__('Tip', $this->plugin_text_domain),
						__('You\'ll lose access to all of the links if the WordPress menu is not shown.', $this->plugin_text_domain)
					)
				)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'admin_bar_color' option
	 */
	public function _option_admin_bar_colour(){
	
		$value = $this->get_value('admin_bar_colour');	// Get the value currently saved for this option
		
		$this->do_option(
			'text',				// Option type
			'admin_bar_colour',	// ID
			array(				// Args
				'name'			=> 'admin_bar_button[admin_bar_colour]',
				'value'			=> $value,
				'class'			=> 'abb-colour-picker',
				'description'	=> __('The background colour of the Admin Bar Button and the WordPress Admin Bar', $this->plugin_text_domain)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'admin_bar_colour_hover' option
	 */
	public function _option_admin_bar_colour_hover(){
	
		$value = $this->get_value('admin_bar_colour_hover');	// Get the value currently saved for this option
		
		$this->do_option(
			'text',						// Option type
			'admin_bar_colour_hover',	// ID
			array(						// Args
				'name'			=> 'admin_bar_button[admin_bar_colour_hover]',
				'value'			=> $value,
				'class'			=> 'abb-colour-picker',
				'description'	=> __('The background hover hover colour of the Admin Bar Button and the WordPress Admin bar.', $this->plugin_text_domain),
				'tips'			=> array(
					array(
						__('Tip', $this->plugin_text_domain),
						__('Also changes the WordPress Admin Bar sub-menus background colour.', $this->plugin_text_domain)
					)
				)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'text_colour' option
	 */
	public function _option_text_colour(){
	
		$value = $this->get_value('text_colour');	// Get the value currently saved for this option
		
		$this->do_option(
			'text',			// Option type
			'text_colour',	// ID
			array(			// Args
				'name'			=> 'admin_bar_button[text_colour]',
				'value'			=> $value,
				'class'			=> 'abb-colour-picker',
				'description'	=> __('The colour of the text for the Admin Bar Button and the WordPress Admin Bar.', $this->plugin_text_domain)
			)
		);
		
	}
	
	/**
	 * Callback for outputting the 'text_colour_hover' option
	 */
	public function _option_text_colour_hover(){
	
		$value = $this->get_value('text_colour_hover');	// Get the value currently saved for this option
		
		$this->do_option(
			'text',					// Option type
			'text_colour_hover',	// ID
			array(					// Args
				'name'			=> 'admin_bar_button[text_colour_hover]',
				'value'			=> $value,
				'class'			=> 'abb-colour-picker',
				'description'	=> __('The hover colour of the text for the Admin Bar Button and the WordPress Admin Bar.', $this->plugin_text_domain)
			)
		);
		
	}
	
	/**
	 * Get the value of an option, checking first for a saved setting and then taking the default
	 *
	 * @param required string $option	The option to get a value for
	 * @return mixed					The value for the selected option
	 */
	public function get_value($option){
	
		return isset($this->options[$option]) ? $this->options[$option] : $this->dafaults[$option];
		
	}
	
}
?>