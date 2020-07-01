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

        if (trim($ip) == '::1') {
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

    /**
     * 获取客户端浏览器
     *
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getClientBrowser(): string
    {
        $browser = '未知';
        $version = '';

        $agent = ServerTool::getServer('HTTP_USER_AGENT');
        $maps  = [
            [
                'name' => 'Firefox',
                'agent' => 'Firefox/',
                'preg' => '/Firefox\/([^;)]+)+/i',
            ],
            [
                'name' => 'IE',
                'agent' => 'MSIE/',
                'preg' => '/MSIE\s+([^;)]+)+/i',
            ],
            [
                'name' => 'Opera',
                'agent' => 'OPR',
                'preg' => '/OPR\/([\d\.]+)/',
            ],
            [
                'name' => 'Edge',
                'agent' => 'Edge',
                'preg' => '/Edge\/([\d\.]+)/',
            ],
            [
                'name' => 'Chrome',
                'agent' => 'Chrome',
                'preg' => '/Chrome\/([\d\.]+)/',
            ],
            [
                'name' => 'IE',
                'agent' => ['rv:', 'Gecko'],
                'preg' => '/rv:([\d\.]+)/',
            ]
        ];
        foreach ($maps as $map) {
            $pos   = is_string($map['agent']) ? [$map['agent']] : $map['agent'];
            $exist = false;
            foreach ($pos as $val) {
                if (stripos($agent, $val) > 0) {
                    $exist = true;
                    continue;
                }
                $exist = false;
            }
            if (!$exist) {
                continue;
            }
            preg_match($map['preg'], $agent, $info);
            $browser = $map['name'];
            $version = $info[1];
            break;
        }
        return $browser . ($version ? "({$version})" : '');
    }

    /**
     * 获取客户端操作系统（常用系统）
     *
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getClientOs() : string
    {
        $os = '未知';

        $agent = ServerTool::getServer('HTTP_USER_AGENT');
        $maps  = [
            [
                'name' => 'Windows Vista',
                'preg' => ['/win/i', '/nt 6.0/i']
            ],
            [
                'name' => 'Windows 7',
                'preg' => ['/win/i', '/nt 6.1/i']
            ],
            [
                'name' => 'Windows 8',
                'preg' => ['/win/i', '/nt 6.2/i']
            ],
            [
                'name' => 'Windows 10',
                'preg' => ['/win/i', '/nt 10.0/i']
            ],
            [
                'name' => 'Windows XP',
                'preg' => ['/win/i', '/nt 5.1/i']
            ],
            [
                'name' => 'Windows NT',
                'preg' => ['/win/i', '/nt/i']
            ],
            [
                'name' => 'Linux',
                'preg' => '/linux/i'
            ],
            [
                'name' => 'Unix',
                'preg' => '/unix/i'
            ]
        ];
        foreach ($maps as $map) {
            $pos   = is_string($map['preg']) ? [$map['preg']] : $map['preg'];
            $exist = false;
            foreach ($pos as $val) {
                if (preg_match($val, $agent)) {
                    $exist = true;
                    continue;
                }
                $exist = false;
            }
            if (!$exist) {
                continue;
            }
            $os = $map['name'];
            break;
        }
        return $os;
    }
}