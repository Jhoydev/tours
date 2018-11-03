<?php

if (!function_exists('get_random_string')) {

    /**
     * Give us a random string
     *
     * @param $length
     * @return string
     */
    function get_random_string($length = 20)
    {
        $str        = "";
        $characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
        $max        = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str  .= $characters[$rand];
        }
        return $str;
    }

}

if (!function_exists('get_status_color')) {

    /**
     * Give us a random string
     *
     * @param $length
     * @return string
     */
    function get_status_color($order_status_id)
    {
        $str = "";

        switch ((int) $order_status_id) {
            case 1:
                $str = "text-success";
                break;
            case 2:
                $str = "text-warning";
                break;
            case 3:
                $str = "text-secondary";
                break;
            case 4:
                $str = "text-danger";
                break;
            case 5:
                $str = "text-info";
                break;
            default:
                $str = "text-primary";
                break;
        }

        return $str;
    }

}