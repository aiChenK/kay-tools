<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:14
 */

namespace KayTools;

class TimeTool
{
    /**
     * 秒时间转为中文
     *
     * @param $seconds
     * @param string $default
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function friendlyCost($seconds, string $default = '') : string
    {
        $str     = $default;
        $seconds = str_replace(',', '', $seconds);
        if (!is_numeric($seconds)) {
            return $str;
        }

        $splits = [
            'year'   => [
                'explain' => '年',
                'val'     => 3600 * 24 * 365
            ],
            'day'    => [
                'explain' => '天',
                'val'     => 3600 * 24
            ],
            'hour'   => [
                'explain' => '小时',
                'val'     => 3600
            ],
            'minute' => [
                'explain' => '分',
                'val'     => 60
            ],
            'second' => [
                'explain' => '秒',
                'val'     => 1
            ],
        ];
        $str = '';
        foreach ($splits as $key => $item) {
            if ($seconds >= $item['val']) {
                $str    .= floor($seconds / $item['val']) . $item['explain'];
                $seconds = ($seconds % $item['val']);
            }
        }
        return $str;
    }

    /**
     * 获取零点时间戳
     *
     * @param string $str
     * @param bool $micro   --是否毫秒级（13位时间戳，java默认）
     * @return int
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getZeroTimestamp(string $str = 'today', $micro = false) : int
    {
        $time = $_SERVER['REQUEST_TIME'] ?? time();
        switch ($str) {
            case 'today':
            case 'd':
                $time = strtotime('today', $time);
                break;
            case 'week':
            case 'w':
                $time = strtotime('this week 00:00:00', $time);
                break;
            case 'month':
            case 'm':
                $time = strtotime(date('Y-m-01'), $time);
                break;
            case 'year':
            case 'y':
                $time = strtotime(date('Y-01-01'), $time);
                break;
            case 'yesterday':
                $time = strtotime('yesterday', $time);
                break;
            case 'tomorrow':
                $time = strtotime('tomorrow', $time);
                break;
            case 'last week':
                $time = strtotime('last week 00:00:00', $time);
                break;
            case 'last month':
                $time = strtotime(date('Y-m-01') . '-1 month', $time);
                break;
            case 'last year':
                $time = strtotime(date('Y-01-01') . '-1 year', $time);
                break;
            default:
                $time = strtotime($str . ' 00:00:00', $time);
        }
        return $micro ? $time * 1000 : $time;
    }

    /**
     * 格式化时间
     * - 暂仅支持时间戳
     *
     * @param $time
     * @param string $format
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function format($time, string $format = 'Y-m-d H:i:s') : string
    {
        if (!is_numeric($time) || strlen($time) < 10) {
            return '-';
        }
        if (strlen($time) > 10) {
            $time = substr($time, 0, 10);
        }
        return date($format, $time);
    }
}