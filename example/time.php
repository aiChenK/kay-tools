<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../src/Bootstrap.php';
\KayTools\Bootstrap::init();

use KayTools\TimeTool;

var_dump(TimeTool::friendlyCost(86670));
var_dump(date('Y-m-d H:i:s', TimeTool::getZeroTimestamp('today')));
var_dump(date('Y-m-d H:i:s', TimeTool::getZeroTimestamp('week')));
var_dump(date('Y-m-d H:i:s', TimeTool::getZeroTimestamp('year')));

$rows = [
    ['time' => time() - 3600],
    ['time' => time()],
    ['time' => time() + 2400]
];
TimeTool::runTimestampToDate($rows, 'time', 'Y/m/d H:i');
var_dump($rows);
