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
                <div class="cell medium-6">
                    <div class="grid-x">
                        <div class="cell small-8 medium-12">
                            <div class="content-image left-image">
                                <img src="<?php print $image; ?>">
                                <img src="<?php print $image; ?>" class="reveal full" id="example" data-reveal>
                            </div>
                        </div>
                        <?php if($can_expand == true): ?>
                            <div class="cell small-4 medium-12">
                                <div class="expand-button-container">
                                    <a data-open="example" class="button-plus fill button-label color-dark-green"><?php print $expand_text; ?></a>
                                </div>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
                <div class="cell medium-6">
                    <div class="content-desc">
                        <?php print $description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>