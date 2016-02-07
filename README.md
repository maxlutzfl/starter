# Starter Kit Documentation

## Table of Contents
- [Lazy Load Images](#lazy-load-images)
- [Parallax Cover Image](#parallax-cover-image)
- [Structure](#structure) -- Document, page, sections, spacing
- [Scroll Animation](#animating-on-scroll)
- [Fixed Elements](#fixed-elements-on-scroll)
- [Maps](#maps)
- [Template Heirarchy](#template-heirarchy)
- [Form Plugin](#forms)

### Lazy Load Images
All images below-the-fold should be loaded as they appear into the viewport. Must use a placeholder image in the `src` and the `class="image-defer"`.

```
<img src="placeholder.jpg" data-src="actual/image/path.jpg" class="image-defer>
```

### Parallax Cover Image
Use the `<figure>` element positioned absolutely within the section. The section must have `overflow: hidden; position: relative;` to contain the `<figure>`. Set the `<img>` to emulate `background-size: cover;` with CSS. Use the Skrollr.js data attributes to create the parallax effect. 

```
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

```
<body>
    <div id="site-wrapper">
        <header></header>
        <main></main>
        <footer></footer>
    </div>
    <div id="outsite-wrapper"></div>
</body>
```

#### Page Structure

```
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
A section can a `<header>`, `<section>`, or `<footer>` within the `<main>` area. 

```
<section>
    <div class="main-container">
        <div class="column-full">
        </div>
    </div>
</section>
<section>
    <div class="main-container">
        <div class="column-primary"></div>
        <aside class="column-aside"></aside>
    </div>
</section>
```

#### Spacing

The most basic document structure would be a `<header>`, `<section>`, and `<footer>` wrapped between the `<main>` tag. Within each of these sections is our `.main-container`, which centers the content `margin: 0 auto` and has the `max-width`. Next we need to think about the padding of these sections so there is some breathing room between sections vertically and the document edges horizontally. 

At it's most basic form, think of a printed document where the only padding is on the very top and bottom, left and right. To achieve this, we would add 3 helper classes to each section: `.page-header-padding`, `.page-section-padding` and `.page-footer-padding`.

```
.page-header-padding {
    padding-top: 30px;
    padding-bottom: 0px; 
    padding-left: 30px;
    padding-right: 30px;

}

.page-section-padding {
    padding-top: 0px;
    padding-bottom: 0px; 
    padding-left: 30px;
    padding-right: 30px;
}

.page-footer-padding {
    padding-top: 0;
    padding-bottom: 30px; 
    padding-left: 30px;
    padding-right: 30px;
}
```

If a section needs to be sectioned off separately, use a uniform padding like `padding: 30px;`. This would be the case for a section that has a border separating it from it's child section or if the section has a background image.  

### Animating on Scroll
To trigger animations as elements scroll into view of the viewport, use the class `.element-inview`. On scroll, `.animate` will be added to the element. In additional to `.element-inview` you can use a basic animation class like `.inview-up`, which begins with `opacity: 0; transform: translateY(100px);` and when the `.animate` class is triggered, `transition` animates the element to `opacity: 1; transform: translateY(0px);`. 

### Fixed Elements on Scroll
An element with the `.sticky-element` class will recieve `.stuck` when the top of the element reached the top of the viewport. 

### Maps

```
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

### Background Slider

```
<section class="Section__with_bgslider">
    <div class="PageContainer">
        <h1>Content Title</h1>
    </div>
    <div class="Module__bgslider">
            <div class="Module__bgslide" style="background-image: url(); "></div>
            <div class="Module__bgslide" style="background-image: url(); "></div>
            <div class="Module__bgslide" style="background-image: url(); "></div>
    </div>
</section>
```

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
            'text' => 'Your Name',
            'address' => 'Your Address',
            'phone' => 'Your Phone Number',
            'email' => 'Your Email',
            'textarea' => 'How can we help?',   
        )
    )
);
```