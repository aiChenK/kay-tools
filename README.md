# kay-tools
> 工具类

## 运行环境
- PHP 7.2+

## 安装方法
        composer require aichenk/kay-tools
        
## 使用
```php
use KayTools\TimeTool;

var_dump(TimeTool::friendlyCost(86670));    //1天4分30秒
```

## 更新说明
2020-07-01
- 增加`ServerTool`，支持获取域名等信息
- 移动`isUnderCli|getServerOS`方法到`ServerTool`

2020-06-26
- 增加`Tree`类，主要处理导航树等