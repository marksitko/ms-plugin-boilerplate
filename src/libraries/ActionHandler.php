<?php

namespace mspb\libraries;

class ActionHandler
{

    private static $instance;
    private static $status;
    private static $msg;

    /**
     * @return self
     */
    public static function instance()
    {
        if (!self::$instance && !self::$instance instanceof ActionHandler) {

            self::$instance = new static();
        }

        return self::$instance;
    }

    public static function setStatus($status)
    {
        self::$status = $status;
        return self::$instance;
    }

    public static function setMsg($msg)
    {
        self::$msg = $msg;
        return self::$instance;
    }

    public static function getStatus()
    {
        return self::$status;
    }

    public static function getMsg()
    {
        return self::$msg;
    }

    public static function getNotification()
    {
        return array(
            'msg' => self::getMsg(),
            'status' => self::getStatus()
        );
    }

}