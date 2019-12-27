# kay-tools
> 工具类

## 运行环境
- PHP 7.2+

## 安装方法
        composer require aichenk/kay-tools
        
## 使用
```php
use KayTools\TimeTool;
use KayTools\ServerTool;

var_dump(TimeTool::friendlyCost(86670));    //1天4分30秒
var_dump(ServerTool::getServerOS());        //Windows
```
