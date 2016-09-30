# starter2017

## Getting started
- This is a parent theme framework, so download/activate the child theme. Ideally, no files should change in this theme. Override any functions or files with the child theme. All template files, styles, and javascript should be done from the child theme.
- Run <code>npm install</code>
- In the <code>gulpfile.js</code> file, change the <code>devUrl</code> variable to your local dev URL
- Run <code>gulp</code>

## PHP Functions

```php 
// For subpages, sub-subpages, this function
// will find the post ID of the parent page
function get_parent_id() {  }
```