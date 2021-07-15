<?php
    $looping_item = $part_params['looping_item'];
    $i = 0;
?>

<?php foreach ($looping_item as $item): ?>
    <?php $i++; ?>
    <div class="content-container" data-id=<?php print $i; ?>>
        <div class="grid-x grid-margin-x align-middle">
            <div class="cell small-2">
                <a href="#show-description">
                    <img class="info-logo" src="<?php print $item['image']; ?>">
                </a>
            </div>
            <div class="cell small-10">
                <div class="info-title">
                    <a href="#show-description">
                        <h4 class="color-black"><?php print $item['title'] ?></h4>
                    </a>
                </div>
                <div class="info-desc hide" data-id=<?php print $i; ?>>
                    <a href="#show-description" data-id=<?php print $i; ?>>
                        <?php print $item['description'] ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>