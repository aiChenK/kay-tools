<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../vendor/autoload.php';

use KayTools\RequestTool;

var_dump(RequestTool::getServerOS());

var_dump(RequestTool::getClientBrowser());
var_dump(RequestTool::getClientOs());
var_dump(RequestTool::getClientIp());