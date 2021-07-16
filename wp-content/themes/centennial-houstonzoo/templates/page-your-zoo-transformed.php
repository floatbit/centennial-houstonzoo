<?php
  /*
  Template Name: Your Zoo Transformed
  */
?>

<?php get_header();?>

<?php
	$intro_image = get_field('intro');
	$main_content_items = get_field('main_content');
	$completed_projects = get_field('completed_projects');
?>

<main>
	<section id="intro">
		<div class="intro-image background-cover" style="background-image:url(<?php print $intro_image; ?>)">
			<div class="transparent-intro-panel blue"></div>
			<div class="grid-x">
				<div class="cell intro-desc color-white">
					<h1 class="large"><?php print the_title(); ?></h1>
					<?php print the_content(); ?>
				</div>
			</div>
		</div>
	</section>

	<section id="main-content">
		<?php foreach($main_content_items as $item): ?>
			<?php if ($item['acf_fc_layout'] == 'left_image_content'): ?>
				<?php 
					set_query_var( 'part_params', array(
						'description' => $item['description'],
						'can_expand' => $item['can_expand'],
						'expand_text' => $item['expand_text'],
						'image' => $item['image']
					));
					get_template_part( 'parts/content-left-image-expand-template');
				?>
			<?php elseif ($item['acf_fc_layout'] == 'background_image_content'): ?>
				<div class="carousel your-zoo-carousel-main">
					<?php foreach($item['contents'] as $itemContent): ?>
						<div class="carousel-cell">
							<!-- <div class="bg-image background-cover" style="background-image:url(<?php print $itemContent['image']; ?>)">
								<div class="grid-container">
									<div class="grid-x">
										<div class="cell medium-3 desc-container color-white">
											<?php print $itemContent['description']; ?>
										</div>
									</div>
								</div>
							</div> -->
							<?php 
								set_query_var( 'part_params', array(
									'description' => $itemContent['description'],
									'image' => $itemContent['image'],
									'panel_color' => 'darker-green',
									'specified_id' => 'your-zoo'
								));
								get_template_part( 'parts/content-bg-image-template' );
							?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		<?php endforeach; ?>
	</section>

	<section id="completed-projects">
		<div class="grid-container">
			<div class="title-content">
				<p class="color-light-green"><?php print $completed_projects['eyebrow']; ?></p>
			</div>
			<div class="projects-container">
				<div class="grid-x grid-margin-x">
					<?php foreach($completed_projects['projects'] as $item):?>
						<div class="cell small-6 medium-4">
							<div class="project-item-container">
								<div class="image-container">
									<img src="<?php print $item['image']; ?>">
								</div>
								<div class="title-container">
									<h4><?php print $item['title']; ?></h4>
								</div>
								<div class="eyebrow-container">
									<p class="eyebrow color-light-green">
										<?php print $item['eyebrow']; ?>
									</p>
								</div>
								<div class="description-container">
									<div class="desc-content">
										<?php print $item['description']; ?>
									</div>
									<div class="link-content">
										<a href="<?php print $item['cta']; ?>" class="button transparent border-color-light-green">
											LEARN MORE
										</a>
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>