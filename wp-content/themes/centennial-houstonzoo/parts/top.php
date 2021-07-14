<?php
	$donate = get_field('donate', 'option');
?>

<header>
  <div class="grid-container">
    <div class="grid-x grid-margin-x">
<<<<<<< HEAD
		<div class="cell medium-3 left-content">
			<a href="<?php print $donate['url']; ?>" class="button light-green"><?php print $donate['title']; ?></a>
		</div>
		<div class="cell medium-6 middle-content">
			<img class="logo-white" src="<?php print TEMPLATE_IMAGE_PATH."/Main-Logo.svg"; ?>">
			<img class="logo-black hide" src="<?php print TEMPLATE_IMAGE_PATH."/Main-Logo-Black.svg"; ?>">
		</div>
		<div class="cell medium-3 right-content">
			<a href="#" class="fal fa-bars"></a>
		</div>
=======
      <div class="cell medium-3 left-content">
        <a href="#" class="button light-green">
          Donate
        </a>
      </div>
      <div class="cell medium-6 middle-content">
        <img src="<?php print TEMPLATE_IMAGE_PATH."/Main-Logo.svg"; ?>">
      </div>
      <div class="cell medium-3 right-content">
        <a href="#menu-open" class="fal fa-bars color-white"></a>
      </div>
>>>>>>> cc4c3a15c5a622583522126afc32e32397310e8b
    </div>
  </div>
</header>