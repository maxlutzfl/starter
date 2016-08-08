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

- <strong>/resources/scripts/plugins/</strong> - Use this directory for third-party plugins
- <strong>/resources/scripts/scripts/theme-scripts.js</strong> - Use this file for custom scripts and initializing plugins added in the plugins directory
- The Gulp.js scripts task listens for changes in the theme-scripts.js file. The task combines all plugins and the theme-scripts.js file. This saves to main.js, main.min.js, and main.min.js.map. 

### Plugins
- <strong>doubleTapToGo.js -</strong> <a href="http://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly" target="_blank">http://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly/</a> Solves the issue of mobile users tapping on parent menu items that acts as a dropdown, but the parent item that is tapped also links to a page.
<pre>$('.menu-item-has-children').doubleTapToGo();</pre>

- <strong>skrollr.js</strong> - <a href="https://github.com/Prinzhorn/skrollr" target="_blank">https://github.com/Prinzhorn/skrollr</a> For parallax scrolling animation
<br>
To initialize (excluding mobile)
<pre>
if ( !(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera) ) {
    var s = skrollr.init({
        forceHeight: false,
        skrollrBody: 'siteWrapper',
        smoothScrolling: true,
        smoothScrollingDuration: 200
    });
}
</pre>

- <strong>Unveil.js</strong> - Lazy loading for images, background images
- <strong>Wow.js</strong> - For animating elements as they enter/exit the viewport
- <strong>Slick.js</strong> - Carousels, sliders
- <strong>PhotoSwipe</strong> - <a href="http://dimsemenov.com/plugins/magnific-popup/" target="_blank">Demo</a> | <a href="https://github.com/dimsemenov/Magnific-Popup" target="_blank">Github</a>
<p>For popups</p>