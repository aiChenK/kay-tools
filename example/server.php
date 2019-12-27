<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../src/Bootstrap.php';
\KayTools\Bootstrap::init();

use KayTools\ServerTool;

var_dump(ServerTool::getServerOS());

var_dump(ServerTool::getClientBrowser());
var_dump(ServerTool::getClientOs());
var_dump(ServerTool::getClientIp());