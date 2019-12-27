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
     * @return int
     */
    public static function getZeroTimestamp(string $str = 'today') : int
    {
        $time = $_SERVER['REQUEST_TIME'] ?? time();
        switch ($str) {
            case 'today':
            case 'd':
                return strtotime('today', $time);
                break;
            case 'week':
            case 'w':
                return strtotime('this week 00:00:00', $time);
                break;
            case 'month':
            case 'm':
                return strtotime(date('Y-m-01'), $time);
                break;
            case 'year':
            case 'y':
                return strtotime(date('Y-01-01'), $time);
                break;
            case 'yesterday':
                return strtotime('yesterday', $time);
                break;
            case 'tomorrow':
                return strtotime('tomorrow', $time);
                break;
            case 'last week':
                return strtotime('last week 00:00:00', $time);
                break;
            case 'last month':
                return strtotime(date('Y-m-01') . '-1 month', $time);
                break;
            case 'last year':
                return strtotime(date('Y-01-01') . '-1 year', $time);
                break;
            default:
                return strtotime($str . ' 00:00:00', $time);
                break;
        }
    }

    /**
     * 批量处理数组时间戳至日期格式
     *
     * @param array $rows
     * @param string $targetKey
     * @param string $format
     */
    public static function runTimestampToDate(array &$rows, string $targetKey, string $format = 'Y-m-d H:i:s') : void
    {
        foreach ($rows as &$row) {
            if (!isset($row[$targetKey])) {
                continue;
            }
            $row[$targetKey] = $row[$targetKey] ? date($format, substr($row[$targetKey], 0, 10)) : '-';
        }
        unset($row);
    }
}