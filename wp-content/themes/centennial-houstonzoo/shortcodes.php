<?php
    function HZO_two_column_shortcode($atts = array(), $content = null ) {
        $html = '<div class="content-text-two-column">'.trim($content).'</div>';
        return $html;
    }
    add_shortcode('two-columns', 'zadok_v2_two_column_shortcode');
?>