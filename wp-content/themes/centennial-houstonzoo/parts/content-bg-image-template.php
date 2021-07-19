<?php 
    $image = $part_params['image'];
    $eyebrow = $part_params['eyebrow'];
    $title = $part_params['title'];
    $description = $part_params['description'];
    $panel_color = $part_params['panel_color'];
    $specified_id = $part_params['specified_id'];
    $small_size = $part_params['small_size'];
?>
<div class="dynamic-content-container">
    <div class="half-transparent-panel <?php print ($small_size == true) ? 'small-size show-for-medium' : '' ?> <?php print $panel_color; ?>" data-specified-id=<?php print $specified_id; ?>></div>
    <div class="bg-image-content background-cover <?php print ($small_size == true) ? 'small-size show-for-medium' : '' ?>" style="background-image:url(<?php print $image; ?>)" data-specified-id=<?php print $specified_id; ?>>
        <div class="grid-container">
            <div class="grid-x">
                <div class="cell <?php print ($small_size == true) ? 'medium-5' : 'small-9 medium-3' ?>">
                    <div class="desc-container color-white">
                        <p class="eyebrow color-white"><?php print $eyebrow; ?></p>
                        <h3><?php print $title; ?></h3>
                        <?php print $description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($small_size == true): ?>
        <div class="small-bg-image-content show-for-small-only">
            <div class="small-bg-image-container">
                <div class="small-bg-item-image background-cover" style="background-image:url(<?php print $image; ?>)">
                    <div class="title-container">
                        <p class="eyebrow color-white"><?php print $eyebrow; ?></p>
                        <h3 class="color-white"><?php print $title; ?></h3>
                    </div>
                </div>
                <div class="half-transparent-panel <?php print $panel_color; ?>"></div>
            </div>
            <div class="small-descriptionn-container bg-color-darker-green color-white">
                <?php print $description; ?>
            </div>
        </div>
    <?php endif; ?>
</div>