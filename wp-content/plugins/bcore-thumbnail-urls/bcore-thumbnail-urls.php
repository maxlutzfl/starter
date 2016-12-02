<?php
/**
 * Plugin Name: Thumbnail URLs
 * Plugin URI: https://brandco.com/
 * Description: Helps find the URLs to all available sizes of an image. Go to the media library and click to view and image, you will see the URL's on the right.
 * Version: 1.0.0
 * Author: BrandCo
 * Author URI: https://brandco.com/
 */

define('BCORE_THUMBNAIL_URLS_PLUGIN_JS', plugins_url('bcore-get-thumbnail-urls.js', __FILE__));

new BcoreThumbnailUrlsPlugin();

class BcoreThumbnailUrlsPlugin {

	function __construct() {
		add_action('admin_enqueue_scripts', array($this, 'script'));
		add_action('wp_ajax_get_urls', array($this, 'get_urls'));
		add_action('wp_ajax_nopriv_get_urls', array($this, 'get_urls'));
	}

	public function get_urls() {
		$image_id = $_GET['image_id'];
		$available_sizes = get_intermediate_image_sizes();

		foreach ( $available_sizes as $size ) :
			$url = wp_get_attachment_image_src($image_id, $size);
			?>
			<label class="setting">
				<span class="name"><strong><?php echo $size; ?></strong> <br><?php echo $url[1]; ?>x<?php echo $url[2]; ?></span>
				<input type="text" value="<?php echo $url[0]; ?>" readonly>
			</label>
			<?php
		endforeach;

		die();
	}

	public function script() {
		if ( strpos($_SERVER['REQUEST_URI'], 'upload.php') !== false ) {
			$data = array(
				'ajax' => admin_url('admin-ajax.php')
			);
			wp_register_script('bcore_thumbnail_urls_plugin_js', BCORE_THUMBNAIL_URLS_PLUGIN_JS);
			wp_localize_script( 'bcore_thumbnail_urls_plugin_js', 'bcore_thumbnails', $data);
			wp_enqueue_script('bcore_thumbnail_urls_plugin_js');
		}
	}
}