<?php 
	$list_menus = get_field('list_menus', 'option');
	$menu_title = get_field('menu_title', 'option');
	$menu_text	= get_field('menu_text', 'option');
	$donate		= get_field('donate', 'option');
?>
<div class="menu-open-container">
	
	<div class="grid-container">
			
		<div class="header-container">
			<div class="grid-x grid-margin-x">
				<div class="cell medium-offset-3 medium-6 hide-for-small-only">
					<img src="<?php print TEMPLATE_IMAGE_PATH."/Main-Logo.svg"; ?>">
				</div>
				<div class="cell medium-3 right-content">
					<a href="#menu-open" class="fal fa-times color-white"></a>
				</div>
			</div>
		</div>

		<div class="menu-container">
			<div class="grid-y">
				<div class="grid-x grid-padding-x">
					<div class="cell medium-6 left-section">
						<?php if ($list_menus): ?>
							<?php foreach ($list_menus as $list_menu): ?>
								<div class="menu-item">
									<a href="<?php print $list_menu['cta'] ?>" class="">
										<h2 class="color-light-blue"><?php print $list_menu['title'] ?></h2>
									</a>
									<p class="color-white"><?php print $list_menu['text'] ?></p>
								</div>
							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="cell medium-6 right-section">
						<div class="content-right color-white">
							<h3 class="title"><?php print $menu_title; ?></h3>
							<p class="text"><?php print $menu_text; ?></p>
							<a href="<?php print $donate ?>" class="button bright-green">Donate</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>