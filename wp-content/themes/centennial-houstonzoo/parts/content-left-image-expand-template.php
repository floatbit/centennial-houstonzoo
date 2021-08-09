<?php 
    $image = $part_params['image'];
    $description = $part_params['description'];
    $bg_color = $part_params['bg_color'];
    $can_expand = $part_params['can_expand'];
    $expand_text = $part_params['expand_text'];
?>

<div class="dynamic-content-container">
    <div class="grid-container">
        <div class="side-image-content expand-content">
            <div class="grid-x grid-margin-x">
                <div class="cell medium-7 large-6 large-offset-1">
                    <div class="grid-x grid-margin-x">
                        <div class="cell small-9 medium-14">
                            <div class="content-image left-image">
                                <img src="<?php print $image; ?>">
                                <div class="image-reveal full reveal" id="example" data-reveal>
                                    <a class="close-button" data-close type="button">
                                        <span class="color-black">&times;</span>
                                    </a>
                                    <img src="<?php print $image; ?>">
                                </div>
                            </div>
                        </div>
                        <?php if($can_expand == true): ?>
                            <div class="cell small-5 medium-14">
                                <div class="expand-button-container">
                                    <a data-open="example" class="button-plus fill button-label color-dark-green"><?php print $expand_text; ?></a>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="cell medium-7 large-6">
                    <div class="content-desc">
                        <?php print $description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>