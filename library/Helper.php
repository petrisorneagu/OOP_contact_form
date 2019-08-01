<?php


class Helper
{
    /**
     * send the output is safe to send through javascript and display it on the page
     * @param null $value
     * @return string
     */
    public static function jsonEncode($value = null){
        if(defined('JSON_UNESCAPED_UNICODE')){

            return json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

        }else{
            return json_encode($value, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP );
        }
    }

    /**
     * warning messages displayed above the form (e.g red background for the 'alert')
     * @param null $message
     * @param string $type
     * @return string
     */
    public static function alert($message = null, $type = 'alert'){
        $out = '<div class = "alert-box>'; // class from Foundation
        $out .= !empty($type) ? ' '.$type : null;
        $out .= '">';
        $out .= $message;
        $out .= '</div>';

        return $out;
    }

}

