<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:14
 */

namespace KayTools;

class ArrayTool
{

    /**
     * 获取数组值
     *
     * @param array $array
     * @param $key
     * @param string $default
     * @return mixed|string
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
     */
    public static function isExist(array &$array, $keys, bool $checkVal = false)
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
     */
    public static function isOneDimension(array &$array)
    {
        return count($array) == count($array, COUNT_RECURSIVE);
    }

    /**
     * 获取简单一维数组（去除无用/重复/主键数据）
     *
     * @param array $array
     * @return array
     *
     * create by aiChenK 20191231
     */
    public static function getPure(array &$array)
    {
        return array_values(array_unique(array_filter($array)));
    }
}