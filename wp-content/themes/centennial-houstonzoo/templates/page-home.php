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
		<div class="transparent-panel"></div>
		<div class="desc-container">
			<div class="grid-x">
				<div class="cell medium-4">
					<?php print the_content(); ?>
					<a href="#menu-open" class="button transparent">
						SHARE YOUR STORY
					</a>
				</div>
			</div>
		</div>
		<div class="carousel carousel-main">
			<?php foreach($hero_item as $item): ?>
				<?php
					$image_url = $item['image'];
					$tiny_title = $item['title'];
				?>
				<div class="carousel-cell">
					<div class="item-container background-cover" style="background-image:url(<?php print $image_url; ?>)">
						<div class="title-container">
							<p class="bold color-light-blue"><?php print $tiny_title; ?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>	
		</div>
	</section>
</main>

<?php get_footer(); ?>
