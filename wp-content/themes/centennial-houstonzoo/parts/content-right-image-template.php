<?php 
    $image = $part_params['image'];
    $description = $part_params['description'];
    $bg_color = $part_params['bg_color'];
?>

<div class="dynamic-content-container">
    <div class="grid-container">
        <div class="grid-x grid-margin-x <?php print $bg_color; ?>">
            <div class="cell small-10 medium-6">
                <div class="content-desc">
                    <?php print $description; ?>
                </div>
            </div>
            <div class="cell small-2 medium-6 content-image">
                <div class="content-image right-image">
                    <img src="<?php print $image; ?>">
                </div>
            </div>
        </div>
    </div>
</div>