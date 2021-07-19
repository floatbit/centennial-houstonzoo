<?php
	$address = get_field('address', 'option');
  	$social_media_links = get_field('social_media', 'option');
	  $donate = get_field('donate', 'option');
?>

<footer class="bg-color-darker-green">
	<div class="grid-container">
		<div class="grid-x grid-margin-x align-middle">
			<div class="cell medium-4">
				<a href="/">
					<div class="logo-container">
						<img src="<?php print TEMPLATE_IMAGE_PATH."/logo-main.svg"; ?>">
					</div>
				</a>
			</div>
			<div class="cell medium-8">
				<div class="grid-x grid-margin-x">
					<div class="cell medium-8">
						<div class="grid-x grid-margin-x">
							<div class="cell medium-6">
								<div class="footer-links">
									<a href="/100-years"class="footer-link button-label color-light-blue">100 YEARS</a>
									<a href="#share-your-story"class="footer-link button-label color-light-blue">SHARE YOUR STORY</a>
									<a href="/your-zoo-transformed"class="footer-link button-label color-light-blue">YOUR ZOO TRANSFORMED</a>
								</div>
							</div>
							<div class="cell medium-6">
								<div class="footer-social-media">
								<a href="<?php print $donate['url']; ?>" target="_blank"" class="donate-button button-label color-light-blue"><?php print $donate['title']; ?></a>
									<span class="icon-desc button-label color-white">CONNECT : </span>
									<div class="icon-container">
										<a class="icon-item" href="<?php print $social_media_links['facebook']; ?>"><i class="fab fa-facebook-square color-light-blue"></i></a>
										<a class="icon-item" href="<?php print $social_media_links['twitter']; ?>"><i class="fab fa-twitter color-light-blue"></i></a>
										<a class="icon-item" href="<?php print $social_media_links['instagram']; ?>"><i class="fab fa-instagram color-light-blue"></i></a>
										<a class="icon-item" href="<?php print $social_media_links['pinterest']; ?>"><i class="fab fa-pinterest color-light-blue"></i></a>
										<a class="icon-item" href="<?php print $social_media_links['youtube']; ?>"><i class="fab fa-youtube color-light-blue"></i></a>
									</div>
								</div>
							</div>
							<div class="cell medium-12 show-for-medium bottom-content-container">
								<div class="grid-x grid-margin-x">
									<div class="cell medium-7">
										<p class="caption color-white">The Houston Zoo is a registered 501(c)(3) organization.</p>
									</div>
									<div class="cell medium-5">
										<p class="caption color-white">© 2021 Houston Zoo <a href="#" class="caption color-white underline">Privacy Policy</a></p>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="cell medium-4 footer-right-content">
						<img class="footer-logo-container show-for-medium" src="<?php print TEMPLATE_IMAGE_PATH."/logo-footer.svg"; ?>">
						<img class="footer-logo-container show-for-small-only" src="<?php print TEMPLATE_IMAGE_PATH."/logo-small-footer.svg"; ?>">
						<div class="footer-address-container">
							<div class="grid-x">
								<div class="cell small-6 medium-12">
									<?php print $address; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="cell medium-12 show-for-small-only bottom-content-container">
						<div class="small-copyright-container">
							<div class="organization-container">
								<p class="caption color-white">The Houston Zoo is a registered 501(c)(3) organization.</p>
							</div>
							<div class="grid-x">
								<div class="cell small-4">
									<p class="caption color-white">© 2021 Houston Zoo</p>
								</div>
								<div class="cell small-3">
									<a href="#" class="caption color-white underline">Privacy Policy</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>