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

## Theme

### HTML Layout
```php
<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body itemscope itemtype="http://schema.org/WebPage">
    <header role="banner" itemscope itemtype="http://schema.org/WPHeader"></header>
    <nav role="navigation" itemscope itemtype="http://schema.org/SiteNavigationElement"></nav>
    <main role="main" itemscope itemprop="mainContentOfPage"></main>
    <footer role="contentinfo" itemscope itemtype="http://schema.org/WPFooter"></footer>
</body>
</html>
```

## Sections Layout

```
.plain-padding { padding: 30px; }
.section-padding { padding: 60px 30px; }
```

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
<!-- Create a section -->
<section class="section">

    <!-- Add a container with some content -->
    <div class="container">
        <h1>Section Title</h1>
    </div>

    <!-- Add an absolute positioned empty div and have it fill in the section, with some additional height above and below -->
    <div class="background-cover absolute-fill-for-parallax"
        style="background-image: url(path/to/image);"
        data-top-bottom="transform: translate3d(0, 100px, 0);"
        data-bottom-top="transform: translate3d(0, -100px, 0);"></div>
</section>
```

```css
.absolute-fill-for-parallax {
    position: absolute;
    top: -50px;
    right: 0;
    bottom: -50px;
    left: 0;
    z-index: -5;
}
```

- <strong>Unveil.js</strong> - Lazy loading for images, background images

- <strong>Wow.js</strong> - For animating elements as they enter/exit the viewport

- <strong>Slick.js</strong> - <a href="http://kenwheeler.github.io/slick/" target="_blank">Demo/API</a> | <a href="https://github.com/kenwheeler/slick/" target="_blank">Github</a>

- <strong>Magnific Popup</strong> - <a href="http://dimsemenov.com/plugins/magnific-popup/" target="_blank">Demo</a> | <a href="https://github.com/dimsemenov/Magnific-Popup" target="_blank">Github</a> <br>
For popups

## Grid system

For multiple (unlimited) rows. Each <code>{responsive_size}</code> must be set on the <code>...-grid</code> and <code>...-gridpad</code> to avoid conflicts. 

#### Basic Setup:

```php
<ul class="grid small-2-grid medium-3-grid large-4-grid small-small-gridpad medium-small-gridpad large-small-gridpad">
    <li><div>Grid block 1</div></li>
    <li><div>Grid block 2</div></li>
    ...
    <li><div>Grid block 17</div></li>
    <li><div>Grid block 18</div></li>
</ul>
```

#### <code>.{responsive_size}-{column_count}-grid</code>
<code>small-2-grid</code> translates to "On small, make the grid 2 columns"

#### <code>.{responsive_size}-{size_title}-gridpad</code>
<code>.small-small-gridpad</code> translates to "On small use the small padding size to space out the grid"


## Row/Column System 

For a single row with columns. Based on 12 column system.

#### Basic Setup: 

```php
<div class="row">
    <div id="main" class="column small-12 medium-8">
        <!-- Start at 12 column span -->
        <!-- At medium, go to 8 column span -->
    </div>
    <div id="sidebar" class="column small-12 medium-4">
    <!-- Start at 12 column span -->
    <!-- At medium, go to 8 column span -->
    </div>
</div>
```

Since this system is mobile first, <code>.small-*</code> is the default size. If a column is <code>.small-6</code> then it's going span 6 columns (6/12 = 50% width) on all screen sizes. If it was <code> <div class="column small-12 medium-6 large-3"></div> </code>, then that <code>div</code> would start at 100% width, break to 50% width at the medium responsive breakpoint, and 25% width at the large responsive breakpoint. 

To add or edit the breakpoints and titles for the sizes, look in <code>_grid.scss</code>. <code>_spacing-padding.scss</code>, and <code>_mixins.scss</code>















