<?php
	$address = get_field('address', 'option');
  	$social_media_links = get_field('social_media', 'option');
	  $donate = get_field('donate', 'option');
?>

<footer class="bg-color-darker-green">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell medium-5 large-4 large-offset-1 align-self-middle">
				<a href="/">
					<div class="logo-container">
						<img src="<?php print TEMPLATE_IMAGE_PATH."/logo-main.svg"; ?>">
					</div>
				</a>
			</div>
			<div class="cell medium-6">
				<div class="grid-x grid-margin-x">
					<div class="cell large-7">
						<div class="footer-links">
							<a href="/100-years"class="footer-link graphik-bold text-uppercase color-light-blue">100 YEARS</a>
							<a href="#share-your-story"class="footer-link graphik-bold text-uppercase color-light-blue">SHARE YOUR STORY</a>
							<a href="/your-zoo-transformed"class="footer-link graphik-bold text-uppercase color-light-blue">YOUR ZOO TRANSFORMED</a>
						</div>
					</div>
					<div class="cell large-7">
						<div class="footer-social-media">
						<a href="<?php print $donate['url']; ?>" target="_blank"" class="donate-button graphik-bold text-uppercases color-light-blue"><?php print $donate['title']; ?></a>
							<span class="icon-desc graphik-bold text-uppercase color-white">CONNECT : </span>
							<div class="icon-container">
								<a class="icon-item" href="<?php print $social_media_links['facebook']; ?>"><i class="fab fa-facebook-square color-light-blue"></i></a>
								<a class="icon-item" href="<?php print $social_media_links['twitter']; ?>"><i class="fab fa-twitter color-light-blue"></i></a>
								<a class="icon-item" href="<?php print $social_media_links['instagram']; ?>"><i class="fab fa-instagram color-light-blue"></i></a>
								<a class="icon-item" href="<?php print $social_media_links['pinterest']; ?>"><i class="fab fa-pinterest color-light-blue"></i></a>
								<a class="icon-item" href="<?php print $social_media_links['youtube']; ?>"><i class="fab fa-youtube color-light-blue"></i></a>
							</div>
						</div>
					</div>
					<div class="cell medium-14 show-for-medium bottom-content-container">
						<div class="grid-x grid-margin-x">
							<div class="cell medium-auto">
								<p class="caption color-white">The Houston Zoo is a registered 501(c)(3) organization.</p>
							</div>
							<div class="cell medium-shrink">
								<p class="caption color-white">© <?php print date("Y"); ?> Houston Zoo&nbsp;&nbsp;<a href="#" class="caption color-white underline">Privacy Policy</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="cell medium-3 footer-right-content">
				<a href="https://www.houstonzoo.org/" target="_blank">
					<img class="footer-logo-container show-for-medium" src="<?php print TEMPLATE_IMAGE_PATH."/logo-footer.svg"; ?>">
					<img class="footer-logo-container show-for-small-only" src="<?php print TEMPLATE_IMAGE_PATH."/logo-small-footer.svg"; ?>">
				</a>
				<div class="footer-address-container">
					<div class="grid-x">
						<div class="cell small-7 medium-12">
							<?php print $address; ?>
						</div>
					</div>
				</div>
			</div>
			<div class="cell show-for-small-only bottom-content-container">
				<div class="small-copyright-container">
					<div class="organization-container">
						<p class="caption color-white">The Houston Zoo is a registered 501(c)(3) organization.</p>
					</div>
					<div class="privacy-container">
						<p class="caption color-white">© <?php print date('Y'); ?> Houston Zoo&nbsp;&nbsp;<a href="/privacy-policy" class="caption color-white underline">Privacy Policy</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>