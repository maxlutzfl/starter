# Starter Kit Documentation

## Sections
- [Lazy Load Images](#lazy-load-images)
- [Parallax Cover Image](#parallax-cover-image)
- [Structure](#structure)
- [Scroll Animation](#animating-on-scroll)
- [Fixed Elements](#fixed-elements-on-scroll)

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

### Animating on Scroll
To trigger animations as elements scroll into view of the viewport, use the class `.element-inview`. On scroll, `.animate` will be added to the element. In additional to `.element-inview` you can use a basic animation class like `.inview-up`, which begins with `opacity: 0; transform: translateY(100px);` and when the `.animate` class is triggered, `transition` animates the element to `opacity: 1; transform: translateY(0px);`.

### Fixed Elements on Scroll
An element with the `.sticky-element` class will recieve `.stuck` when the top of the element reached the top of the viewport. 

