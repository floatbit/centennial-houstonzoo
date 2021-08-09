<?php
    function centennial_houstonzoo_eyebrow_shortcode($atts = array(), $content = null ) {
        $html = '<p class="eyebrow">'.trim($content).'</p>';
        return $html;
    }

    add_shortcode('eyebrow', 'centennial_houstonzoo_eyebrow_shortcode');
?>