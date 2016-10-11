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

```

## Styles/layouts documentation

### _medium-query.scss
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
[data-section-padding*=""]
```

## Javascript
```js
/* Coming soon */
```

