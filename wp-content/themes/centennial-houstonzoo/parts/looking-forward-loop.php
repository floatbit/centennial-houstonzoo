<?php
    $looping_item = $part_params['looping_item'];
    $specific_id  = $part_params['specific_id'];
?>

<?php foreach ($looping_item as $key => $item): ?>
    <div class="content-container" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
        <div class="grid-x grid-margin-x align-middle content-inner-container">
            <div class="cell small-3">
                <a href="#show-description" class="image-show-desc" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
                    <img class="info-logo" src="<?php print $item['image']; ?>">
                </a>
            </div>
            <div class="cell small-11">
                <div class="info-title flex-container align-middle">
                    <a href="#show-description" class="title-open-button" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
                        <h4 class="title-content color-black"><?php print $item['title'] ?></h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="grid-x grid-margin-x">
            <div class="cell small-3"></div>
            <div class="cell small-11">
                <div class="info-desc hide" data-id=<?php print $key; ?> data-specific-id=<?php print $specific_id; ?>>
                    <?php print $item['description'] ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>