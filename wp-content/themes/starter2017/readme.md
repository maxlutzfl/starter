# starter2017

## Getting started
- This is a <strong>parent theme</strong> framework, so download/activate the child theme. Ideally, <strong>no files should change in this theme</strong>. Override any functions or files with the child theme. All template files, styles, and javascript should be done from the child theme.
- <code>cd</code> to the child theme directory & run <code>npm install</code>
- In the child theme directory, find the <code>gulpfile.js</code> file, change the <code>devUrl</code> variable to your local dev URL
- Run <code>gulp</code> in the child theme directory

## PHP Functions

```php 
// For subpages, sub-subpages, this function
// will find the post ID of the parent page
function get_parent_id() {  }
```