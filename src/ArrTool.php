<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:14
 */

namespace KayTools;

class ArrTool
{

    /**
     * 获取数组值
     *
     * @param array $array
     * @param $key
     * @param string $default
     * @return mixed|string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getValue(array &$array, $key, $default = '')
    {
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }

    /**
     * 批量检查键是否存在（可检查值）
     *
     * @param array $array
     * @param $keys
     * @param bool $checkVal    --检查值，若0|false|null|''则视为不存在
     * @return bool
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function isExist(array &$array, $keys, bool $checkVal = false) : bool
    {
        if (is_string($keys)) {
            $keys = [$keys];
        }
        if (!$checkVal) {
            foreach ($keys as $key) {
                if (!array_key_exists($key, $array)) {
                    return false;
                }
            }
        } else {
            foreach ($keys as $key) {
                if (!array_key_exists($key, $array) || !$array[$key]) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * 是否为一维数组（递归计数）
     *
     * @param array $array
     * @return bool
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function isOneDimension(array &$array) : bool
    {
        return count($array) == count($array, COUNT_RECURSIVE);
    }

    /**
     * 获取简单一维数组（去除无用/重复/主键数据）
     *
     * @param array $array
     * @return array
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getPure(array &$array) : array
    {
        return array_values(array_unique(array_filter($array)));
    }

    /**
     * 下划线转化为驼峰格式
     *
     * @param array $arr
     * @return array
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function camel(array &$arr) : array
    {
        $temp = [];
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $value = self::camel($value);
            }
            $temp[StrTool::camel($key)] = $value;
        }
        return $temp;
    }

    /**
     * 驼峰格式转化为下划线
     *
     * @param array $arr
     * @return array
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function snake(array &$arr) : array
    {
        $temp = [];
        foreach ($arr as $key => $value) {
            if (is_array($value)) {
                $value = self::snake($value);
            }
            $temp[StrTool::snake($key)] = $value;
        }
        return $temp;
    }

    /**
     * 批量处理数组内时间戳至日期格式
     *
     * @param array $arr
     * @param string|array $fields  -- ["a", "b"] | ["a" => "c"]
     * @param string $format
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function runTime(array &$arr, $fields, string $format = 'Y-m-d H:i:s') : void
    {
        $fields = (array) $fields;
        foreach ($arr as $key => &$val) {
            if (is_array($val)) {
                self::runSingleTime($val, $fields, $format);
                continue;
            }
        }
        unset($val);
    }

    /**
     * 处理一维数组时间
     *
     * @param array $obj
     * @param $fields
     * @param string $format
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function runSingleTime(array &$obj, $fields, string $format = 'Y-m-d H:i:s') : void
    {
        $fields = (array) $fields;
        foreach ($fields as $key => $val) {
            $field = is_string($key) ? $key : $val;
            if (isset($obj[$field])) {
                $obj[$val] = TimeTool::format($obj[$field], $format);
            }
        }
    }

    /**
     * 处理二维数组枚举
     *
     * @param array $arr
     * @param array $enums
     * @param string $suffix
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function runEnum(array &$arr, array $enums = [], string $suffix = '') : void
    {
        foreach ($arr as &$obj) {
            if (is_array($obj)) {
                self::runSingleEnum($obj, $enums, $suffix);
            }
        }
        unset($obj);
    }

    /**
     * 处理一维数组枚举
     *
     * @param array $obj
     * @param array $enums
     * @param string $suffix
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function runSingleEnum(array &$obj, array $enums = [], string $suffix = '') : void
    {
        foreach ($enums as $field => $enum) {
            if (isset($obj[$field]) && isset($enum[$obj[$field]])) {
                $obj[$field . ucfirst($suffix)] = $enum[$obj[$field]];
            }
        }
    }
}