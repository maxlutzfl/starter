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
function get_main_page_title() {  }

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
 * Misc
 */
function get_brandco_link() {  }
function textarea_filter($content) {  }

/**
 * Taxonomy term list
 * Use category, post_tag, or other custom taxonomies
 * $separator = ', ' would result in a list of terms with a comma in between
 */
function get_taxonomy_list($taxonomy = 'category', $separator = null) {  }

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
```scss
```

### _columns.scss
```scss
```


## Javascript
```js
/* Coming soon */
```

## .htaccess

```
# BEGIN Caching #
<IfModule mod_expires.c>
ExpiresActive On
ExpiresByType image/jpg "access 1 month"
ExpiresByType image/jpeg "access 1 month"
ExpiresByType image/gif "access 1 month"
ExpiresByType image/png "access 1 month"
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
```