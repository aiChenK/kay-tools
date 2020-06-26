<?php
/**
 * Created by PhpStorm.
 * User: aiChenK
 * Date: 2020-06-23
 * Time: 21:05
 */

namespace KayTools;

/**
 * 树结构处理
 * - 主要用于导航等
 *
 * @author aiChenK
 */
class Tree
{
    private $idKey        = 'id';
    private $parentKey    = 'pid';
    private $childKey     = 'children';

    private $originTree  = [];
    private $currentTree = [];

    public function __construct(string $idKey = '', string $parentKey = '', string $childKey = '')
    {
        $idKey      and $this->idKey     = $idKey;
        $parentKey  and $this->parentKey = $parentKey;
        $childKey   and $this->childKey  = $childKey;
    }

    /**
     * 加载树结构
     *
     * @param array $tree
     * @return $this
     *
     * @author aiChenK
     * @version 1.0
     */
    public function load(array $tree): Tree
    {
        $this->originTree  = $tree;
        $this->currentTree = $this->originTree;
        return $this;
    }

    /**
     * 根据数组解析为树结构
     *
     * @param array $data
     * @return $this
     *
     * @author aiChenK
     * @version 1.0
     */
    public function parse(array $data): Tree
    {
        $funcParse = function (array &$data, $pid = null) use (&$funcParse) {
            $leafs = [];
            foreach ($data as $key => $value) {
                $parentId = $value[$this->parentKey] ?? null;
                // 包括 0 "" false null 等情况
                if ($parentId != $pid) {
                    continue;
                }
                if (isset($value[$this->idKey])) {
                    $children = $funcParse($data, $value[$this->idKey]);
                    if ($children) {
                        $value[$this->childKey] = $children;
                    }
                }
                unset($data[$key]);
                $leafs[] = $value;
            }
            return $leafs;
        };
        $this->originTree  = $funcParse($data);
        $this->currentTree = $this->originTree;
        return $this;
    }

    /**
     * 获取树
     *
     * @return array
     *
     * @author aiChenK
     * @version 1.0
     */
    public function getTree(): array
    {
        return $this->currentTree;
    }

    /**
     * 转换数组键值
     *
     * @param string|array $source      "id" or ["id" => "key", "name" => "title"]
     * @param string $target            "key"
     * @return $this
     *
     * @author aiChenK
     * @version 1.0
     */
    public function replaceKey($source, $target = ''): Tree
    {
        $replaceKeys = is_string($source) ? [$source => $target] : $source;
        $funcReplace = function (array &$tree, array &$replaceKeys) use (&$funcReplace) {
            $keys = array_keys($replaceKeys);
            foreach ($tree as &$node) {
                foreach ($keys as $key) {
                    if (isset($node[$key])) {
                        $node[$replaceKeys[$key]] = $node[$key];
                        unset($node[$key]);
                    }
                }
                if (isset($node[$this->childKey])) {
                    $funcReplace($node[$this->childKey], $replaceKeys);
                }
            }
            unset($node);
        };
        $funcReplace($this->currentTree, $replaceKeys);
        return $this;
    }

    /**
     * 仅保留指定键值（childKey默认保留）
     *
     * @param array $keys
     * @return $this
     *
     * @author aiChenK
     * @version 1.0
     */
    public function keepKey(array $keys): Tree
    {
        $func = function (array &$tree, array &$keys) use (&$func) {
            foreach ($tree as &$node) {
                foreach ($node as $key => $val) {
                    if (!in_array($key, $keys) && $key != $this->childKey) {
                        unset($node[$key]);
                    }
                }
                if (isset($node[$this->childKey])) {
                    $func($node[$this->childKey], $keys);
                }
            }
            unset($node);
        };
        $func($this->currentTree, $keys);
        return $this;
    }

    // todo 获取某id下结构
    // todo 树的最大层级
    // todo 是否包含无用数据
}