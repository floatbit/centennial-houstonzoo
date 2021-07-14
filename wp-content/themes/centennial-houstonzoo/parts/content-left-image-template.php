<?php 
    $image = $part_params['image'];
    $description = $part_params['description'];
    $bg_color = $part_params['bg_color'];
?>

<div class="grid-container">
    <div class="dynamic-content-container">
        <div class="grid-x grid-margin-x <?php print $bg_color; ?>">
            <div class="cell medium-6">
                <div class="content-image">
                    <img src="<?php print $image; ?>">
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