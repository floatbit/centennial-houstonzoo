<?php
  /*
  Template Name: 100 Years
  */
?>

<?php get_header();?>

<?php
	$intro_image = get_field('intro');
	$mix_content_items = get_field('mix_content');
	$lf_items = get_field('looking_forward');
	$lf_array = array_chunk($lf_items['info_content'],4);
?>

<main>
	<section id="intro">
		<div class="intro-image background-cover" style="background-image:url(<?php print $intro_image; ?>)">
			<div class="transparent-intro-panel green"></div>
			<div class="grid-x">
				<div class="cell intro-desc">
					<h1 class="large color-white"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</section>

	<section id="mix-content">
		<?php foreach($mix_content_items as $item): ?>
			<?php if ($item['acf_fc_layout'] == 'right_image'): ?>
				<?php 
					set_query_var( 'part_params', array(
						'description' => $item['description'],
						'eyebrow' => $item['eyebrow'],
						'title' => $item['title'],
						'image' => $item['image'],
						'bg_color' => $item['background_color']
					));
					get_template_part( 'parts/content-right-image-template' );
				?>
			<?php elseif ($item['acf_fc_layout'] == 'left_image'): ?>
				<?php 
					set_query_var( 'part_params', array(
						'description' => $item['description'],
						'image' => $item['image'],
						'bg_color' => $item['background_color']
					));
					get_template_part( 'parts/content-left-image-template' );
				?>
			<?php elseif ($item['acf_fc_layout'] == 'background_image'): ?>
				<?php 
					set_query_var( 'part_params', array(
						'description' => $item['description'],
						'image' => $item['image'],
						'panel_color' => 'dark-green',
						'specified_id' => '100-years'
					));
					get_template_part( 'parts/content-bg-image-template' );
				?>
			<?php endif; ?>
		<?php endforeach; ?>
	</section>

	<section id="looking-forward">
		<div class="grid-container double">
			<div class="desc-container">
				<div class="title-container">
					<p class="color-dark-green"><?php print $lf_items['eyebrow']; ?></p>
				</div>
				<div class="grid-x grid-margin-x">
					<div class="cell medium-6">
						<h2><?php print $lf_items['title']; ?></h2>
					</div>
					<div class="cell medium-6">
						<p><?php print $lf_items['description']; ?></p>
					</div>
				</div>
			</div>
			<?php if ($lf_items['info_content'] != null) : ?>
				<div class="info-item-container show-for-medium">
					<div class="grid-x grid-margin-x">
						<div class="cell medium-6 left-item-content">
							<?php 
								set_query_var( 'part_params', array(
									'looping_item' => $lf_array[0],
									'specific_id' => 'left'
								));
								get_template_part( 'parts/looking-forward-loop' );
							?>
						</div>
						<div class="cell medium-6 right-item-content">
							<?php 
								set_query_var( 'part_params', array(
									'looping_item' => $lf_array[1],
									'specific_id' => 'right'
								));
								get_template_part( 'parts/looking-forward-loop' );
							?>
						</div>
					</div>
				</div>
				<div class="info-item-container show-for-small-only">
					<div class="grid-x grid-margin-x">
						<div class="cell">
							<?php 
								set_query_var( 'part_params', array(
									'looping_item' => $lf_items['info_content'],
									'specific_id' => 'small'
								));
								get_template_part( 'parts/looking-forward-loop' );
							?>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>


<?php get_footer(); ?>