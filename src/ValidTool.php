<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:14
 */

namespace KayTools;

class ValidTool
{

    /**
     * 验证是否为手机号
     *
     * @param $text
     * @return bool
     */
    public static function phone(string $text) : bool
    {
        return !!preg_match('/^1[3456789]\d{9}$/', $text);
    }

    /**
     * 验证是否为ip
     *
     * @param string $text
     * @return bool
     */
    public static function ip(string $text) : bool
    {
        return !!filter_var($text, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6);
    }

    /**
     * 验证是否为ipv4
     *
     * @param string $text
     * @return bool
     */
    public static function ipv4(string $text) : bool
    {
        return !!filter_var($text, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
    }

    /**
     * 验证是否为ipv6
     *
     * @param string $text
     * @return bool
     */
    public static function ipv6(string $text) : bool
    {
        return !!filter_var($text, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
    }

    /**
     * 验证是否为email
     *
     * @param string $text
     * @return bool
     */
    public static function email(string $text) : bool
    {
        return !!filter_var($text, FILTER_VALIDATE_EMAIL);
    }

    /**
     * 验证是否为url
     *
     * @param string $text
     * @return bool
     */
    public static function url(string $text) : bool
    {
        return !!filter_var($text, FILTER_VALIDATE_URL);
    }

    /**
     * 验证是否为身份证
     *
     * @param string $text
     * @param bool $strict
     * @return bool
     */
    public static function idCard(string $text, $strict = false)
    {
        if (!$strict) {
            return !!preg_match("/(^\d{15}$)|(^\d{17}([0-9]|X|x)$)/", $text);
        }
        if (strlen($text) == 18) {
            return self::idCardChecksum18($text);
        } elseif (strlen($text) == 15) {
            return self::idCardChecksum18(self::idCard15to18($text));
        }
        return false;
    }

    // 计算身份证校验码，根据国家标准GB 11643-1999
    private static function idCardVerifyNumber($idCardBase)
    {
        if (strlen($idCardBase) != 17) {
            return false;
        }
        $factor    = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
        $verifyNum = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];
        $checksum  = 0;
        for ($i = 0; $i < strlen($idCardBase); $i++) {
            $checksum += substr($idCardBase, $i, 1) * $factor[$i];
        }
        $mod = $checksum % 11;
        return $verifyNum[$mod];

    }

    // 将15位身份证升级到18位
    private static function idCard15to18($idCard)
    {
        if (strlen($idCard) != 15) {
            return false;
        } else {
            if (array_search(substr($idCard, 12, 3), ['996', '997', '998', '999']) !== false) {
                $idCard = substr($idCard, 0, 6) . '18' . substr($idCard, 6, 9);
            } else {
                $idCard = substr($idCard, 0, 6) . '19' . substr($idCard, 6, 9);
            }
        }
        $idCard = $idCard . self::idCardVerifyNumber($idCard);
        return $idCard;

    }

    //18位身份证校验码有效性检查
    private static function idCardChecksum18($idCard)
    {
        if (strlen($idCard) != 18) {
            return false;
        }
        $idCardBase = substr($idCard, 0, 17);
        return self::idCardVerifyNumber($idCardBase) == strtoupper(substr($idCard, 17, 1));
    }

}