<?php
    $looping_item = $part_params['looping_item'];
    $specific_id  = $part_params['specific_id'];
    $i = 0;
?>

<?php foreach ($looping_item as $item): ?>
    <?php $i++; ?>
    <div class="content-container" data-id=<?php print $specific_id.$i; ?>>
        <div class="grid-x align-middle">
            <div class="cell small-3">
                <a href="#show-description">
                    <img class="info-logo" src="<?php print $item['image']; ?>">
                </a>
            </div>
            <div class="cell small-9">
                <div class="info-title">
                    <a href="#show-description" data-id=<?php print $i; ?> data-specific-id=<?php print $specific_id; ?>>
                        <h4 class="color-black"><?php print $item['title'] ?></h4>
                    </a>
                </div>
                <div class="info-desc hide" data-id=<?php print $specific_id.$i; ?>>
                    <a href="#show-description" class="color-black" data-id=<?php print $specific_id.$i; ?>>
                        <?php print $item['description'] ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>