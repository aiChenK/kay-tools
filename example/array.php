<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../src/Bootstrap.php';
\KayTools\Bootstrap::init();

use KayTools\ArrayTool;

$array  = ['1', '2', '3', '1', null, '', 0];
$array2 = [['1', '2'], '3', '4'];

var_dump(ArrayTool::isOneDimension($array));
var_dump(ArrayTool::isOneDimension($array2));

var_dump(ArrayTool::getPure($array)); // ['1', '2', '3']