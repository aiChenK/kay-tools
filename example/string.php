<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-01-15
 * Time: 14:02
 */

require_once '../vendor/autoload.php';

use KayTools\StrTool;

var_dump(StrTool::startWith('fdafa', 'Fd', true));
var_dump(StrTool::camel('user_id'));
var_dump(StrTool::snake('userId'));


