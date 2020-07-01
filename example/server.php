<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-07-01
 * Time: 19:55
 */

require_once '../vendor/autoload.php';

use KayTools\ServerTool;

var_dump(ServerTool::getHost());
var_dump(ServerTool::getTopHost());
var_dump(ServerTool::getScheme());
