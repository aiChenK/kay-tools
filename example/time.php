<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../vendor/autoload.php';

use KayTools\TimeTool;

var_dump(TimeTool::friendlyCost(86670));

var_dump(TimeTool::getZeroTimestamp('today'));

var_dump(TimeTool::format(TimeTool::getZeroTimestamp('week')));
var_dump(TimeTool::format(TimeTool::getZeroTimestamp('year')));

