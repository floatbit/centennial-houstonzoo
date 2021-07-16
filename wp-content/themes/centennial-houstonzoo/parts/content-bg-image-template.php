<?php 
    $image = $part_params['image'];
    $description = $part_params['description'];
    $panel_color = $part_params['panel_color'];
    $specified_id = $part_params['specified_id'];
?>
<div class="dynamic-content-container">
    <div class="half-transparent-panel <?php print $panel_color; ?>" data-specified-id=<?php print $specified_id; ?>></div>
    <div class="bg-image-content background-cover" style="background-image:url(<?php print $image; ?>)" data-specified-id=<?php print $specified_id; ?>>
        <div class="grid-container">
            <div class="grid-x">
                <div class="cell medium-3 desc-container color-white">
                    <?php print $description; ?>
                </div>
            </div>
        </div>
    </div>
</div>