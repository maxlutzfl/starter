# Starter
## Gulp
### gulpfile.js
- <strong>BrowserSync - </strong> Before you begin a new project, open the gulpfile.js and set the devUrl for BrowserSync.
```javascript
var devUrl = 'local-server-name.dev';
```

- <strong>Run gulp</strong>
```
gulp
```
That's it.

## Styles

## Scripts

### <strong>File Structure</strong>

- <strong>/resources/scripts/plugins/</strong> - Use this directory for third-party plugins
- <strong>/resources/scripts/scripts/theme-scripts.js</strong> - Use this file for custom scripts and initializing plugins added in the plugins directory
- The Gulp.js scripts task listens for changes in the theme-scripts.js file. The task combines all plugins and the theme-scripts.js file. This saves to main.js, main.min.js, and main.min.js.map. 

### Plugins
- <strong>doubleTapToGo.js -</strong> <a href="http://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly" target="_blank">http://osvaldas.info/drop-down-navigation-responsive-and-touch-friendly/</a> Solves the issue of mobile users tapping on parent menu items that acts as a dropdown, but the parent item that is tapped also links to a page.
```javascript
$('.menu-item-has-children').doubleTapToGo();
```

- <strong>skrollr.js</strong> - <a href="https://github.com/Prinzhorn/skrollr" target="_blank">https://github.com/Prinzhorn/skrollr</a> For parallax scrolling animation

```javascript
// Initialize skrollr.js 
if ( !(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera) ) {
    var s = skrollr.init({
        forceHeight: false,
        smoothScrolling: true,
        smoothScrollingDuration: 200
    });
}
```

```php
<section class="section">
    <div class="container">
        <h1>Section Title</h1>
    </div>
    <div class="background-cover absolute-fill-for-parallax"
        style="background-image: url(path/to/image);"
        data-top-bottom="transform: translate3d(0, 100px, 0);"
        data-bottom-top="transform: translate3d(0, -100px, 0);"></div>
</section>
```

- <strong>Unveil.js</strong> - Lazy loading for images, background images

- <strong>Wow.js</strong> - For animating elements as they enter/exit the viewport

- <strong>Slick.js</strong> - <a href="http://kenwheeler.github.io/slick/" target="_blank">Demo/API</a> | <a href="https://github.com/kenwheeler/slick/" target="_blank">Github</a>

- <strong>Magnific Popup</strong> - <a href="http://dimsemenov.com/plugins/magnific-popup/" target="_blank">Demo</a> | <a href="https://github.com/dimsemenov/Magnific-Popup" target="_blank">Github</a> <br>
For popups