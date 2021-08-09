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
							<div class="hero-transparent-panel"></div>
						</div>
					<?php endforeach; ?>	
				</div>
			</div>
			<div class="grid-container desc-container">
				<div class="grid-x grid-margin-x">
					<div class="cell medium-5 large-offset-1 color-white">
						<?php print the_content(); ?>
						<a href="#share-your-story" class="button transparent">
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
							<div class="small-hero-transparent-panel"></div>
						</div>
					<?php endforeach; ?>	
				</div>
			</div>
			<div class="small-desc-container bg-color-cyan">
				<div class="grid-x">
					<div class="cell medium-5 color-white small-content-container">
						<?php print the_content(); ?>
						<a href="#menu-open" class="button transparent">
							SHARE YOUR STORY
						</a>
					</div>
				</div>
			</div>
			<div class="hero-transparent-panel"></div>
		</div>
	</section>
</main>

<?php get_footer(); ?>
