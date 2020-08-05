<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../vendor/autoload.php';

use KayTools\RequestTool;


$agent1 = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/12.0 Safari/605.1.15";
$agent2 = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36 Edg/84.0.522.50";
var_dump(RequestTool::getClientBrowser($agent1));
var_dump(RequestTool::getClientBrowser($agent2));

var_dump(RequestTool::getClientOs($agent1));
var_dump(RequestTool::getClientOs($agent2));
var_dump(RequestTool::getClientIp());