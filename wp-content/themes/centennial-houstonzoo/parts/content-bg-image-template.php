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
    <div class="bg-image-content background-cover blend-background <?php print ($small_size == true) ? 'small-size show-for-medium' : '' ?>" style="--bg-url:url(<?php print $image; ?>)" data-specified-id=<?php print $specified_id; ?>></div>
    <div class="bg-content-container <?php print ($small_size == true) ? 'small-size show-for-medium' : '' ?>">
        <div class="grid-container">
            <div class="grid-x grid-margin-x">
                <div class="cell <?php print ($small_size == true) ? 'medium-6 large-offset-1' : 'small-9 medium-6 large-4 large-offset-1 cell-container' ?>">
                    <div class="desc-container color-white">
                        <?php if($eyebrow != null): ?>
                            <p class="eyebrow color-white"><?php print $eyebrow; ?></p>
                        <?php endif; ?>
                        <?php if($title != null): ?>
                            <h3 class="color-light-blue"><?php print $title; ?></h3>
                        <?php endif; ?>
                        <?php print $description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if($small_size == true): ?>
        <div class="small-bg-image-content show-for-small-only">
            <div class="small-bg-image-container">
                <div class="small-bg-item-image background-cover blend-background vertical-blend" style="--bg-url:url(<?php print $image; ?>)">
                    <div class="title-container">
                        <p class="eyebrow color-white"><?php print $eyebrow; ?></p>
                        <h3 class="color-light-blue"><?php print $title; ?></h3>
                    </div>
                </div>
            </div>
            <div class="small-description-container bg-color-darker-green color-white">
                <?php print $description; ?>
            </div>
        </div>
    <?php endif; ?>
</div>