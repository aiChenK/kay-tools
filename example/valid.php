<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../vendor/autoload.php';

use KayTools\ValidTool;

var_dump(ValidTool::phone(13089732767));

var_dump(ValidTool::ip('192.168.5.234'));
var_dump(ValidTool::ipv6('fe80::5daf:6ed6:980f:3c33'));

var_dump(ValidTool::email('aichenk@qq.com'));

var_dump(ValidTool::url('http://admin.xh.com'));

var_dump(ValidTool::idCard('330621199609095332'));
var_dump(ValidTool::idCard('330621199609095332', true));
