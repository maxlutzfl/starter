# Starter Kit Documentation

## Sections
- [Lazy Load Images](#lazy-load-images)
- [Parallax Cover Image](#parallax-cover-image)

#### Lazy Load Images
All images below the fold should be loaded as they appear into the viewport. Must use a placeholder image in the `src` and the `class="image-defer"`.

```
<img src="placeholder.jpg" data-src="actual/image/path.jpg" class="image-defer>
```

#### Parallax Cover Image
Use the `<figure>` element positioned absolutely within the section. The section must have `overflow: hidden; position: relative;` to contain the `<figure>`. Set the `<img>` to emulate `background-size: cover;` with CSS. Use the Skrollr.js data attributes to create the parallax effect. 

```
<section>
    <div class="main-container">
        <!-- Content Here -->
    </div>
    <figure data-bottom-top="transform: translateY(-350px);" data-top-bottom="transform: translateY(0px);">
        <img src="parallax-image.jpg">
    </figure>
</section>
```

