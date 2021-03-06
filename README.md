# bcore

## Getting started
- This is a <strong>parent theme</strong> framework, so download/activate the child theme. Ideally, <strong>no files should change in this theme</strong>. Override any functions or files with the child theme. All template files, styles, and javascript should be done from the child theme.
- <code>cd</code> to the child theme directory & run <code>npm install</code>
- In the child theme directory, find the <code>gulpfile.js</code> file, change the <code>devUrl</code> variable to your local dev URL
- Run <code>gulp</code> from the child theme directory

## Version control and deployment

- If using BigMomma, make a new directory like <code>ClientName.git</code>, <code>cd</code> to that directory and run <code>git --bare init</code>
- In Tower, <code>Clone Remote Repository</code>

## PHP functions

```php 
/**
 * Main page title, does NOT work inside loop, use the_title() instead
 */
function get_page_title() {  }

/** 
 * For subpages/sub-subpages, this function will find the post ID of the parent page
 */
function get_parent_id() {  }

/**
 * Excerpt
 * $args = array('word_count' => 10, 'post_id' => get_the_ID(), 'read_more_text' => '...', 'link' => true);
 */
function get_post_excerpt($args = array()) {  }

/**
 * Images
 */
function get_icon($icon = 'link.svg') {  }
function get_image_by_id($image_id, $size = 'thumbnail') {  }
function get_image_from_directory($filename) {  } // $filename = 'image.jpg';
function get_featured_image($size = 'medium', $post_id = null) {  }

/**
 * Navigation
 * $args = array('location' => 'primary', 'depth' => -1);
 */
function get_navigation($args = array()) {  }

/**
 * Social Media
 * returns as an array of data
 */
function get_social_media_links() {  }

/** 
 * Misc
 */
function get_brandco_link() {  }
function textarea_filter($content) {  }

/**
 * Taxonomy term list
 * Use category, post_tag, or other custom taxonomies
 * $separator = ', ' would result in a list of terms with a comma in between
 */
function get_taxonomy_list($taxonomy = 'category', $separator = ', ') {  }

/**
 * Archive pages
 */
function get_archive_pagination() {   }

```

## Styles/layouts documentation

### _media-query.scss
```scss
// Mobile first
.thing { 

	margin: 0px; 
	@include above-medium { margin: 10px; }
	@include above-large { margin: 20px; }

	@include on-small-only { color: red; }
	@include on-medium-only { color: white; }
	@include on-large-only { color: blue; }

	@include breakpoint('above', 600px) {}
	@include breakpoint('below', 600px) {}
	@include breakpoint('between', 600px, 800px) {}

	@media (orientation:portrait) {  } // Like a phone
	@media (orientation:landscape) {  } // Like a desktop
}

```

### _section-padding.scss
```php
<section data-section-padding="small(20) medium(40) large(80)">
    <div class="section-container">
        <!-- Content here -->
    </div>
</section>
```

```scss
// On small, padding: 20px 20px;
[data-section-padding="small(20)"] 

// On medium, padding: 40px 20px;
[data-section-padding="medium(40)"] 

// On large, padding: 80px 20px;
[data-section-padding="large(80)"] 
```

### _grid.scss

For multiple rows of cells

```php
<section>
	<ul data-grid="small(2) medium(4) large(6)" data-grid-padding="small(20) medium(40) large(40)">
		<li>...</li>
		<li>...</li>
		<li>...</li>
		...
	</ul>
</section>
```

### _columns.scss

For single row with columns

```php
<section>
	<div class="section-container">
		<ul data-column-padding="small(20) medium(40) large(80)">
			<li data-column-span="small(6) medium(4) large(3)">...</li>
			<li data-column-span="small(6) medium(8) large(9)">...</li>
		</ul>
	</div>
</section>
```

### CSS helper classes/variables
```scss
/** Colors */
$primary: $red; // Primary theme color
$secondary: $blue; // Secondary theme color

/** Backgrounds */
.background-primary {}
.background-white {}
.background-lightgrey {}
.background-black {}

/**  */
.dark-section {} // makes all text in a section white 
```

## Javascript

### Sliders
https://github.com/kenwheeler/slick/

```php
<ul data-slider="hero">
	<li><div>Slide 1</div></li>
	<li><div>Slide 1</div></li>
	<li><div>Slide 1</div></li>
</ul>
```

```javascript
$('[data-slider="hero"]').slick({
	infinite: true,
	slidesToShow: 1,
	slidesToScroll: 1,
	speed: 300,
	swipe: true,
	pauseOnFocus: false,
	pauseOnHover: false,
	pauseOnDotsHover: false,
	autoplay: false,
	autoplaySpeed: 3000,
	centerMode: false,
	centerPadding: '50px',
	dots: true,
	arrows: true,
	draggable: true,
	fade: false,
	// appendArrows: $('#arrows'),
	// appendDots: $('#dots'),
	mobileFirst: true,
	prevArrow: '<div class="slick-prev">Previous</div>',
	nextArrow: '<div class="slick-next">Next</div>',
	responsive: [{
		breakpoint: 750,
		settings: {
			fade: true,
		}
	}]
});
```


### Animating elements as they appear in viewport
https://github.com/camwiegert/in-view

```php
<section>
	<h1 class="element-inview inview-up">Title Will Animate Up</h1>
</section>
```

### Parallax
https://github.com/Prinzhorn/skrollr

```php
<section>
	<div class="section-container">
		<h1>Title</h1>
		<p>Content...</p>
	</div>
	<div class="parallax-fill"
		style="background-image: url('background.jpg');"
		data-bottom-top="transform: translate3d(0, -100px, 0);"
		data-top-bottom="transform: translate3d(0, 100px, 0);">
	</div>
</section>
```

## `add_filter()` and `apply_filters()`

- <a href="https://developer.wordpress.org/reference/functions/add_filter/" target="_blank">add_filter()</a>
- <a href="https://developer.wordpress.org/reference/functions/apply_filters/" target="_blank">apply_filters()</a>

In the template:
```php
<!-- Bad -->
<h1>Title That Cannot Be Changed</h1>

<!-- Good -->
<h1><?php echo apply_filters('page_title_filter', 'Title That Can Be Changed!', 10, 1); ?></h1>
```

In `functions.php`:
```php  
/** In the functions file you can now change this as needed */
add_filter('page_title_filter', 'replace_page_title');
function replace_page_title($old_title) {
    $new_title = 'New Title!';
    return $new_title;
}

/** Alternative */
add_action('init', 'replace_page_title');
function replace_page_title() {

    // Get new title
    $new_title = 'New Title!';

    // Add new filter
    add_filter(
        'page_title_filter',
        function($old_title) use ($new_title) {

            // If there is a new title, replace the old
            // otherwise return back the old title
            $title_to_show = ($new_title) ? $new_title : $old_title;
            return $title_to_show;
        }
    );
}
```

For an array:
```php
<div>
	<ul>
		<?php foreach (apply_filters('section_loop_filter') as $single) : ?>
			<li>
				<h2><?php echo $single['title']; ?></h2>
			</li>
		<?php endforeach; ?>
	</ul>
</div>
```

```php 
apply_filters('section_loop_filter', 'array_to_loop');
function array_to_loop() {
	$array_to_loop = array(
		array('title' => 'Title 1'),
		array('title' => 'Title 2'),
		array('title' => 'Title 3')
	);

	return $array_to_loop;
}
```

Looping through multiple filters
```php
add_action('init', 'do_lots_of_filters');
function do_lots_of_filters() {
	// Create an array of the filters and new data to include
	$filters = array(
		array(
			'filter' => 'title_filter',
			'new_data' => get_post_meta(get_the_ID(), 'page_title', true)
		),
		array(
			'filter' => 'subtitle_filter',
			'new_data' => get_post_meta(get_the_ID(), 'page_subtitle', true)
		)
	);

	// Loop
	foreach ( $filters as $filter ) {
		// 
		$filter_name = $filter['filter'];
		$new_data = $filter['new_data'];
		
		// If new data exists
		if ( $new_data ) {
			
			// Pass $new_data to the anonymous function with `use`
			add_filter($filter_name, function($old_data) use ($new_data) { 

				// If there is new data, replace the old
				// otherwise return the old data
				$data_to_show = ($new_data) ? $new_data : $old_data;
				return $data_to_show;
			});
		}
	}
}
```

## Helpful stuff

### WP options table
- `siteurl`
- `blogname`
- `blogdescription`
- `admin_email`
- `template`
- `stylesheet`

### SVG scaling
Use `preserveAspectRatio` to determine how the `svg` scales. Helpful for IE.
```html
<svg preserveAspectRatio="xMaxYMin slice"></svg>
```

### Gravity Forms

```js
/** 
 * Gravity forms
 * Fires when the form loads ands reloads after failed submit when using AJAX
 */
$(document).bind('gform_post_render', function() {
	// Do stuff after form loads or reloads
});
```

### SEO Tools
- https://search.google.com/structured-data/testing-tool/
- http://jsonld.com/
- https://schema.org/
- http://schemadata.com/schema.org/

### Post-launch wp-config 
```php
/** Turn off debug mode but enable error log */
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', true);

/** Disable file editing */
define('DISALLOW_FILE_EDIT', true);
```

## Default WP image sizes
- `placeholder` - 30x30 scaled
- `featured` - 600x380 cropped
- `thumbnail` - 300x300 cropped
- `medium` - 600x600 scaled
- `large` - 1500x1500 scaled
- `full` 

### Gravity Forms Email Notifications Issues
Install `Easy WP SMTP` plugin

**Office 365**
```
Server smtp.office365.com
Port 587
SSL Yes
```

### Plugins
- ACF
- Gravity forms
- Search and replace
- WP Smush
- Akismet
- Easy WP SMTP
- Leadin
- EPS Redirects

### .htaccess

```python
# BEGIN Caching #
<IfModule mod_expires.c>
ExpiresActive On
ExpiresByType image/jpg "access 1 month"
ExpiresByType image/jpeg "access 1 month"
ExpiresByType image/gif "access 1 month"
ExpiresByType image/png "access 1 month"
ExpiresByType text/css "access 1 month"
ExpiresByType text/javascript "access 1 month"
ExpiresByType application/x-javascript "access 1 month"
ExpiresByType application/javascript "access 1 month"
</IfModule>
# END Caching #
 
# BEGIN Compression #
<IfModule mod_deflate.c>
AddOutputFilterByType DEFLATE application/javascript
AddOutputFilterByType DEFLATE application/rss+xml
AddOutputFilterByType DEFLATE application/vnd.ms-fontobject
AddOutputFilterByType DEFLATE application/x-font
AddOutputFilterByType DEFLATE application/x-font-opentype
AddOutputFilterByType DEFLATE application/x-font-otf
AddOutputFilterByType DEFLATE application/x-font-truetype
AddOutputFilterByType DEFLATE application/x-font-ttf
AddOutputFilterByType DEFLATE application/x-javascript
AddOutputFilterByType DEFLATE application/xhtml+xml
AddOutputFilterByType DEFLATE application/xml
AddOutputFilterByType DEFLATE font/opentype
AddOutputFilterByType DEFLATE font/otf
AddOutputFilterByType DEFLATE font/ttf
AddOutputFilterByType DEFLATE image/svg+xml
AddOutputFilterByType DEFLATE image/x-icon
AddOutputFilterByType DEFLATE text/css
AddOutputFilterByType DEFLATE text/html
AddOutputFilterByType DEFLATE text/javascript
AddOutputFilterByType DEFLATE text/plain
AddOutputFilterByType DEFLATE text/xml
</IfModule>
# END Compression #

# START Security
RewriteCond %{QUERY_STRING} author=d
RewriteRule ^ /? [L,R=301]
Options All -Indexes
Options +FollowSymLinks
RewriteEngine On
RewriteCond %{QUERY_STRING} (<|%3C).*script.*(>|%3E) [NC,OR]
RewriteCond %{QUERY_STRING} GLOBALS(=|[|%[0-9A-Z]{0,2}) [OR]
RewriteCond %{QUERY_STRING} _REQUEST(=|[|%[0-9A-Z]{0,2})
RewriteRule ^(.*)$ index.php [F,L]
RewriteCond %{REQUEST_URI} !^/wp-content/plugins/file/to/exclude\.php
RewriteCond %{REQUEST_URI} !^/wp-content/plugins/directory/to/exclude/
RewriteRule wp-content/plugins/(.*\.php)$ - [R=404,L]
RewriteCond %{REQUEST_URI} !^/wp-content/themes/file/to/exclude\.php
RewriteCond %{REQUEST_URI} !^/wp-content/themes/directory/to/exclude/
RewriteRule wp-content/themes/(.*\.php)$ - [R=404,L]

<FilesMatch "^.*(error_log|wp-config\.php|php.ini|\.[hH][tT][aApP].*)$">
Order deny,allow
Deny from all
</FilesMatch>

<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteRule ^wp-admin/includes/ - [F,L]
RewriteRule !^wp-includes/ - [S=3]
RewriteRule ^wp-includes/[^/]+\.php$ - [F,L]
RewriteRule ^wp-includes/js/tinymce/langs/.+\.php - [F,L]
RewriteRule ^wp-includes/theme-compat/ - [F,L]
</IfModule>
# END Security
```