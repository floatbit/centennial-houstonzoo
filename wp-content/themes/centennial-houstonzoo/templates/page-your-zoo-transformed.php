<?php
  /*
  Template Name: Your Zoo Transformed
  */
?>

<?php get_header();?>

<?php
	$intro_image = get_the_post_thumbnail_url();
	$main_content_items = get_field('main_content');
	$completed_projects = get_field('completed_projects');
?>

<main>
	<section id="intro">
		<div class="intro-image background-cover" style="background-image:url(<?php print $intro_image; ?>)">
			<div class="transparent-intro-panel blue"></div>
			<div class="grid-x align-center">
				<div class="cell large-6 intro-desc color-white">
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
							<?php 
								set_query_var( 'part_params', array(
									'eyebrow' => 'Current Projects',
									'title' => $itemContent['title'],
									'description' => $itemContent['description'],
									'image' => $itemContent['image'],
									'panel_color' => 'darker-green',
									'specified_id' => 'your-zoo',
									'small_size' => true
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
			<div class="projects-container">
				<div class="grid-x grid-margin-x">
					<div class="cell large-12 large-offset-1">
						<p class="title-content eyebrow bold color-dark-green"><?php print $completed_projects['eyebrow']; ?></p>
						<p></p>
					</div>
					<div class="cell large-12 large-offset-1">
						<div class="grid-x grid-margin-x grid-margin-y">
							<?php foreach($completed_projects['projects'] as $key => $item):?>
								<div class="cell small-7 project-id-container" data-id=<?php print $key; ?>>
									<div class="project-item-container" data-id=<?php print $key; ?>>
										<a href="#show-project-desc" data-id=<?php print $key; ?> data-count-item=<?php print count($completed_projects['projects']); ?>>
											<div class="image-container">
												<img src="<?php print $item['image']; ?>">
											</div>
											<div class="grid-x grid-margin-x">
												<div class="cell auto">
													<div class="title-container">
														<h4 class="color-black"><?php print $item['title']; ?></h4>
													</div>
												</div>
												<div class="cell shrink">
													<div class="show-desc-project-container">
														<span class="show-desc button-plus no-text" data-id=<?php print $key; ?>></span>
													</div>
												</div>
											</div>
											<p class="eyebrow color-light-green">
												<?php print $item['eyebrow']; ?>
											</p>
										</a>
										<div class="description-container hide" data-id=<?php print $key; ?>>
											<div class="desc-content">
												<?php print $item['description']; ?>
											</div>
											<?php if ($item['cta'] != null): ?>
												<div class="link-content">
													<a href="<?php print $item['cta']; ?>" class="button green-outer">
														LEARN MORE
													</a>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>