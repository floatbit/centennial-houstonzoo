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
?>

<main>
	<section id="intro">
		<div class="intro-image background-cover" style="background-image:url(<?php print $intro_image; ?>)">
			<div class="transparent-intro-panel"></div>
			<div class="grid-x">
				<div class="cell intro-desc">
					<h1 class="large color-white"><?php print the_title(); ?></h1>
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
						'image' => $item['image'],
						'bg_color' => $item['bg_color']
					));
					get_template_part( 'parts/content-right-image-template' );
				?>
			<?php elseif ($item['acf_fc_layout'] == 'left_image'): ?>
				<?php 
					set_query_var( 'part_params', array(
						'description' => $item['description'],
						'image' => $item['image'],
						'bg_color' => $item['bg_color']
					));
					get_template_part( 'parts/content-left-image-template' );
				?>
			<?php elseif ($item['acf_fc_layout'] == 'background_image'): ?>
				<?php 
					set_query_var( 'part_params', array(
						'description' => $item['description'],
						'image' => $item['image'],
						'panel_color' => $item['panel_color']
					));
					get_template_part( 'parts/content-bg-image-template' );
				?>
			<?php endif; ?>
		<?php endforeach; ?>
	</section>

	<section id="looking-forward">
		<div class="grid-container">
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
			<div class="grid-x grid-margin-x">
				<div class="cell medium-6">
					<?php if ($lf_items['info_content']['left_content'] != null) : ?>
						<?php foreach ($lf_items['info_content']['left_content'] as $item): ?>
							<div class="grid-x grid-margin-x">
								<div class="cell small-1">
									<img class="info-logo" src="<?php print $item['image']; ?>">
								</div>
								<div class="cell small-11">
									<div class="info-title">
										<h4><?php print $item['title'] ?></h4>
										<?php print $item['description'] ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="cell medium-6">
					<?php if ($lf_items['info_content']['right_content'] != null) : ?>
						<?php foreach ($lf_items['info_content']['right_content'] as $item): ?>
							<div class="grid-x grid-margin-x">
								<div class="cell small-1">
									<img class="info-logo" src="<?php print $item['image']; ?>">
								</div>
								<div class="cell small-11">
									<div class="info-title">
										<h4><?php print $item['title'] ?></h4>
										<?php print $item['description'] ?>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>
</main>


<?php get_footer(); ?>