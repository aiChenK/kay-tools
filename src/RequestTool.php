<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-26
 * Time: 11:03
 */

namespace KayTools;

class RequestTool
{
    /**
     * 获取客户端ip
     *
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getClientIp() : string
    {
        $ip = 'unknown';

        $keys = ['HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_ip', 'REMOTE_ADDR'];
        if (isset($_SERVER)) {
            foreach ($keys as $key) {
                if (isset($_SERVER[$key])) {
                    $ip = $_SERVER[$key];
                    break;
                }
            }
        } else {
            foreach ($keys as $key) {
                if (getenv($key)) {
                    $ip = getenv($key);
                    break;
                }
            }
        }

        if (trim($ip) === '::1') {
            $ip = '127.0.0.1';
        }
        if (is_string($ip)) {
            $ips = explode(',', $ip);
            $ip = end($ips);
        } elseif (is_array($ip)) {
            $ip = end($ip);
        }
        return $ip;
    }

}
