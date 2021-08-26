<?php
	$donate = get_field('donate', 'option');
?>

<header class="hide-when-menu-active">
	<div class="head-container">
		<div class="grid-x grid-margin-x grid-head align-middle">
			<div class="cell medium-3 left-content show-for-medium">
				<a href="<?php print $donate['url']; ?>" target="_blank" class="button bright-green"><?php print $donate['title']; ?></a>
			</div>
			<div class="cell small-10 medium-8 middle-content">
				<a href="/">
					<img class="logo-white" src="<?php print TEMPLATE_IMAGE_PATH."/logo-main.svg"; ?>">
					<img class="compact-logo-white hide" src="<?php print TEMPLATE_IMAGE_PATH."/logo-main-compact.svg"; ?>">
				</a>
			</div>
			<div class="cell small-4 medium-3 right-content flex-container align-middle align-right">
				<a href="#menu-open" class="flex-container">
					<img src="<?php print TEMPLATE_IMAGE_PATH.'/icon-burger.svg'; ?>" class="menu-burger" alt="Menu">
				</a>
			</div>
		</div>
	</div>
</header>
<div class="main-content-wrapper">