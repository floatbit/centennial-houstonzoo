<?php 
    $image = $part_params['image'];
    $description = $part_params['description'];
    $panel_color = $part_params['panel_color'];
?>
<div class="dynamic-content-container">
    <div class="transparent-panel <?php print $panel_color; ?>"></div>
    <div class="bg-image background-cover" style="background-image:url(<?php print $image; ?>)">
        <div class="grid-container">
            <div class="grid-x">
                <div class="cell medium-3 desc-container color-white">
                    <?php print $description; ?>
                </div>
            </div>
        </div>			
    </div>
    </div>
</div>