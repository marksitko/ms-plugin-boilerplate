<?php

namespace mspb\helpers;


class Guard
{

    private static $instance;

    /**
     * @return self
     */
    public static function instance()
    {
        if (!self::$instance && !self::$instance instanceof Guard) {

            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function goHome()
    {
        wp_redirect(home_url());
        exit;
    }

    /**
     * @return boolean
     */
    public static function isAuthenticated()
    {
        if ( in_array('administrator', (array)wp_get_current_user()->roles) ) {
            return true;
        }
        return false;
    }

}