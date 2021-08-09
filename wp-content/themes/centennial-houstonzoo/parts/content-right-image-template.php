<?php 
    $image = $part_params['image'];
    $eyebrow = $part_params['eyebrow'];
    $title = $part_params['title'];
    $description = $part_params['description'];
    $bg_color = $part_params['bg_color'];
?>

<div class="dynamic-content-container <?php print ($bg_color != null) ? 'bg-color-'.$bg_color : '' ; ?>">
    <div class="grid-container">
        <div class="side-image-content">
            <div class="grid-x grid-margin-x">
                <div class="cell medium-7 large-6 large-offset-1">
                    <div class="content-desc">
                        <p class="eyebrow"><?php print $eyebrow; ?></p>
                        <h2><?php print $title; ?></h2>
                        <div class="show-for-medium"><?php print $description; ?></div>
                    </div>
                </div>
                <div class="cell small-5 medium-7 large-6 large-offset-1">
                    <div class="content-image right-image">
                        <img src="<?php print $image; ?>">
                    </div>
                </div>
                <div class="cell small-9 show-for-small-only">
                    <div class="content-desc">
                        <?php print $description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>