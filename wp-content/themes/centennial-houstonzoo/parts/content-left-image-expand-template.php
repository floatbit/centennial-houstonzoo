<?php 
    $image = $part_params['image'];
    $description = $part_params['description'];
    $bg_color = $part_params['bg_color'];
    $can_expand = $part_params['can_expand'];
    $expand_text = $part_params['expand_text'];
?>

<div class="dynamic-content-container">
    <div class="grid-container">
        <div class="side-image-content">
            <div class="grid-x grid-margin-x">
                <div class="cell medium-6">
                    <div class="content-image left-image">
                        <img src="<?php print $image; ?>">
                    </div>
                    <?php if($can_expand == true): ?>
                        <div class="flex-container align-middle expand-button-container">
                            <a href="#expand-image" class="button-plus fill"></a><span class="button-label color-dark-green"><?php print $expand_text; ?></span>
                        </div>
                    <?php endif;?>
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