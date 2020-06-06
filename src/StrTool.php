<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-01-15
 * Time: 14:00
 */

namespace KayTools;

/**
 * 字符串处理
 * - 部分参考tp
 *
 * @author aiChenK
 */
class StrTool
{
    /**
     * 检查字符串中是否包含某些字符串
     *
     * @param string $haystack
     * @param $needles
     * @param bool $ignoreCase
     * @return bool
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function contains(string $haystack, $needles, bool $ignoreCase = false): bool
    {
        $needles = (array) $needles;
        if ($ignoreCase) {
            $haystack = self::lower($haystack);
            $needles = array_map(function ($val) {
                return self::lower($val);
            }, $needles);
        }
        foreach ($needles as $needle) {
            if ('' != $needle && mb_strpos($haystack, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * 检查字符串是否以某些字符串开始
     *
     * @param string $haystack
     * @param array|string $needles
     * @param bool $ignoreCase
     * @return bool
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function startWith(string $haystack, $needles, bool $ignoreCase = false)
    {
        $needles = (array) $needles;
        if ($ignoreCase) {
            $haystack = self::lower($haystack);
            $needles = array_map(function ($val) {
                return self::lower($val);
            }, $needles);
        }
        foreach ($needles as $needle) {
            if ('' != $needle && mb_strpos($haystack, $needle) === 0) {
                return true;
            }
        }
        return false;
    }

    /**
     * 检查字符串是否以某些字符串结尾
     *
     * @param string $haystack
     * @param array|string $needles
     * @param bool $ignoreCase
     * @return bool
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function endWith(string $haystack, $needles, bool $ignoreCase = false)
    {
        $needles = (array) $needles;
        if ($ignoreCase) {
            $haystack = self::lower($haystack);
            $needles = array_map(function ($val) {
                return self::lower($val);
            }, $needles);
        }
        foreach ($needles as $needle) {
            if ((string) $needle === static::substr($haystack, -static::length($needle))) {
                return true;
            }
        }
        return false;
    }

    /**
     * 截取字符串
     *
     * @param string $string
     * @param int $start
     * @param int|null $length
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function substr(string $string, int $start, int $length = null): string
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * 获取字符串长度
     *
     * @param string $str
     * @return int
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function length(string $str)
    {
        return mb_strlen($str);
    }

    /**
     * 下划线字符串转大写
     *
     * @param string $str
     * @return string|string[]
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function camel(string $str)
    {
        $str = ucwords(str_replace('_', ' ', $str));
        return str_replace(' ', '', lcfirst($str));
    }

    /**
     * 驼峰转下划线
     *
     * @param string $str
     * @param string $delimiter
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function snake(string $str, string $delimiter = '_')
    {
        if (ctype_lower($str)) {
            return $str;
        }
        $str = preg_replace('/\s+/u', '', $str);
        return self::lower(preg_replace('/(.)(?=[A-Z])/u', '$1' . $delimiter, $str));
    }

    /**
     * 字符串转小写
     *
     * @param string $value
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function lower(string $value): string
    {
        return mb_strtolower($value, 'UTF-8');
    }

    /**
     * 字符串转大写
     *
     * @param  string $value
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function upper(string $value): string
    {
        return mb_strtoupper($value, 'UTF-8');
    }

}