<?php
	$donate = get_field('donate', 'option');
?>

<header>
	<div class="head-container hide-when-menu-active">
		<div class="grid-x grid-margin-x">
			<div class="cell medium-3 left-content show-for-medium">
				<a href="<?php print $donate['url']; ?>" target="_blank" class="button bright-green"><?php print $donate['title']; ?></a>
			</div>
			<div class="cell small-10 medium-8 middle-content">
				<a href="/">
					<img class="logo-white" src="<?php print TEMPLATE_IMAGE_PATH."/logo-main.svg"; ?>">
					<img class="compact-logo-white hide" src="<?php print TEMPLATE_IMAGE_PATH."/logo-main-compact.png"; ?>">
				</a>
			</div>
			<div class="cell small-4 medium-3 right-content">
				<a href="#menu-open" class="fal fa-bars"></a>
			</div>
		</div>
	</div>
</header>
<div class="main-content-wrapper">