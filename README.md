# Starter Kit Documentation

### Useful Links

- <a href="http://youmightnotneedjqueryplugins.com/" target="_blank">youmightnotneedjqueryplugins.com</a>
- <a href="http://youmightnotneedjquery.com/" target="_blank">youmightnotneedjquery.com</a>
- <a href="http://bitsofco.de/styling-broken-images/" target="_blank">Styling Broken Images</a>
- <a href="https://jonsuh.com/hamburgers/" target="_blank">Hamburgers</a>
- <a href="http://themefoundation.com/wordpress-meta-boxes-guide/" target="_blank">WordPress Meta Boxes: a Comprehensive Developer’s Guide</a>

## Table of Contents
- [Lazy Load Images](#lazy-load-images)
- [Parallax Cover Image](#parallax-cover-image)
- [Structure](#structure) -- Document, page, sections, spacing
- [Scroll Animation](#animating-on-scroll)
- [Fixed Elements](#fixed-elements-on-scroll)
- [Maps](#maps)
- [Template Heirarchy](#template-heirarchy)
- [Form Plugin](#forms)
- [Slider](#slider)

### Lazy Load Images
All images below-the-fold should be loaded as they appear into the viewport. Must use a placeholder image in the `src` and the `class="image-defer"`.

```php
<img src="placeholder.jpg" data-src="actual/image/path.jpg" class="image-defer>
```

### Parallax Cover Image
Use the `<figure>` element positioned absolutely within the section. The section must have `overflow: hidden; position: relative;` to contain the `<figure>`. Set the `<img>` to emulate `background-size: cover;` with CSS. Use the Skrollr.js data attributes to create the parallax effect. 

```php
<section>
    <div class="main-container">
        <!-- Content Here -->
    </div>
    <figure class="cover-image" data-bottom-top="transform: translateY(-350px);" data-top-bottom="transform: translateY(0px);">
        <img src="parallax-image.jpg">
    </figure>
</section>
```

### Structure

#### Document Structure

```php
<body>
    <div id="SiteMainWrapper">
        <div id="SiteMasthead">
            <header id="SiteHeader"></header>
            <nav id="SiteNavigation"></nav>
        </div>
        <main id="SiteMain"></main>
        <footer id="SiteFooter"></footer>
    </div>
    <div id="MobileNavigation"></div>
</body>
```

#### Page Structure

```php
<main>
    <article>
        <header></header>
        <section></section>
        <section>...</section>
        <section>...</section>
        <footer></footer>
    </article>
</main>
```

#### Section Structure

```php
<section>
    <div class="MainContainer">
        ...
    </div>
</section>
<section>
    <div class="MainContainer">
        ...
    </div>
</section>
```

#### Grids

- <a href="codepen.io/maxlutzfl/full/jWOjBj/" target="_blank">Codepen Example</a>

```css
ul {
    font-size: 0; /* removes white space */
}

li {
    font-size: 16px; /* resets font-size */
    display: inline-block;
    vertical-align: top;
}
```

```php
<ul>
    <li>
        <div>
            ...
        </div>
    </li>
    <li>
        <div>
            ...
        </div>
    </li>
</ul>
```

### Animating on Scroll
To trigger animations as elements scroll into view of the viewport, use the class `.element-inview`. On scroll, `.animate` will be added to the element. In additional to `.element-inview` you can use a basic animation class like `.inview-up`, which begins with `opacity: 0; transform: translateY(100px);` and when the `.animate` class is triggered, `transition` animates the element to `opacity: 1; transform: translateY(0px);`. 

### Fixed Elements on Scroll
An element with the `.sticky-element` class will recieve `.stuck` when the top of the element reached the top of the viewport. 

### Maps

```php
<div id="map"></div>
<script>
    function initMap() {
        var address = "<?php echo get_option('company_address'); ?>";
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': address}, function(results, status) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            var myLatLng = {lat: latitude, lng: longitude};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                scrollwheel: false,
                draggable: false,
                center: myLatLng
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: "<?php bloginfo('title'); ?>"
            });
            google.maps.event.addDomListener(window, 'resize', function() {
                map.setCenter(myLatLng);
            });
        }); 
    }
</script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?callback=initMap"></script>
```

### Template Heirarchy 

**Archives**
- index.php (Blog Post Archive)
- archive.php (by Post Type, Taxonomy, Date, or Author)
- search.php (Search Results)

**Single Pages**
- page.php (Default Page Template)
- single.php (Single Blog Post, Post Type Single Page, Attachment)
- front-page.php (Homepage)
- 404.php 


### Forms 

**Available 'fields'**
- text
- address (Same as `<input type="text">` but allows for Google Maps API Autocomplete)
- phone
- email
- textarea
```php
new BrandCo_Form( 
    array(
        'title' => 'Contact Form 01', // Does not display on front end
        'submit' => 'Submit', // Text to display in submit button
        'fields' => array(
            1 => array(
                'title' => 'Your Name',
                'type' => 'text'
            ),
            2 => array(
                'title' => 'Your Last Name',
                'type' => 'text'
            ),
            3 => array(
                'title' => 'Your Address',
                'type' => 'address'
            ),
            4 => array(
                'title' => 'Your Email',
                'type' => 'email'               
            ),
            5 => array(
                'title' => 'Your Phone',
                'type' => 'phone'
            ),
            6 => array(
                'title' => 'Message',
                'type' => 'textarea'
            ),
        )
    )
);
```

