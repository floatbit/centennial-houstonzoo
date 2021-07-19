<?php
    $looping_item = $part_params['looping_item'];
    $specific_id  = $part_params['specific_id'];
    $i = 0;
?>

<?php foreach ($looping_item as $item): ?>
    <?php $i++; ?>
    <div class="content-container" data-id=<?php print $i; ?> data-specific-id=<?php print $specific_id; ?>>
        <div class="grid-x align-middle">
            <div class="cell small-3">
                <a href="#show-description" class="image-show-desc" data-id=<?php print $i; ?> data-specific-id=<?php print $specific_id; ?>>
                    <img class="info-logo" src="<?php print $item['image']; ?>">
                </a>
            </div>
            <div class="cell small-9">
                <div class="info-title flex-container align-middle">
                    <a href="#show-description" data-id=<?php print $i; ?> data-specific-id=<?php print $specific_id; ?>>
                        <h4 class="title-content color-black"><?php print $item['title'] ?></h4>
                    </a>
                </div>
                <div class="info-desc hide" data-id=<?php print $i; ?> data-specific-id=<?php print $specific_id; ?>>
                    <a href="#show-description" class="button-show-desc color-black" data-id=<?php print $i; ?> data-specific-id=<?php print $specific_id; ?>>
                        <?php print $item['description'] ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>