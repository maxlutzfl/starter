<img src="https://github.com/maxlutzfl/starter/blob/master/modules/FeaturedAgent/featured-agent.jpg">

# Featured Agent Module

```php 
<div id="featured-agent">
    <section class="overflow-hide" data-section-padding="small(40) medium(80)">
        <div class="section-container">
            <ul class="plain-list" data-column-padding>
                <li data-column-span="small(0) medium(4) large(4)">
                    <!-- Empty column -->
                </li>
                <li data-column-span="small(12) medium(8) large(8)">
                    <div data-element-spacing="small(10) medium(30) large(30)">
                        <!-- Content on the right -->
                    </div>
                </li>
            </ul>
        </div>
        <div class="floating-image">
            <img src="agent-image.jpg" alt="Image">
        </div>
        <div class="parallax-fill" 
            style="background-image: url(parallax-background.jpg);"
            data-bottom-top="transform: translate3d(0, -100px, 0);"
            data-top-bottom="transform: translate3d(0, 100px, 0);"></div>
    </section>
</div>
```

```scss
.floating-image {
    position: relative;
    z-index: 5;

    @include above-medium {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        max-width: $container;
        margin: 0 auto;
    }

    img {
        height: 300px;
        display: block;
        margin: 0 auto;

        @include above-medium {
            margin: 0;
            height: 100%;
        }
    }
}
```