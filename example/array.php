<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2019-12-23
 * Time: 17:36
 */

require_once '../vendor/autoload.php';

use KayTools\ArrTool;
use KayTools\TimeTool;

$array  = ['1', '2', '3', '1', null, '', 0];
$array2 = [['1', '2'], '3', '4'];

var_dump(ArrTool::isOneDimension($array));
var_dump(ArrTool::isOneDimension($array2));

var_dump(ArrTool::getPure($array)); // ['1', '2', '3']

$array3 = [
    'is_del'    => 1,
    'user_info' => [
        'user_id'   => 2,
        'user_name' => 'name',
        'userTemp'  => 'test'
    ]
];
var_dump(ArrTool::camel($array3));


$array4 = [
    'a' => TimeTool::getZeroTimestamp(),
    'b' => TimeTool::getZeroTimestamp('month'),
];
ArrTool::runSingleTime($array4, ['a', 'e']);
var_dump($array4);

$array5 = [
    [
        'a' => TimeTool::getZeroTimestamp(),
        'b' => TimeTool::getZeroTimestamp('month'),
    ],
    [
        'a' => TimeTool::getZeroTimestamp(),
        'b' => TimeTool::getZeroTimestamp('month'),
    ]
];
ArrTool::runTime($array5, ['a' => 'c']);
var_dump($array5);


$array6 = [
    'a' => 1,
    'b' => 'test'
];
ArrTool::runSingleEnum($array6, ['a' => [1 => '枚举1', 2 => '枚举2']]);
var_dump($array6);

$array7 = [
    [
        'a' => 1,
        'b' => 'test'
    ],
    [
        'a' => 2,
        'b' => 'test2'
    ]
];
ArrTool::runEnum($array7, ['a' => [1 => '枚举1', 2 => '枚举2']], 'view');
var_dump($array7);
