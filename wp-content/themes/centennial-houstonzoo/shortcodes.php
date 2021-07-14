<?php
    function centennial_houstonzoo_eyebrow_shortcode($atts = array(), $content = null ) {
        $html = '<div class="eyebrow">'.trim($content).'</div>';
        return $html;
    }

    add_shortcode('eyebrow', 'centennial_houstonzoo_eyebrow_shortcode');
?>