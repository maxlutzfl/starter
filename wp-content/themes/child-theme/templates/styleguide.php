<?php 
/** 
 * Template Name: Styleguide
 */
get_header(); ?>

<section data-section-padding="small(40) medium(80)">
	<div class="section-container" data-element-spacing="small(10) medium(30)">
		<h1>Duo Reges: constructio interrete. Satisne vobis</h1>
		<h2>Res enim fortasse verae, certe graves, non ita tractantur, ut debent, sed aliquanto minutius levesed aliquanto minutius leve asperum.</h2>
		<h3>h3 Title Style</h3>
		<h4>h4 Title Style</h4>
		<h5>h5 Title Style</h5>
		<h6>h6 Title Style</h6>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos libero odit mollitia amet nemo quia repellat! Rem, tenetur, enim. Provident autem atque, beatae saepe culpa nam dolorem enim, quibusdam optio?</p>
		<p>Lorem ipsum dolor <a href="#0">sit amet, consectetur adipisicing elit</a>. Illo eaque aliquam ipsa eligendi facere sunt ut beatae distinctio animi maiores magnam quod nobis eos quo, dolore sit dolorem alias quaerat.</p>
		<ul>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.
				<ul>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
				</ul>
			</li>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
		</ul>
		<h1>h1 Title Style</h1>
		<ol>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.
				<ol>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
					<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
				</ol>
			</li>
			<li><strong>Button list title - </strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, totam voluptas in tenetur, earum tempora amet praesentium eaque nostrum veniam rem. Iste modi asperiores blanditiis et ipsum eligendi aspernatur nisi.</li>
		</ol>
		<blockquote>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime voluptatem, velit ex praesentium. Doloremque non, voluptas id, voluptatem eum et nulla odio quas laudantium. Porro, rem repudiandae eligendi doloremque quo.</p>
		</blockquote>
		<p><a href="#0" class="button-style"><span>Default button style</span></a></p>
		<p><a href="#0" class="button-style button-style-hollow-dark"><span>Default button style</span></a></p>
		<?php gravity_form(1, false, false, false, '', true, 12); ?>
	</div>
</section>

<section class="overflow-hide dark-section" data-section-padding="small(40) medium(80) large(200)">
	<div class="section-container">
		<h1>Section with parallax background</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi tenetur, non inventore aliquam dolorem fugiat eos aspernatur sint illum repellat, temporibus necessitatibus in hic reprehenderit culpa itaque sit illo totam.</p>
	</div>
	<div class="parallax-fill background-cover background-layer-darken" 
		style="background-image: url('https://unsplash.it/1800/900?image=0&blur');" 
		data-bottom-top="transform: translate3d(0, -100px, 0);"
		data-top-bottom="transform: translate3d(0, 100px, 0);"></div>
</section>

<section class="text-center dark-section dark-background" data-section-padding="small(40) medium(80)">
	<div class="section-container" data-element-spacing="small(20)">
		<h1>Dark section</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#0">Quas voluptatibus</a> expedita nihil reiciendis deleniti iusto molestias dolor sequi temporibus ex, et at, dolorum voluptas quisquam aliquam id repellendus sapiente error?</p>
		<p><a href="#0" class="button-style button-style-hollow"><span>Click here</span></a></p>
		<p><a href="#0" class="button-style button-style-secondary"><span>Click here</span></a></p>
	</div>
</section>

<section data-section-padding="small(40) medium(80)">
	<div class="section-container">
		<div data-column-padding="small(20) medium(40) large(80)">
			<div data-column-span="small(12) medium(8) large(9)">
				Big Column
			</div>
			<div data-column-span="small(12) medium(4) large(3)">
				Small Column
			</div>
		</div>
	</div>
</section>

<section data-section-padding="small(40) medium(80)">
	<div class="section-container">
		<ul data-grid="small(1) medium(2) large(4)" data-grid-padding="small(20) medium(40) large(40)">
			<li>Grid Cell 1</li>
			<li>Grid Cell 2</li>
			<li>Grid Cell 3</li>
			<li>Grid Cell 4</li>
			<li>Grid Cell 5</li>
			<li>Grid Cell 6</li>
			<li>Grid Cell 7</li>
			<li>Grid Cell 8</li>
		</ul>
	</div>
</section>

<?php
	# Slider
	$slider_args = '{
		"autoplay": true,
		"slidesToShow": 1, 
		"slidesToScroll": 1,
		"fade": true
	}';
?>

<section data-section-padding="small(40) medium(80)">
	<div class="section-container">
		<div>
			<ul data-slider="01" data-slider-options='<?php echo $slider_args; ?>'>
				<li>Slide 1</li>
				<li>Slide 2</li>
				<li>Slide 3</li>
				<li>Slide 4</li>
			</ul>
		</div>
	</div>
</section>

<?php
	# Slider
	$slider_args = '{
		"autoplay": true,
		"slidesToShow": 4, 
		"slidesToScroll": 1,
		"fade": false,
		"dots": true,
		"arrows": true
	}';
?>

<section>
	<div class="section-container">
		<div>
			<ul data-slider="02" data-slider-options='<?php echo $slider_args; ?>'>
				<li>Slide 1</li>
				<li>Slide 2</li>
				<li>Slide 3</li>
				<li>Slide 4</li>
				<li>Slide 5</li>
				<li>Slide 6</li>
				<li>Slide 7</li>
				<li>Slide 8</li>
			</ul>
		</div>
	</div>
</section>

<script>
	setTimeout(function() {
		jQuery(function($) {
			$('[data-slider]').each(function() {
				var id = $(this).attr('data-slider');
				var args = $(this).data('slider-options');
				$(this).slick(args);
			});
		});
	}, 1000);
</script>

<?php get_footer(); ?>