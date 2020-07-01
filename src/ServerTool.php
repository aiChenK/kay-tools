<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-07-01
 * Time: 19:46
 */

namespace KayTools;


class ServerTool
{
    /**
     * 获取Server参数
     *
     * @param string $name
     * @return mixed|string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getServer(string $name)
    {
        return $_SERVER[$name] ?? '';
    }

    /**
     * 获取host（非代理）
     *
     * @param bool $port        是否带端口
     * @return mixed|string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getHost(bool $port = true): string
    {
        $host = '';
        if ($host = self::getServer('HTTP_X_FORWARDED_HOST')) {
            return $host;
        }
        if ($host = self::getServer('HTTP_X_FORWARDED_HOST')) {
            return $host;
        }
        if ($host = self::getServer('SERVER_NAME')) {
            $host .= $_SERVER['SERVER_PORT'] == '80' ? '' : ':' . self::getServer('SERVER_NAME');
        }
        if (!$port && strpos($host, ':')) {
            // 去除端口
            return strstr($host, ':', true);
        }
        return $host;
    }

    /**
     * 获取一级域名（暂不考虑双后缀）
     *
     * @return mixed|string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getTopHost()
    {
        $host = self::getHost(false);
        if (!$host) {
            return $host;
        }
        if (ValidTool::ip($host)) {
            return $host;
        }
        $item  = explode('.', $host);
        $count = count($item);
        return $count > 1 ? $item[$count - 2] . '.' . $item[$count - 1] : $item[0];
    }

    /**
     * 获取带协议域名
     *
     * @param bool $port
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getDomain(bool $port = false): string
    {
        return self::getScheme() . '://' . self::getHost($port);
    }

    /**
     * 获取http协议
     *
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getScheme(): string
    {
        return self::isSsl() ? 'https' : 'http';
    }

    /**
     * 是否为https
     *
     * @return bool
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function isSsl(): bool
    {
        if ('https' == self::getServer('REQUEST_SCHEME')) {
            return true;
        } elseif ('443' == self::getServer('SERVER_PORT')) {
            return true;
        } elseif ('https' == self::getServer('HTTP_X_FORWARDED_PROTO')) {
            return true;
        }
        return false;
    }

    /**
     * 判断是否cli模式运行
     *
     * @return bool
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function isUnderCli() : bool
    {
        return !!preg_match("/cli/i", php_sapi_name());
    }

    /**
     * 获取服务器操作系统
     *
     * @return string
     *
     * @author aiChenK
     * @version 1.0
     */
    public static function getServerOS() : string
    {
        return PATH_SEPARATOR == ':' ? 'Linux' : 'Windows';
    }
}