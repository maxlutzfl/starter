# bcore

## Getting started
- This is a <strong>parent theme</strong> framework, so download/activate the child theme. Ideally, <strong>no files should change in this theme</strong>. Override any functions or files with the child theme. All template files, styles, and javascript should be done from the child theme.
- <code>cd</code> to the child theme directory & run <code>npm install</code>
- In the child theme directory, find the <code>gulpfile.js</code> file, change the <code>devUrl</code> variable to your local dev URL
- Run <code>gulp</code> from the child theme directory

## Version control and deployment

## PHP functions

```php 
/** For subpages, sub-subpages, this function will find the post ID of the parent page */
function get_parent_id() {  }

/**
 * Excerpt
 */
$args = array(
    'word_count' => 10, 
    'post_id' => get_the_ID(), 
    'read_more_text' => '...', 
    'link' => true
);
function get_post_excerpt($args = array())

/**
 * Images
 */
function get_icon($icon = 'link.svg') {  }

/**
 * Navigation
 * $args = array('location' => 'primary', 'depth' => -1);
 */
$args = array(
    'location' => 'primary', // primary, mobile, footer
    'depth' => 0 // 0 = default, -1 = flat, 1 = first level only
);
function get_navigation($args = array())

```

## SCSS documentation
```scss
/* Coming soon */
```

## Javascript
```js
/* Coming soon */
```

