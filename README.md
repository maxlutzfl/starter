# Starter
## Gulp
### gulpfile.js
- <strong>BrowserSync - </strong> Before you begin a new project, open the gulpfile.js and set the devUrl for BrowserSync.
<pre>var devUrl = 'local-server-name.dev';</pre>

- <strong>Run gulp</strong>
<pre>gulp</pre>
That's it.

## Styles

## Scripts

### <strong>File Structure</strong>

- <strong>/resources/scripts/plugins/</strong> - Gulp.js task will combine any .js file in this directory
- <strong>/resources/scripts/scripts/</strong> - There is a main theme-scripts.js file for adding general javascript for the project  

#### Plugins
- <strong>doubleTapToGo.js -</strong> Solves the issue of mobile users tapping on parent menu items that acts as a dropdown, but the parent item that is tapped also links to a page.
More info <a href="http://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly" target="_blank">http://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly/</a>
<pre>$('.menu-item-has-children').doubleTapToGo();</pre>

