<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-06-25
 * Time: 21:58
 */

include '../vendor/autoload.php';

use KayTools\Tree;

$data = json_decode(file_get_contents('tree.json'), true);

$tree = new Tree();
$tree->parse($data['source']);

echo json_encode($tree->replaceKey(['id' => 'key', 'name' => 'title'])->getTree(), JSON_UNESCAPED_UNICODE);
echo PHP_EOL . '----------------------' . PHP_EOL;

$tree->load($data['tree']);
echo json_encode($tree->keepKey(['id', 'name', 'sort'])->getTree(), JSON_UNESCAPED_UNICODE);


