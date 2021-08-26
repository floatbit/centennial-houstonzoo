<?php
    $looping_item = $part_params['looping_item'];
    $specific_id  = $part_params['specific_id'];
?>

<?php foreach ($looping_item as $key => $item): ?>
    <div class="content-container" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
        <div class="grid-x grid-margin-x align-top content-inner-container">
            <div class="cell shrink image-show-desc-container">
                <a href="#show-description" class="image-show-desc" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
                    <img class="info-logo" src="<?php print $item['image']; ?>">
                </a>
            </div>
            <div class="cell auto">
                <div class="info-title">
                    <a href="#show-description" class="title-open-button" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
                        <h4 class="title-content color-black"><?php print $item['title'] ?></h4>
                    </a>
                </div>
                <div class="info-desc hide" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
                    <?php print $item['description'] ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>