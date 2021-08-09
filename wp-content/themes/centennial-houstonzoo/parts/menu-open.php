<?php 
	$list_menus = get_field('list_menus', 'option');
	$menu_title = get_field('menu_title', 'option');
	$menu_text	= get_field('menu_text', 'option');
	$donate		= get_field('donate', 'option');
?>
<div class="menu-open-container">
	<div class="menu-open-container-inner">
		<div class="overlay"></div>
		<div class="header-container">
			<div class="grid-x grid-margin-x align-top">
				<div class="cell medium-4 show-for-medium">
					<a href="<?php print $donate['url']; ?>" target="_blank" class="button bright-green button-inside-menu hide"><?php print $donate['title']; ?></a>
				</div>
				<div class="cell medium-6 small-7 logo-content">
					<a href="/" class="hide-for-small-only">
						<img src="<?php print TEMPLATE_IMAGE_PATH."/logo-main.svg"; ?>">
					</a>
					<a href="#menu-open-back" class="button button-label button-back show-for-small-only">
						BACK TO MENU
					</a>
				</div>
				<div class="cell medium-4 small-7 right-content">
					<a href="#menu-open" class="fal fa-times color-white"></a>
				</div>
			</div>
		</div>
		<div class="grid-container">	
			<div class="menu-container">
				<div class="grid-y">
					<div class="grid-x grid-padding-x">
						<div class="cell medium-7 left-section">
							<?php if ($list_menus): ?>
								<?php foreach ($list_menus as $key => $list_menu): ?>
									<div class="menu-item active" data-id="<?php print $key; ?>">
										<a href="<?php print $list_menu['cta'] ?>" class="">
											<h2 class="color-light-blue title-text"><?php print $list_menu['title'] ?></h2>
											<p class="color-white"><?php print $list_menu['text'] ?></p>
										</a>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<div class="cell medium-7 right-section">
							<div class="content-right default-content color-white active">
								<h3 class="title"><?php print $menu_title; ?></h3>
								<p class="text"><?php print $menu_text; ?></p>
								<a href="<?php print $donate['url']; ?>" target="_blank" class="button bright-green">Donate Now</a>
							</div>
							<div class="content-right your-story-container color-white">
								<?php print do_shortcode( '[gravityform id="1" ajax=true]' ) ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	$page = get_page_by_path( 'terms-and-conditions' );	
?>
<div class="reveal" id="terms-reveal" data-reveal>
  <div class="grid-container">
	  <div class="grid-x">
		  <div class="cell cell-container">
				<h3 class="color-dark-green small"> 
					<?php print get_the_title( $page ); ?> 
				</h3>
				<div class="content-container">
					<?php print apply_filters('the_content', $page->post_content ); ?>
				</div>
		  </div>
	  </div>
  </div>

  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true" class="fal fa-times color-dark-green"></span>
  </button>
</div>