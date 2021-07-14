<?php
	$donate = get_field('donate', 'option');
?>

<header>
  <div class="grid-container">
    <div class="grid-x grid-margin-x">
		<div class="cell medium-3 left-content show-for-medium">
			<a href="<?php print $donate['url']; ?>" class="button light-green"><?php print $donate['title']; ?></a>
		</div>
		<div class="cell small-9 medium-6 middle-content">
			<img class="logo-white" src="<?php print TEMPLATE_IMAGE_PATH."/Main-Logo.svg"; ?>">
			<img class="logo-black hide" src="<?php print TEMPLATE_IMAGE_PATH."/Main-Logo-Black.svg"; ?>">
		</div>
		<div class="cell small-3 medium-3 right-content">
			<a href="#" class="fal fa-bars"></a>
		</div>
    </div>
  </div>
</header>