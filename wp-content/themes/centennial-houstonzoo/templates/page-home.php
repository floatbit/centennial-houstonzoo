<?php
  /*
  Template Name: Home
  */
?>

<?php get_header();?>

<?php
  $hero_item = get_field('main_content');
?>

<main>
	<section id="home">
		<div class="home-container show-for-medium">
			<div class="hero-container">
				<div class="carousel home-carousel-main">
					<?php foreach($hero_item as $item): ?>
						<?php
							$image_url = $item['image'];
							$tiny_title = $item['title'];
						?>
						<div class="carousel-cell">
							<div class="hero-item-container background-cover" style="background-image:url(<?php print $image_url; ?>)">
								<div class="title-container">
									<p class="bold color-light-blue"><?php print $tiny_title; ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>	
				</div>
			</div>
			<div class="hero-transparent-panel"></div>
			<div class="desc-container">
				<div class="grid-x">
					<div class="cell medium-4 color-white">
						<?php print the_content(); ?>
						<a href="#menu-open" class="button transparent">
							SHARE YOUR STORY
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="small-home-container show-for-small-only">
			<div class="small-hero-container">
				<div class="carousel carousel-main">
					<?php foreach($hero_item as $item): ?>
						<?php
							$image_url = $item['image'];
							$tiny_title = $item['title'];
						?>
						<div class="carousel-cell">
							<div class="hero-item-container background-cover" style="background-image:url(<?php print $image_url; ?>)">
								<div class="title-container">
									<p class="bold color-light-blue"><?php print $tiny_title; ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>	
				</div>
			</div>
			<div class="small-desc-container">
				<div class="grid-x">
					<div class="cell medium-4 color-white">
						<?php print the_content(); ?>
						<a href="#menu-open" class="button transparent">
							SHARE YOUR STORY
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
